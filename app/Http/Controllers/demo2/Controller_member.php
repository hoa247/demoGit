<?php

namespace App\Http\Controllers\demo2;

use Request;
use App\Http\Controllers\Controller;
use DB;
use App\M_member;
use Session;
use App\Http\Requests\AddMember;
use App\Http\Requests\editMember;

class Controller_member extends Controller
{
    public function list_member(){
        if(Session::has('sort'))
            $sort = Session::get('sort');
        else
            $sort = 'id';
    	$data['arr'] = M_member::orderBy($sort, 'desc')->paginate(7);
    	return view('demo2.home',$data);
    }
     public function load_member(){
        if(Session::has('sort'))
            $sort = Session::get('sort');
        else
            $sort = 'id';
        $data['arr'] = M_member::orderBy($sort, 'desc')->paginate(7);
        $data['arr']->withPath('');
        $view = view('demo2.table',$data)->render();
        return response()->json($view);
        
    }
    public function sort(){
        $sort=Request::get('sort');
        Session::put('sort',$sort);
        echo Session::get('sort');
    }
    public function add_ajax(AddMember $request){
        $c_name=Request::get('c_name');
        $c_address=Request::get('c_address');
        $c_age=Request::get('c_age');
        $c_photo =" ";
        if(Request::hasFile('c_photo')){
            $c_photo = Request::file('c_photo')->getClientOriginalName();
            $c_photo = time()."_".$c_photo;
            Request::file('c_photo')->move('demo2/images',$c_photo);
        }
        $member = new M_member;
        $member->c_name =  $c_name;
        $member->c_address = $c_address;
        $member->c_age = $c_age;
        $member->c_photo = $c_photo;
        $member->save();
        return 'add_success';
    }
    public function edit_ajax($id,editMember $request){
        $c_name=Request::get('c_name');
        $c_address=Request::get('c_address');
        $c_age=Request::get('c_age');
        M_member::where('id', $id)->update(array('c_name'=>$c_name,'c_address'=>$c_address,'c_age'=>$c_age));

         if(Request::hasFile('c_photo')){
            $arr =  M_member::where('id', $id)->first();
            $old_photo = isset($arr->c_photo)?$arr->c_photo:"";
            if(file_exists('demo2/images/'.$old_photo) && $old_photo!=""){
                unlink('demo2/images/'.$old_photo);   
            }
            $c_photo = Request::file('c_photo')->getClientOriginalName();
            $c_photo = time()."_".$c_photo;
            Request::file('c_photo')->move('demo2/images',$c_photo);
            M_member::where('id', $id)->update(array('c_photo'=>$c_photo));
         }
        return 'edit_success';

    }
    public function delete_member(){
        $id=Request::get('id');
        $arr = M_member::find($id);
        $old_photo = isset($arr->c_photo) ? $arr->c_photo : "";
        if(file_exists('demo2/images/'.$old_photo) && $old_photo!="")
                unlink('demo2/images/'.$old_photo);
        $arr->delete();
        return 'delete_success';
    }
    public function edit_member(){
    	$id=Request::get('id');
        $arr =  M_member::where('id', $id)->first();
        echo json_encode($arr);
    }

}
