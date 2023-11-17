<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeacherToSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SetmarkController extends Controller
{
    public function ShowformUploadMark()
    {
        return view ('/setmark/index');
    }
    public function SearchReport(Request $request)
    {
        $subject_id=$request -> subject_id;
        $sinhvien_id=$request -> sinhvien_id;
        $teacher_id= auth()->user()->teacher_id;
       
        // $subject_id = DB::table('subjects')->where('code', $subject_code)->value('id') ;
        $semester = $request -> semester;
        $data = DB::table('reports')->join('teacher_to_subjects', 'teacher_to_subjects.id','=','reports.teacher_to_subjects_id')
                                    ->select('*', 'reports.id as report_id')
                
                                    ->where('sinhvien_id', $sinhvien_id)
                                    // ->where('subject_id', $subject_id)
                                    ->where('teacher_id', $teacher_id)
                                    ->get();
        
        return response()->json($data);
    }
    public function SetMarkReport(Request $request)
    {
        $report_id= $request -> report_id;
        $report = Report::find($report_id);
        $report->mark= $request -> mark;
        $report->save();
        $data = $report;
        return response()->json($data);

    }
    public function DowloadfileReport(Request $request)
    {

        $report_id= $request -> report_id;
         
        $report = Report::find($report_id);
        $path = storage_path($report->path);
       
        // return response()->json($pathToFile);
        $name = $report -> title;
        $headers = array(
            'Content-Type: application/pdf',
          );
        return response()->download($path);

    }

   


}