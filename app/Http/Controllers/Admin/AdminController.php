<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function about(){
        return view('admin.about');
    }
    public function clients(){
        return view('admin.clients');
    }
    public function contact(){
        return view('admin.contact');
    }
    public function copyright(){
        return view('admin.copyright');
    }
    public function general(){
        return view('admin.general');
    }
    public function group(){
        return view('admin.group');
    }
    public function project(){
        return view('admin.project');
    }
    public function reg(){
        return view('auth.register');
    }

    #################### Group Page ###########################
    public function save_group(Request $request){
        return $request;
    }
}
