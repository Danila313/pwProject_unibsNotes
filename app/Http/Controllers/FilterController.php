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
        $department_id = $request->input('department');
        $faculty_id = $request->input('faculty');
        $year = $request->input('year');
        $score = $request->input('score');
        $notes_list = $dl->filter($department_id, $faculty_id, $year, $score);

        $department = $dl->getDepartment($department_id);
        $faculty = $dl->getFaculty($faculty_id);
    
        $departments = $dl->allDepartments();
        $faculties = $dl->allFaculties();

        return view('index')->with('notesList', $notes_list)->with('departments', $departments)->with('faculties', $faculties)->with('department', $department)->with('faculty', $faculty)->with('year', $year)->with('score', $score);
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
