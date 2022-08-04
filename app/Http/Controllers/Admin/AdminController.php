<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\CopyRight;
use App\Models\About;
use Illuminate\Filesystem\Filesystem;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewabout(){
        $data = About::get()->all();
        return view('admin.about',compact('data'));
    }
    public function clients(){
        return view('admin.clients');
    }
    public function contact(){
        return view('admin.contact');
    }
    public function copyright(){
        $data = CopyRight::get()->all();
        return view('admin.copyright',compact(['data']));
    }
    public function general(){
        return view('admin.general');
    }
    public function group(){
        $counter = 1;
        $groups = Group::get()->All();
        if(!empty($groups)){
          $counter = Group::max('id') + 1;
        }
        return view('admin.group',compact('groups','counter'));
    }
    public function project(){
        return view('admin.project');
    }
    public function reg(){
        return view('auth.register');
    }

    function ReturnSucsess($status , $msg){
        return response()->json([
            'status' => $status ,
            'msg'    => $msg ,
        ]);
    }

    function saveimage($photo , $folder)
    {
        $file = $photo -> getClientOriginalExtension();
        $no_rand = rand(10,1000);
        $file_name = time() . $no_rand .  '.' . $file;
        $photo -> move($folder , $file_name);
        return $file_name;
    }

    #################### Group Page ###########################
    public function save_group(Request $request){
        switch($request->action){
            case 'save':{
                $save = Group::create([
                    'group'=>$request->groupName,
                ]);
                if($save){return $this->ReturnSucsess('true', 'Saved Ggroup');}
            }break;
            case 'update':{
                $save = Group::where(['id'=>$request->groupId])->update([
                    'group'=>$request->groupName,
                ]);
                if($save){return $this->ReturnSucsess('true', 'Updated Ggroup');}
            }break;
            case 'del':{
                $save = Group::where(['id'=>$request->groupId])->delete();
                if($save){return $this->ReturnSucsess('true', 'Delete Ggroup');}
            }
            break;
        }
    }

    #################### CopyRight Page ###########################
    public function save_copy(Request $request){
        $del = CopyRight::truncate();
        $save = CopyRight::create([
            'name'=>$request->copy,
        ]);
        if($save){return $this->ReturnSucsess('true', 'Saved CopyRight');}
    }

    #################### About Page ###########################
    public function save_about(Request $request){
        $data = About::get()->all();
        $image = '';
        $file  = '';
        if ($request->image != null) {
            $file = new Filesystem;
            $file->cleanDirectory('Admin/About');
            $file = $this->saveimage($request->image, 'Admin/About');
        }
        if(!empty($data)){
            $image = $data[0]->image;
        }else{
            $image = $file;
        }
        $del = About::truncate();
        $save = About::create([
            'image'=>$file,
            'name' =>$request->brand,
            'disc' =>$request->disc,
        ]);
        if($save){return $this->ReturnSucsess('true', 'Saved About');}
    }

    ################################ SAve Project ################################
    public function save_project(Request $request){
      return $request;
    }
}
