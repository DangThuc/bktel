<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\TeacherToSubject;

class ExportMarkController extends Controller
{
     
   
    public function FormExportFileMark()
    {
        return view ('/exportmark/index');
    }

    public function SearchAllReport(Request $request)
    {
        $subject_id=$request -> subject_id;
        $teacher_id= auth()->user()->teacher_id;
        
        // $subject_id = DB::table('subjects')->where('code', $subject_code)->value('id') ;
        $semester = $request -> semester;
        $data = DB::table('reports')->join('teacher_to_subjects', 'teacher_to_subjects.id','=','reports.teacher_to_subjects_id')
                                    ->join('teachers', 'teachers.id','=','teacher_to_subjects.teacher_id')
                                    ->join('subjects', 'subjects.id','=','teacher_to_subjects.subject_id')
                                    ->join('sinhviens', 'sinhviens.id','=','reports.sinhvien_id')
                                    ->select('*', 'reports.id as report_id','teachers.first_name as teacher_first_name')                                    
                                    ->where('subject_id', $subject_id)
                                    ->where('teacher_id', $teacher_id)
                                    ->get();
        return response()->json($data);
    }

    public function ExportFileMarkCsv(Request $request)
    {
        $report_id = $request -> report_id;
        $subject_id=$request -> subject_id;
        $teacher_id= auth()->user()->teacher_id;
        $semester = $request -> semester;
        $data = DB::table('reports')->join('teacher_to_subjects', 'teacher_to_subjects.id','=','reports.teacher_to_subject_id')
                                    ->join('teachers', 'teachers.id','=','teacher_to_subjects.teacher_id')
                                    ->join('subjects', 'subjects.id','=','teacher_to_subjects.subject_id')
                                    ->join('sinhviens', 'sinhviens.id','=','reports.sinhvien_id')
                                    
                                    ->select('*', 'reports.id as report_id','teachers.first_name as teacher_first_name',)  
                                    ->select('teacher_to_subjects.semester','teacher_to_subjects.year',
                                                'teachers.id as teacher_id','teachers.first_name as teacher_name',
                                                'subjects.id as subject_id','subjects.name',
                                                'sinhviens.id as sinhvien_id','sinhviens.first_name as sinhvien_name',
                                                'reports.mark'
                                            )          
                                    //->where('subject_id', $subject_id)
                                    ->where('teacher_id', $teacher_id)                         
                                    // ->where('report_id', $report_id)
                                    ->get();
        return response()->json($data);
    }




}