<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
    public function index() 
    {
        $subject = Subject::paginate(5);
        return view('subject.index', compact('subject'))->with('i',(request()->input('page',1)-1)*5);
        
    }

    public function create()
    {
        return view ('subject.create');
    }

    public function store(Request $request) 
    {
        Subject::create($request->all());
        return redirect() -> route('subject.index');
    }

}
