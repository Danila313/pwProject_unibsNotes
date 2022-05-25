<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dl = new DataLayer();
        $faculties = $dl->allFaculties();
        $departments = $dl->allDepartments();
        
        return view('notes.create_note')->with('departments', $departments)->with('faculties', $faculties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dl = new DataLayer();
        $user_id = auth()->id();

        $filenameWithExt = $request->file('note_file')->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('note_file')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.$user_id.'.'.$extension;
        // Upload Image
        $path = $request->file('note_file')->storeAs('public/notes_files/',$fileNameToStore);

        $dl->addNote($request->input('title'), $request->input('course'), $request->input('professor'), $request->input('year'), $request->input('pages'), $fileNameToStore, $request->input('abstract'), "0", $user_id, $request->input('faculty'));
        $receivers = $dl->getUserFollowers(auth()->user());
        foreach($receivers as $receiver){
            $this->sendMessageToFollower($receiver, $request->input('title'));
        }

        return redirect()->route('user.mynotes.uploaded', ['user' => $user_id]);
    }

    public function sendMessageToFollower($receiver, $note_title) {
        $dl = new DataLayer();

    
        $sender_email = "info@unibsnotes.it";
        $sender_name = "UnibsNotes";
        
        $receiver_email = $receiver->email;
        $receiver_name = $receiver->name.' '.$receiver->lastname;
        $subject = "Nuova pubblicazione";
        $message = auth()->user()->name.' ha pubblicato un nuovo documento: '.$note_title;

        try{
            $client = new Client([
                // URI da contattare
                'base_uri' => 'http://localhost:8086',
                'timeout'  => 60.0,
            ]);
            
            $response = $client->request('POST', '', [
                 'form_params' => ['sender_email' => $sender_email, 'sender_name' => $sender_name, 'receiver_email' => $receiver_email, 'receiver_name' => $receiver_name, 'subject' => $subject, 'message' => $message],
                 'headers' => ['source' => 'UnibsNotes', 'content-type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json']
            ]);

            // $result = json_decode($response->getBody());
            // if ($result->result == "positive") {
            //     return view('worker.worker_profile')->with('worker', $receiver)->with('message','Message sent correctly');
            // }else{
            //     return view('worker.worker_profile')->with('worker', $receiver)->with('error','Message not sent. Something went wrong');
            // }
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            //return view('worker.worker_profile')->with('worker', $receiver)->with('error','Message not sent.  Something went wrong');
        }
    }

    public function download($note){
        $dl = new DataLayer();

        //Creazione del collegamento tra note e reader
        $user = auth()->id();
        $note_obj = $dl->findNoteById($note);
        $note_obj->readers()->attach($user);

        //Downloading the file
        return response()->download('storage/notes_files/'.$note_obj->file, $note_obj->file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($note)
    {
            $dl = new DataLayer();
            $note_obj = $dl->findNoteById($note);

            $user_id = auth()->id();
            $reader_exist = false;
            foreach($note_obj->readers as $reader){
                if ($reader->id == $user_id)
                    $reader_exist = true;
            }
            return view('notes.note_detail')->with('note', $note_obj)->with('reader_exist', $reader_exist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $dl = new DataLayer();
            $note = $dl->findNoteById($id);
            $faculties = $dl->allFaculties();
            $departments = $dl->allDepartments();

            return view('notes.edit_note')->with('note', $note)->with('departments', $departments)->with('faculties', $faculties);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $note)
    {
        $dl = new DataLayer();
        $user_id = auth()->id();
        $dl->updateNote($note, $request->input('title'), $request->input('course'), $request->input('professor'), $request->input('year'), $request->input('pages'), $request->input('abstract'), $request->input('faculty'));
        
        return redirect()->route('user.mynotes.myuploadednote', ['note' => $note]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($note)
    {
        $dl = new DataLayer();
        $dl->deleteNote($note);

        return redirect()->route('user.mynotes.uploaded');
    }

    public function writer($note_id)
    {   
        $dl = new DataLayer();
        $writer = $dl->getWriterByNote($note_id);

        $rating = $writer->writtenNotes->avg('average_score');

        return view('notes.writer')->with('writer', $writer)->with('rating', $rating)->with('note_id', $note_id);
    }

    public function updateNoteScore(Request $request, $note){
        $dl = new DataLayer();
        $user = auth()->id();
        $dl->updateNoteScore($note, $user, $request->input('score'));

        

        return redirect()->route('user.mynotes.downloaded');
    }
}
