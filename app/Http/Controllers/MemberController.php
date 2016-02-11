<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Member;

// use Illuminate\Http\Request;
use View;
use Input;
use Redirect;
use Validator;
use Auth;
use Session;

class MemberController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
        $this->beforeFilter('csrf',array('on'=>'post'));
    }

    public function getList(){
        $items = Member::where('active','=',1)
            ->get();
        $member = new Member;
        $roles = $member->Roles();
        return View::make('member.list')->with('items',$items)->with('roles',$roles);
    }

    public function postAdd(){
        $validator = Validator::make(Input::all(),Member::$rules);
        if ($validator->passes()) {
            $checked = Member::where('username','=',Input::get('username'))
                ->where('active','=',1)
                ->get();
            if ($checked->isEmpty()) {
                $item = new Member;
                $item->name = Input::get('name');
                $item->email = Input::get('email');
                $item->username = Input::get('username');
                $item->password = bcrypt(Input::get('password'));
                $item->role = Input::get('role');
                //$item->created_by = Auth::user()->id;
                $item->save();
                return Redirect::to('member/list')->with('message','Member Created');
            }else{
                return Redirect::back()->withErrors('Member duplicate!');
            }
        }
        return Redirect::to('member/list')
            ->withErrors($validator)->withInput();
    }

    public function postEdit(){
        $item = Member::find(Input::get('id'));
        $member = new Member;
        $roles = $member->Roles();
        return View::make('member.edit', compact('item'))->with('roles',$roles);
    }

    public  function postUpdate(){

        $input = Input::all();
        //$input['updated_by'] = Auth::user()->id;
        $check = Member::where('username','=',Input::get('username'))
            ->where('id','!=',Input::get('id'))
            ->where('active','=',1)
            ->get();
        if (Input::get('password') != Input::get('confirm_password')) {
            return Redirect::to('member/list')
                ->withErrors('Passwords do not match!');
        }
        if($check->isEmpty()){
            $item = Member::find(Input::get('id'));
            $p = array();
            $p['id'] = Input::get('id');
            $p['name'] = Input::get('name');
            $p['email'] = Input::get('email');
            $p['username'] = Input::get('username');
            if (Input::get('password') != '') {
                $p['password'] = bcrypt(Input::get('password'));
            }
            $p['role'] = Input::get('role');
            $item->update($p);
            return Redirect::to('member/list');
        }else{
            return Redirect::to('member/list')
                ->withErrors('Member duplicate!');
        }
    }

    public function postDestroy(){
        $item = Member::find(Input::get('id'));
        $input=array();
        $input['active'] = 0;
        //$input['updated_by'] = Auth::user()->id;
        $item->update($input);
        echo "success";
    }

}