<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\CopyRight;
use App\Models\About;
use App\Models\Project;
use App\Models\Contact;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;


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
        $contacts = Contact::orderBy('id', 'DESC')->get()->all();
        return view('admin.contact',compact('contacts'));
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
        $groups = Group::get()->all();
        if(!empty($groups)){
            $projects = Project::where('groupid',$groups[0]->id)->select(['id','title'])->get();
        }else{
            $projects =[];
        }
        return view('admin.project',compact('groups','projects'));

    }
    public function details(){
        $projects = Project::select(['id','title'])->get()->all();
        return view('admin.details_project',compact('projects'));
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
        // get Group
        $group = Group::where(['id'=>$request->group])->first();
        if ($request->thumbnail != null) {
            $file = new Filesystem;
            $file = $this->saveimage($request->thumbnail, 'Admin/Projects');
        }
        $save_project = Project::create([
            'title'     => $request->label,
            'disc'      => $request->disc,
            'groupid'   => $group->id,
            'groupname' => $group->group,
            'image'     => $file
        ]);
        if($save_project){
            return $this->ReturnSucsess('true', 'Saved Project');
        }
    }
    #################### Search Project ##########################
    public function save_all_search(Request $request){
        $projects = Project::where('groupid',$request->group)->select(['id','title'])->get();
        return $this->ReturnSucsess('true', $projects);
    }

    ########################## Update Project ######################
    public function update_project(Request $request){
        $group = Group::where(['id'=>$request->group])->first();
        if ($request->thumbnail != null) {
            $file = new Filesystem;
            $file = $this->saveimage($request->thumbnail, 'Admin/Projects');
        }else{
            $save_project = Project::create([
                'title'     => $request->label,
                'disc'      => $request->disc,
                'groupid'   => $group->id,
                'groupname' => $group->group,
                'image'     => $file
            ]);
        }
    }
    ######################## Delete Project #########################
    public function delete_project(Request $request){
        $project = Project::where(['id'=>$request->project])->select(['image'])->first();
        $image_path = 'Admin/Projects/'. $project->image;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $save = Project::where(['id'=>$request->project])->delete();
        if($save){return $this->ReturnSucsess('true', 'Deleted Project');}
    }

    ######################### Delete Contact ############################
    public function delete_contact(Request $request){
        $contacts = Contact::where('id', $request->cardId)->delete();
        if($contacts){return $this->ReturnSucsess('true', 'Deleted Message');}
    }
}
