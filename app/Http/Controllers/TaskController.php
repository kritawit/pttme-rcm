<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use App\RefTaskType;
use App\RefTaskList;
use App\RefTaskInterval;

use Input;
use Redirect;
use View;
use Validator;
use Session;
use Auth;

class TaskController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getInterval(){
		$interval = RefTaskInterval::where('active','=',1)
			->where('project_id','=',Session::get('project_id'))->get();
		return View::make('reference_data.task.interval')->with('intervals',$interval);
	}
	public function postInterval(){
		$validator = Validator::make(Input::all(),RefTaskInterval::$rules);
		if ($validator->passes()) {
			$checked = RefTaskInterval::where('description','=',Input::get('description'))
					->where('interval','=',Input::get('interval'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$inter = new RefTaskInterval;
				$inter->interval = Input::get('interval');
				$inter->description = Input::get('description');
				$inter->created_by = Auth::user()->id;
				$inter->project_id = Session::get('project_id');
				$inter->save();
				return Redirect::to('reference-data/task/interval')->with('message','Task Interval Created');
			}else{
				return Redirect::back()->withErrors('Task Interval duplicate!');
			}
		}
		return Redirect::to('reference-data/task/interval')
			->withErrors($validator)->withInput();
	}

	public function postEditinterval(){
		$interval = RefTaskInterval::find(Input::get('id'));
		return View::make('reference_data.task.edit-interval', compact('interval'));
	}

	public function postUpdateinterval(){
   		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefTaskInterval::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('interval','=',Input::get('interval'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$inter = RefTaskInterval::find(Input::get('id'));
   			$inter->update($input);
   			return Redirect::to('reference-data/task/interval');
		}else{
			return Redirect::to('reference-data/task/interval')
			->withErrors('Task Interval duplicate!');
		}
	}

	public function postDestroyinterval(){
		$interval = RefTaskInterval::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$interval->update($input);
		echo "success";
	}

	///////////////// Type

	public function getType(){
		$type = RefTaskType::where('active','=',1)
			->where('project_id','=',Session::get('project_id'))->get();
		return View::make('reference_data.task.type')->with('types',$type);
	}

	public function postType(){
		$validator = Validator::make(Input::all(),RefTaskType::$rules);
		if ($validator->passes()) {
			$checked = RefTaskType::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$type = new RefTaskType;
				$type->description = Input::get('description');
				$type->created_by = Auth::user()->id;
				$type->project_id = Session::get('project_id');
				$type->save();
				return Redirect::to('reference-data/task/type')->with('message','Task Type Created');
			}else{
				return Redirect::back()->withErrors('Task Type duplicate!');
			}
		}
		return Redirect::to('reference-data/task/type')
			->withErrors($validator)->withInput();
	}

	public function postEdittype(){
		$type = RefTaskType::find(Input::get('id'));
		return View::make('reference_data.task.edit-type', compact('type'));
	}

	public function postUpdatetype(){
   		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefTaskType::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$cause = RefTaskType::find(Input::get('id'));
   			$cause->update($input);
   			return Redirect::to('reference-data/task/type');
		}else{
			return Redirect::to('reference-data/task/type')
			->withErrors('Failure Mode duplicate!');
		}
	}

	public function postDestroytype(){

		$type = RefTaskType::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$type->update($input);
		echo "success";
	}

// List
	public function getList(){
		$list = RefTaskList::where('active','=',1)
			->where('project_id','=',Session::get('project_id'))->get();
		return View::make('reference_data.task.list')->with('lists',$list);
	}

	public function postList(){

		$validator = Validator::make(Input::all(),RefTaskList::$rules);
		if ($validator->passes()) {
			$checked = RefTaskList::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$list = new RefTaskList;
				$list->description = Input::get('description');
				$list->created_by = Auth::user()->id;
				$list->project_id = Session::get('project_id');
				$list->save();
				return Redirect::to('reference-data/task/list')->with('message','Task List Created');
			}else{
				return Redirect::back()->withErrors('Task List duplicate!');
			}
		}
		return Redirect::to('reference-data/task/list')
			->withErrors($validator)->withInput();
	}

	public function postEditlist(){
		$list = RefTaskList::find(Input::get('id'));
		return View::make('reference_data.task.edit-list', compact('list'));
	}

	public function postUpdatelist(){
   		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefTaskList::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$list = RefTaskList::find(Input::get('id'));
   			$list->update($input);
   			return Redirect::to('reference-data/task/list');
		}else{
			return Redirect::to('reference-data/task/list')
			->withErrors('Task List duplicate!');
		}
	}

	public function postDestroylist(){

		$type = RefTaskList::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$type->update($input);
		echo "success";
	}

}
