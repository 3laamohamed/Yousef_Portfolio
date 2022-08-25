<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\counter_visitor;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewabout(){
        $data = About::get()->first();
        return view('admin.about',compact('data'));
    }
    public function clients(){
        $clients = Client::orderBy('id', 'DESC')->get()->all();
        return view('admin.clients',compact('clients'));
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
        if(Social::get()->count() > 0){
            $social = Social::get()->first();
        }else{
            $social = [];
        }
        return view('admin.general',compact('social'));
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
        if(!empty($projects)){
            $sections = Section::where('project_id',$projects[0]->id)->select(['id','name'])->get();
        }else{
            $sections = [];
        }
        return view('admin.details_project',compact('projects','sections'));
    }

    public function reg(){
        return view('auth.register');
    }

    public function services(){
        $services = Services::orderBy('id', 'DESC')->get()->all();
        return view('admin.services',compact('services'));
    }

    function ReturnSucsess($status , $msg){
        return response()->json([
            'status' => $status ,
            'msg'    => $msg ,
        ]);
    }

    function View_data(){
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d");
        $counter = counter_visitor::where(['date'=>$date])->orderBy('id', 'DESC')->get();
        $data = DataSheet::get()->first();
        return view('admin.datasheet',compact('data','counter'));
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
                if($save){return $this->ReturnSucsess('true', $save->id);}
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
        $data = About::get()->first();
        if($data){
        $file  = $data->image;
        $logo = $data->logo;
        }
        if ($request->image != null) {
            if(isset($file)){
            $image_path = 'Admin/About/'.$file;
            File::delete($image_path);
            }
            $file = new Filesystem;
            $file = $this->saveimage($request->image, 'Admin/About');
        }
        if ($request->logo != null) {
            if(isset($logo)){
            $image_path = 'Admin/About/'.$logo;
            File::delete($image_path);
            }
            $logo = new Filesystem;
            $logo = $this->saveimage($request->logo, 'Admin/About');
        }
        $del  = About::truncate();
        $save = About::create([
            'image'=>$file,
            'name' =>$request->brand,
            'disc' =>$request->disc,
            'logo' =>$logo
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
            $get_data = DataSheet::get()->first();
            $update_data = DataSheet::where(['id'=>$get_data->id])->update([
                'projects'=>$get_data->projects + 1,
            ]);
            return $this->ReturnSucsess('true', $save_project->id);
        }
    }
    #################### Search Project ##########################
    public function save_all_search(Request $request){
        $projects = Project::where('groupid',$request->group)->select(['id','title'])->get();
        return $this->ReturnSucsess('true', $projects);
    }

    ################################### Get Update Project #######################
    public function get_update_project(Request $request){
      $project = Project::limit(1)->where('id',$request->id)->first();
      if($project){return $this->ReturnSucsess('true',$project);}
    }

    ########################## Update Project ######################
    public function update_project(Request $request){
        $project = Project::limit(1)->where(['id'=>$request->project_id])->first();
        if($request->thumbnail == null){
            $update = Project::limit(1)->where(['id'=>$request->project_id])->update([
                'title' => $request->label,
                'disc' => $request->disc,
            ]);
            if($update){return $this->ReturnSucsess('true', 'Updated Project');}
        }else{
            $image_path = 'Admin/Projects/'. $project->image;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $file = new Filesystem;
            $file = $this->saveimage($request->thumbnail, 'Admin/Projects');
            $update = Project::limit(1)->where(['id'=>$request->project_id])->update([
                'title' => $request->label,
                'disc' => $request->disc,
                'image' =>$file
            ]);
            if($update){return $this->ReturnSucsess('true', 'Updated Service');}
        }

    }
    ######################## Delete Project #########################
    public function delete_project(Request $request){
        if(Section::where(['project_id'=>$request->project])->count() == 0){
        $project = Project::where(['id'=>$request->project])->select(['image'])->first();
        $image_path = 'Admin/Projects/'. $project->image;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $save = Project::where(['id'=>$request->project])->delete();
        if($save){return $this->ReturnSucsess('true', 'Deleted Project');}
        }else{
            return $this->ReturnSucsess('wornning', 'Cannot Delete Project');

        }
    }

    ######################### Delete Contact ############################
    public function delete_contact(Request $request){
        $contacts = Contact::where('id', $request->cardId)->delete();
        if($contacts){return $this->ReturnSucsess('true', 'Deleted Message');}
    }

    ######################### save_details_project #########################
    public function save_details_project(Request $request){
        // Save Section
        $section = Section::create([
            'name' =>$request->label,
            'project_id'=>$request->project,
        ]);
        if($section){
            foreach($request->images as $image){
                $file = new Filesystem;
                $file = $this->saveimage($image, 'Admin/Details');
                $details = Details::create([
                    'image' =>$file,
                    'section_id'=>$section->id,
                ]);
            }
            if($details){return $this->ReturnSucsess('true', $section->id);}
        }
    }

    ########################## get_data_details #######################
    public function get_data_details(Request $request){
        $details = Details::where(['section_id'=>$request->id])->get();
        $section = Section::limit(1)->where(['id'=>$request->id])->first();
        return response()->json([
            'images'=>$details,
            'status'=>'true',
            'section' =>$section->name
        ]);
    }

    ################# update_image_details ####################
    public function update_image_details(Request $request){
        // update Section
        $update_section = Section::limit(1)->where(['id'=>$request->section_id])->update([
            'name'=>$request->label,
        ]);
        if(isset($request->images)){
            foreach($request->images as $image){
                $file = new Filesystem;
                $file = $this->saveimage($image, 'Admin/Details');
                $details = Details::create([
                    'image' =>$file,
                    'section_id'=>$request->section_id,
                ]);
            }
        }
        return $this->ReturnSucsess('true', 'Saved Updated');
    }

    #################### del_image_details ####################
    public function del_image_details(Request $request){
        $del = Details::where(['image'=>$request->image])->delete();
        $image_path = 'Admin/Details/'. $request->image;
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        if($del){return $this->ReturnSucsess('true', 'Deleted One Image');}
    }

    ########################### admin.search.all.section ##########################
    public function search_all_section(Request $request){
        $sections = Section::where('project_id',$request->project)->select(['id','name'])->get();
        return $this->ReturnSucsess('true', $sections);
    }

    ####################### Delete Section ####################################
    public function delete_section(Request $request){
        $sections = Details::where(['section_id'=>$request->section])->select(['image'])->get();
        foreach($sections as $section){
            $image_path = 'Admin/Details/'. $section->image;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
        }
        $del_details  = Details::where(['section_id'=>$request->section])->delete();
        $del_sections = Section::where(['id'=>$request->section])->delete();
        if($del_details && $del_sections){return $this->ReturnSucsess('true', 'Deleted Section');}
    }

    ############################# Save And Update Social Media #####################
    public function save_social(Request $request){
        if($data = Social::get()->count() >  0){
            $data = Social::get()->first();
            $update = Social::where(['id'=>$data->id])->update([
                'facebook'  =>$request->facebook,
                'gmail'     =>$request->gmail,
                'linkedin'  =>$request->linked_in,
                'whats'     =>$request->whatsapp,
                'twitter'   =>$request->twitter,
            ]);
            if($update){return $this->ReturnSucsess('true', 'Saved Social');}
        }else{
            $save = Social::create([
                'facebook'  =>$request->facebook,
                'gmail'     =>$request->gmail,
                'linkedin'  =>$request->linked_in,
                'whats'     =>$request->whatsapp,
                'twitter'   =>$request->twitter,
            ]);
            if($save){return $this->ReturnSucsess('true', 'Saved Social');}
        }
    }

    ########################## Save Client ######################
    public function save_client(Request $request){
        if($request->client != null){
            $file = new Filesystem;
            $file = $this->saveimage($request->client, 'Admin/Clients');
            $save = Client::create([
                'image' => $file,
            ]);
            if($save){return response()->json(['status'=>'true','id'=>$save->id,'image'=>$file]);}
        }
    }
    ###################### Delete Client #######################
    public function delete_client(Request $request){
        $client = Client::where(['id'=>$request->client])->first();
        $image_path = 'Admin/Clients/'. $client->image;
            File::delete($image_path);
            $delclient = Client::where(['id'=>$request->client])->delete();
            if($delclient){return $this->ReturnSucsess('true', 'Deleted Client');}

    }
    ########################## Save Service ###################
    public function save_service(Request $request){
        $file = new Filesystem;
        $file = $this->saveimage($request->image, 'Admin/Services');
        $save = Services::create([
            'image' => $file,
            'title'  =>$request->name,
            'disc'  =>$request->disc,
        ]);
        if($save){return $this->ReturnSucsess('true', $save->id);}
    }

    ###################### Delete Service ###############################
    public function delete_service(Request $request){
        $service = Services::where(['id'=>$request->service])->first();
        $image_path = 'Admin/Services/'. $service->image;
        if(File::exists($image_path)){
            File::delete($image_path);
            $delclient = Services::where(['id'=>$request->service])->delete();
            if($delclient){return $this->ReturnSucsess('true', 'Deleted service');}
        }
    }
    ###################### update_service ##################
    public function update_service(Request $request){
        $service = Services::limit(1)->where(['id'=>$request->service_id])->first();
        if($request->image == null){
            $update = Services::limit(1)->where(['id'=>$request->service_id])->update([
                'title' => $request->name,
                'disc' => $request->disc,
            ]);
            if($update){return $this->ReturnSucsess('true', 'Updated Service');}
        }else{
            $image_path = 'Admin/Services/'. $service->image;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $file = new Filesystem;
            $file = $this->saveimage($request->image, 'Admin/Services');
            $update = Services::limit(1)->where(['id'=>$request->service_id])->update([
                'title' => $request->name,
                'disc' => $request->disc,
                'image' =>$file
            ]);
            if($update){return $this->ReturnSucsess('true', 'Updated Service');}
        }
    }
    ###################### get_update_service #####################
    public function get_update_service(Request $request){
        $service = Services::limit(1)->where(['id'=>$request->id])->first();
        if($service){return $this->ReturnSucsess('true', $service);}
    }
    ######################## save_datasheet #####################
    public function save_datasheet(Request $request){
        $projects = 0;
        $visitors = 0;
        $data = DataSheet::get()->first();
        if($request->project =='on'){$projects=1;}
        if($request->visitors =='on'){$visitors=1;}
        $update = DataSheet::where(['id'=>$data->id])->update([
            'status_p'=>$projects,
            'status_v'=>$visitors,
        ]);
        if($update){return $this->ReturnSucsess('true', 'Saved Data');}

    }
    #################### search_counter ######################
    public function search_counter(Request $request){
        date_default_timezone_set("Africa/Cairo");
        $today     = date("Y-m-d");
        $lastday   = date("Y-m-d", strtotime("-1 days"));
        $lastWeek  = date("Y-m-d", strtotime("-7 days"));
        $lastWeek_2  = date("Y-m-d", strtotime("-14 days"));
        $lastmonth = date("Y-m-d", strtotime("-30 days"));
        $lasyear   = date("Y-m-d", strtotime("-365 days"));
        switch($request->type){
            case'custom':{
                $data = counter_visitor::whereBetween('date', array($request->from, $request->to))->orderBy('id', 'DESC')->get();
            }break;
            case'today':{
                $data = counter_visitor::where(['date'=>$today])->orderBy('id', 'DESC')->get();
            }break;
            case 'yesterday':{
                $data = counter_visitor::where(['date'=>$lastday])->orderBy('id', 'DESC')->get();
            }break;
            case 'this-week':{
                $data = counter_visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->orderBy('id', 'DESC')->get();
            }break;
            case 'last-week':{
                $data = counter_visitor::whereBetween('created_at',[Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->orderBy('id', 'DESC')->get();
            }break;
            case 'this-month':{
                $data = counter_visitor::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->orderBy('id', 'DESC')->get();            
            }break;
            case 'last-month':{
                $data = counter_visitor::whereBetween('created_at',[Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->orderBy('id', 'DESC')->get();
            }break;
            case 'this-year':{
                $data = counter_visitor::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                    ->orderBy('id', 'DESC')->get();            
            }break;
        }
        return $this->ReturnSucsess('true', $data);
    }
}
