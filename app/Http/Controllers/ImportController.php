<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ImportTeachersCsv;
use App\Jobs\ImportSinhviensCsv;
use App\Jobs\ImportSubjectsCsv;
use Illuminate\Http\Request;
use App\Models\Import;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function importTeacher() {
        return view ('import/teacher');
    }

    public function storeTeacher(Request $request) {
        
        $file_name = date('Ymd_His_').$request->file->getClientOriginalName();
        $file_path = storage_path('app\\data\\'.$file_name);

        $import = new Import();
        $import->name = $file_name;
        $import->path = $file_path;
        $import->status = 0;
        $import->created_by = Auth::user()->name;
        $import->save();
        
        // save file 
        $request->file->move(storage_path('app\\data\\'), $file_name);

        $teacherImport = Import::latest()->first();
        $teacherImport = $import;
        $path = $file_path;

        ImportTeachersCsv::dispatch($path, $teacherImport)->delay(10);
        return response()->json('Tải file thành công, đang chờ xử lý');
     
       
    }
    public function importSinhvien() {
        return view ('import/student');
    }

    public function storeSinhvien(Request $request) {
        $file_name = date('Ymd_His_').$request->file->getClientOriginalName();
        $file_path = storage_path('app\\data\\'.$file_name);

        $import = new Import();
        $import->name = $file_name;
        $import->path = $file_path;
        $import->status = 0;
        $import->created_by = Auth::user()->name;
        $import->save();
        
        // save file 
        $request->file->move(storage_path('app\\data\\'), $file_name);

        $sinhvienImport = $import;
        $path = $file_path;

        ImportsinhviensCsv::dispatch($path, $sinhvienImport)->delay(10);
        return response()->json('Tải file thành công, đang chờ xử lý');
    }
    public function importSubject() {
        return view ('import/subject');
    }

    public function storeSubject(Request $request) {
        $file_name = date('Ymd_His_').$request->file->getClientOriginalName();
        $file_path = storage_path('app\\data\\'.$file_name);

        $import = new Import();
        $import->name = $file_name;
        $import->path = $file_path;
        $import->status = 0;
        $import->created_by = Auth::user()->name;
        $import->save();
        
        $request->file->move(storage_path('app\\data\\'), $file_name);

        $subjectImport = $import;
        $path = $file_path;

        ImportSubjectsCsv::dispatch($path, $subjectImport)->delay(10);
        return response()->json('Tải file thành công, đang chờ xử lý');
    }
}