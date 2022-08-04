<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function about(){
        return view('main.about');
    }
    public function clients(){
        return view('main.clients');
    }
    public function contact(){
        return view('main.contact');
    }
    public function copyright(){
        return view('main.copyright');
    }
    public function home(){
        return view('main.home');
    }
    public function project(){
        return view('main.project');
    }
}
