<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Faculty;
use App\Models\User;

class DataLayer
{
    //Searching methods for Notes
    public function allNotes(){
        $notes = Note::all();
        return $notes;
    }

    public function allFaculties(){
        $faculties = Faculty::all();
        return $faculties;
    }

    public function allDepartments(){
        $departments = Department::all();
        return $departments;
    }

    public function allWriters(){
        $users = User::all();
        // $writers = null;
        // foreach($users as $user){
        //     if($user->writtenNotes() != null){
        //         $writers->push($user);
        //     }
        // }
        return $users;
    }

    public function findNoteById($id){
        return Note::find($id);
    }

    //CRUD operations on Notes

    public function editNote($id, $title, $course, $professor, $year, $num_pages, $file, $abstract, $faculty_id){
        Note::find($id)->update(['title'=>$title,'course'=>$course,'professor'=>$professor, 'year'=>$year,'num_pages'=>$num_pages, 'file'=>$file, 'abstract'=>$abstract, 'faculty_id'=>$faculty_id]);
    }

    public function addNote($title, $course, $professor, $year, $num_pages, $file, $abstract, $average_score, $user_id, $faculty_id){
        $note = new Note;
        $note->title = $title;
        $note->course = $course;
        $note->professor = $professor;
        $note->year = $year;
        $note->num_pages = $num_pages;
        $note->file = $file;
        $note->abstract = $abstract;
        $note->average_score = $average_score;
        $note->user_id = $user_id;
        $note->faculty_id = $faculty_id;
        $note->save();
    }

    public function updateNote($note, $title, $course, $professor, $year, $num_pages, $abstract, $faculty_id){
        $note = Note::find($note);
        $note->title = $title;
        $note->course = $course;
        $note->professor = $professor;
        $note->year = $year;
        $note->num_pages = $num_pages;
        $note->abstract = $abstract;
        $note->faculty_id = $faculty_id;
        $note->save();
    }

    public function deleteNote($note){
        Note::destroy($note);
    }

    public function getFileNameFromNote($note){
        $note_obj = Note::find($note)->first();
        return $note_obj->file->get();
    }

    public function addReaderToNote($note, $user){
        $note_obj = Note::find($note)->first();

        $note_obj->readers->attach($user);
    }


    public function getUserId($email){
        $user = User::where('email', $email)->get('id');
        return $user[0]->id;
    }

    public function getUser($user_id){
        return User::find($user_id)->first();
    }

    public function getFacultyId($faculty_name){
        $faculty = Faculty::where('name', $faculty_name)->first();
        return $faculty->id;
    }

    public function getWriterByNote($note_id){
        $note = Note::find($note_id);
        return $note->writer;
    }

    public function updateProfile($id, $employment, $faculty_id, $image){
        $user = User::find($id);
        $user->employment = $employment;
        $user->faculty_id = $faculty_id;
        $user->image = $image;
        $user->save();
    }    

    public function updateNoteScore($note, $user, $score){
        $note_obj = Note::find($note);
        $user_obj = User::find($user);

        $note_obj->readers()->updateExistingPivot($user_obj, array('score' => $score), true);

        $new_average_score = $note_obj->readers()->avg('score');
        $note_obj->average_score = $new_average_score;
        $note_obj->save();
    }

    public function findNoteByTitle($title) {
        $notes = Note::where('title', $title)->get();
        return $notes; 
    }

    public function filterFacultiesByDepartment($department) {
        $faculties = Faculty::where('department_id', $department)->get();
        return $faculties;
    }

    public function getUserFollowers($user) {
        $followers = $user->followingUser()->get();
        return $followers;
    }

    public function filter($department, $faculty, $year, $score) {
        $notes = Note::all();
        
        if($department != null){
            $department_faculties = Faculty::where('department_id', $department)->pluck('id')->toArray();
            $this->console_log(gettype($department_faculties));
            $notes = $notes->filter(function($item) use ($department_faculties){
                return in_array($item->faculty_id, $department_faculties);
            });
        }
        
        if($faculty != null){
            $notes = $notes->filter(function($item) use ($faculty){
                return $item->faculty_id == $faculty;
            });
        }

        if($year != null){
            $notes = $notes->filter(function($item) use ($year){
                return $item->year == $year;
            });
        }

        if($score != null){
            $notes = $notes->filter(function($item) use ($score){
                return $item->average_score >= $score;
            });
        }

        return $notes;
    }

    function getDepartment($department_id){
        return Department::find($department_id);
    }

    function getFaculty($faculty_id){
        return Faculty::find($faculty_id);
    }

    function console_log($data){
        echo '<script>';
        echo 'console.log('.json_encode($data).')';
        echo '</script>';
    }

}
