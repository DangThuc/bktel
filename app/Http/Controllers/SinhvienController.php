<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sinhvien;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class SinhvienController extends Controller
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
        
        $sinhvien = Sinhvien::paginate(5);
        return view('sinhvien.index', compact('sinhvien'))->with('i',(request()->input('page',1)-1)*5);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('sinhvien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        $student = new Sinhvien($data);
        $student->save();
        // dd($student->id);
        
        $user = $request->user();
        $user->sinhvien_id = $student->id;
        $user->save();

        
        return redirect() -> route('sinhvien.index');
        
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
    {   $sinhvien = Sinhvien::find($id);
        return view('sinhvien.edit',compact('sinhvien'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $sinhvien = Sinhvien::find($id);    
        $sinhvien->update($request->all());
        return redirect() -> route('sinhvien.index')->with('thongbao','Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $sinhvien = Sinhvien::find($id);
        $sinhvien->delete();
        return redirect() -> route('home')->with('thongbao','Xoá thông tin thành công');
    }
}
