<?php

namespace App\Http\Controllers\Main;
use App\Models\Group;
use App\Models\CopyRight;
use App\Models\About;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Section;
use App\Models\Details;
use App\Models\Social;
use App\Models\Client;
use App\Models\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        $about    = About::get()->first();
        $services = Services::get()->all();
        $groups   = Group::get()->all();
        $clients  = Client::get()->all();
        $copyright= CopyRight::get()->first();
        $social   = Social::get()->first();
        return view('main.home',compact([
            'about',
            'services',
            'groups',
            'clients',
            'copyright',
            'social',
        ]));
    }

    public function save_message(Request $request){
        $data = Contact::create([
            'name'  => $request->name,   
            'email' => $request->email, 
            'phone' => $request->phone,
            'disc'  => $request->message,
        ]);
        if($data){
            return response()->json(['status'=>'true']);
        }
    }
}
