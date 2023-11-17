<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view ('/profile/index');
    }
    public function uploadImg(Request $request)
    {   
        $id = $request->user()->id;
        $file_name = date('Ymd_His_').$request->image->getClientOriginalName();
        
        $user = User::findOrFail($id);
        $user->profile_images = $file_name;
        $user->save();

        $request->image->move(storage_path('app\\public\\profiles\\'. $id), $file_name);
        return redirect() -> route('profile.update');
    }
}