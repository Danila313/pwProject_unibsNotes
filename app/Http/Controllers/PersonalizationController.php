<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Auth;

class PersonalizationController extends Controller
{
    public function downloaded()
    {
        $notes_list = auth()->user()->downloadedNotes()->get();

        return view('mynotes.downloaded')->with('notesList', $notes_list);

    }

    public function uploaded()
    {
        $notes_list = auth()->user()->writtenNotes()->get();
        $rating = auth()->user()->writtenNotes->avg('average_score');

        return view('mynotes.uploaded')->with('notesList', $notes_list)->with('rating', $rating);
            
    }

    public function uploaded_note($note)
    {
        $dl = new DataLayer();
        $note_obj = $dl->findNoteById($note);

        return view('mynotes.uploaded_note')->with('note', $note_obj);
    }

    public function downloaded_note($note)
    {
        $dl = new DataLayer();
        $note_obj = $dl->findNoteById($note);

        return view('mynotes.downloaded_note')->with('note', $note_obj);
    }

    public function follow($user){

        auth()->user()->followedUser()->attach($user);

        return redirect()->back();
    }

    public function unfollow($user){

        auth()->user()->followedUser()->detach($user);

        return redirect()->back();
    }

}
