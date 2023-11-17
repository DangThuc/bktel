<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Report;
class TeacherController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('student_null');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $teacher = Teacher::paginate(5);
        return view('teacher.index', compact('teacher'))->with('i',(request()->input('page',1)-1)*5);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Teacher::create($request->all());
        return redirect() -> route('teacher.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $teacher = Teacher::find($id);
        return view('teacher.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $teacher = Teacher::find($id);    
        $teacher->update($request->all());
        return redirect() -> route('teacher.index')->with('thongbao','Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect() -> route('teacher.index')->with('thongbao','Xoá thông tin thành công');
    }
    public function ShowformUploadMark()
    {
        return view ('/setmark/index');
    }
    public function SearchReport(Request $request)
    {
        $subject_id=$request -> subject_id;
        $student_id=$request -> student_id;
        $teacher_id= auth()->user()->teacher_id;
        // $subject_id = DB::table('subjects')->where('code', $subject_code)->value('id') ;
        $semester = $request -> semester;
        $data = DB::table('reports')->join('teacher_to_subjects', 'teacher_to_subjects.id','=','reports.teacher_to_subject_id')
                                    ->select('*', 'reports.note as report_note','reports.id as report_id')
                
                                    ->where('student_id', $student_id)
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

    public function FormExportFileMark()
    {
        return view ('dashboard.teacher.export-mark');
    }

    public function SearchAllReport(Request $request)
    {
        $subject_id=$request -> subject_id;
        $teacher_id= auth()->user()->teacher_id;
        // $subject_id = DB::table('subjects')->where('code', $subject_code)->value('id') ;
        $semester = $request -> semester;
        $data = DB::table('reports')->join('teacher_to_subjects', 'teacher_to_subjects.id','=','reports.teacher_to_subject_id')
                                    ->join('teachers', 'teachers.id','=','teacher_to_subjects.teacher_id')
                                    ->join('subjects', 'subjects.id','=','teacher_to_subjects.subject_id')
                                    ->join('students', 'students.id','=','reports.student_id')
                                    ->select('*', 'reports.note as report_note','reports.id as report_id','teachers.first_name as teacher_first_name')                                    
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
                                    ->join('students', 'students.id','=','reports.student_id')
                                    
                                    ->select('*', 'reports.note as report_note','reports.id as report_id','teachers.first_name as teacher_first_name',)  
                                    ->select('teacher_to_subjects.semester','teacher_to_subjects.year',
                                                'teachers.id as teacher_id','teachers.first_name as teacher_name',
                                                'subjects.id as subject_id','subjects.name',
                                                'students.id as student_id','students.first_name as student_name',
                                                'reports.mark'
                                            )          
                                    //->where('subject_id', $subject_id)
                                    ->where('teacher_id', $teacher_id)                         
                                    // ->where('report_id', $report_id)
                                    ->get();
        return response()->json($data);
    }




}
