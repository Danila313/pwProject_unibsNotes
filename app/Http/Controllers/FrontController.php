<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class FrontController extends Controller
{
    public function getHome() {
        
        $dl = new DataLayer();
        $notes_list = $dl->allNotes();
        
        $departments = $dl->allDepartments();
        $faculties = $dl->allFaculties();

        return view('index')->with('notesList', $notes_list)->with('departments', $departments)->with('faculties', $faculties);
        
    }
}
