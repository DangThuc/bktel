<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Report;
use App\Models\TeacherToSubject;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function postSearch(Request $request)
    {   
        $data1 = TeacherToSubject::where('teacher_id',  $request->teacher_id)->where('subject_id',  $request->subject_id)->where('semester', $request->semester)->where('year', $request->year)->get();
        return $data1;
        
    }

   

    public function store(Request $request)
    {   
        $fileName = time().'.'.$request->file->getClientOriginalName();

        $reports = $request->all();

        $path = $request->file('file')->storeAs('reports', $fileName);
        $str2="app/";
        $str2 .= $path;
        $report = new Report();
        $report->sinhvien_id = $request->sinhvien_id;
        $report->teacher_to_subjects_id = $request->id;
        $report->title = $request->name;
        $report->path = $str2;
        $report->save();
        return back()
        ->with('success','You have successfully upload file.')
        ->with('file',$fileName);
    }

    public function confirmation(Request $request)
    {
        $data = $request->all();
        return response()->json($data);
    }
    public function index()
    {
        return view('/search/index');
    }

}
