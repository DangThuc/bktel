<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherToSubject;

class TeacherToSubjectController extends Controller
{
    public function index() 
    {
        $teachertosubject = TeacherToSubject::paginate(5);
        return view('teachertosubject.index', compact('teachertosubject'))->with('i',(request()->input('page',1)-1)*5);
        
    }

    public function create() 
    { 
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view ('teachertosubject.create', [
            'teachers' => $teachers,
            'subjects' => $subjects
        ]);
    }

    public function store(Request $request) 
    {
        
        
        $teacherToSubject = new TeacherToSubject($request->all());
        $teacherToSubject->save();
        return response()->json($teacherToSubject);
        
    }
    public function fetchAllTeacher()
    {
        return response()->json([
            'teachers' => Teacher::all()
        
        ]);
    }
    public function fetchAllSubject()
    {
        return response()->json([
            'subjects' => Subject::all()
        
        ]);
    }
    public function search(Request $request)
        {
            $search = $request->name;
            $result = TeacherToSubject::select('teacher_to_subjects.id','last_name', 'first_name','name', 'code', 'year', 'semester')
            ->join('teachers', 'teachers.id','=','teacher_to_subjects.teacher_id')
            ->join('subjects', 'subjects.id','=','teacher_to_subjects.subject_id')
            ->where('last_name', 'like', '%' . $search . '%')
            ->orWhere('first_name', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
            ->get();
            return response()->json($result);
        }
}
