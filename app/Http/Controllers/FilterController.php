<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;


class FilterController extends Controller
{
    public function filterFaculties(Request $request) {
        $dl = new DataLayer();
        $faculties = $dl->filterFacultiesByDepartment($request->input('department'));
        $response = array('done' => true, 'faculties' => $faculties);
        
        return response()->json($response);
    }

    public function filter(Request $request) {
        $dl = new DataLayer();
        $notes_list = $dl->filter($request->input('department'), $request->input('faculty'), $request->input('year'), $request->input('score'));
    
        $departments = $dl->allDepartments();
        $faculties = $dl->allFaculties();

        return view('index')->with('notesList', $notes_list)->with('departments', $departments)->with('faculties', $faculties);
    }

    public function getFaculties(Request $request) {
        $dl = new DataLayer();
        $dl->console_log('in filter controller');
        $faculties = $dl->allFaculties();
        $dl->console_log($faculties);
        $response = array('done' => true, 'faculties' => $faculties);
        
        return response()->json($response);
    }
}
