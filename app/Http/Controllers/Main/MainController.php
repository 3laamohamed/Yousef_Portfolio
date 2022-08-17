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
use App\Models\DataSheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        $flage = 0;
        $active = 1;
        $counter = 1;
        $counter_image = 1;
        $new_client  =[];
        $get_data = DataSheet::get()->first();
        $update_data = DataSheet::where(['id'=>$get_data->id])->update([
            'visitors'=>$get_data->visitors + 1,
        ]);
        $about    = About::get()->first();
        $services = Services::get()->all();
        $groups   = Group::get()->all();
        $clients  = Client::inRandomOrder()->get()->all();
        $copyright= CopyRight::get()->first();
        $social   = Social::get()->first();
        $projects = Project::get()->all();
        foreach($clients as $client){
                if($counter_image <= 5){
                    if($flage == 0){
                        $new_client[$active .'_'. $counter_image]=$client->image;
                    }
                    $counter_image++;
                }else{
                    $counter_image = 1;
                    $active++;
                    $new_client[$active .'_'. $counter_image]=$client->image;
                    $counter_image++;
                }
        }
        return view('main.home',compact([
            'about',
            'services',
            'groups',
            'clients',
            'copyright',
            'social',
            'projects',
            'get_data',
            'new_client',
            'active',
            'counter_image'
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

    public function get_sections(Request $request){
        $sections = Section::where(['project_id'=>$request->id])->get();
        if($sections){
            return response()->json([
                'status'=>'true',
                'sections'=>$sections
            ]);
        }
    }

    public function get_details(Request $request){
        if($request->id == 'all'){
            $sections = Section::where(['project_id'=>$request->pro])->select(['id'])->get();
            $details = Details::whereIn('section_id',$sections)->get();
        }else{
            $details = Details::where(['section_id'=>$request->id])->get();
        }
        if($details){
            return response()->json([
                'status'=>'true',
                'details'=>$details
            ]);
        }
    }
}
