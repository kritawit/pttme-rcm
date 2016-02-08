<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RefFailureMode;
use App\RefFailureCause;
// use Illuminate\Http\Request;
use Input;
use Redirect;
use View;
use Validator;
use Session;
use Auth;

class FailureController extends Controller {
	public function __construct()
	{
		$this->middleware('auth');
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getMode(){
		$mode = RefFailureMode::where('project_id','=',Session::get('project_id'))
				->where('active','=',1)
				->orderBy('description')
				->get();
		return View::make('reference_data.failure.mode')->with('modes',$mode);
	}

	public function postMode(){
		$validator = Validator::make(Input::all(),RefFailureMode::$rules);
		if ($validator->passes()) {
			$checked = RefFailureMode::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$mode = new RefFailureMode;
				$mode->description = Input::get('description');
				$mode->created_by = Auth::user()->id;
				$mode->project_id = Session::get('project_id');
				$mode->save();
				return Redirect::to('reference-data/failure/mode')->with('message','Failure Mode Created');
			}else{
				return Redirect::back()->withErrors('Failure Mode duplicate!');
			}
		}
		return Redirect::to('reference-data/failure/mode')
			->withErrors($validator)->withInput();
	}

	public function postEditmode(){
		$mode = RefFailureMode::find(Input::get('id'));
		return View::make('reference_data.failure.edit-mode', compact('mode'));
	}

	public  function postUpdatemode(){

   		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefFailureMode::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$mode = RefFailureMode::find(Input::get('id'));
   			$mode->update($input);
   			return Redirect::to('reference-data/failure/mode');
		}else{
			return Redirect::to('reference-data/failure/mode')
			->withErrors('Failure Mode duplicate!');
		}
	}

	public function postDestroymode(){
		$mode = RefFailureMode::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$mode->update($input);
		echo "success";
	}

////Cause

	public function getCause(){
		$mode = RefFailureCause::where('project_id','=',Session::get('project_id'))
				->where('active','=',1)
				->orderBy('description')
				->get();
		return View::make('reference_data.failure.cause')->with('causes',$mode);
	}

	public function postCause(){
		$validator = Validator::make(Input::all(),RefFailureCause::$rules);
		if ($validator->passes()) {
			$checked = RefFailureCause::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$cause = new RefFailureCause;
				$cause->description = Input::get('description');
				$cause->created_by = Auth::user()->id;
				$cause->project_id = Session::get('project_id');
				$cause->save();
				return Redirect::to('reference-data/failure/cause')->with('message','Failure Cause Created');
			}else{
				return Redirect::back()->withErrors('Failure Cause duplicate!');
			}
		}
		return Redirect::to('reference-data/failure/cause')
			->withErrors($validator)->withInput();
	}

	public function postEditcause(){
		$cause = RefFailureCause::find(Input::get('id'));
		return View::make('reference_data.failure.edit-cause', compact('cause'));
	}


	public  function postUpdatecause(){

   		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefFailureCause::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$cause = RefFailureCause::find(Input::get('id'));
   			$cause->update($input);
   			return Redirect::to('reference-data/failure/cause');
		}else{
			return Redirect::to('reference-data/failure/cause')
			->withErrors('Failure Mode duplicate!');
		}
	}
	public function postDestroycause(){
		$mode = RefFailureCause::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$mode->update($input);
		echo "success";
	}
}
