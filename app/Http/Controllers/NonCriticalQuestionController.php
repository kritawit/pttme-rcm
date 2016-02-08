<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use App\RefNonCriticalQuestion;

use Input;
use Redirect;
use View;
use Validator;
use Session;
use Auth;

class NonCriticalQuestionController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		$noncriticalquestion = RefNonCriticalQuestion::where('project_id','=',Session::get('project_id'))
				->where('active','=',1)
				->get();
		return View::make('reference_data.non_critical_question.index')->with('noncriticalquestion',$noncriticalquestion);
	}

	public function postAdd(){
		$validator = Validator::make(Input::all(),RefNonCriticalQuestion::$rules);
		if ($validator->passes()) {

			$noncriticalquestion = new RefNonCriticalQuestion;
			$noncriticalquestion->questions = Input::get('questions');
			$noncriticalquestion->created_by = Auth::user()->id;
			$noncriticalquestion->project_id = Session::get('project_id');
			$noncriticalquestion->save();

			return Redirect::to('reference-data/non-critical-question')->with('message','Non Critical Question Created');
		}

		return Redirect::to('reference-data/non-critical-question')
			->withErrors($validator)->withInput();
	}

	public function getEdit(){
		$data = array();
		$data = RefNonCriticalQuestion::find(Input::get('id'));
		return View::make('reference_data.non_critical_question.edit')->with('data',$data);
	}

	public function postUpdate(){
		$noncriticalquestion = RefNonCriticalQuestion::find(Input::get('id'));
		$input=array();
		$input['updated_by'] = Auth::user()->id;
		$noncriticalquestion->update(Input::all());
		return Redirect::to('reference-data/non-critical-question')->with('message','Non Critical Question Updated');
	}

	public function getDestroy(){
		$noncriticalquestion = RefNonCriticalQuestion::find(Input::get('id'));
		$input=array();
		$input['updated_by'] = Auth::user()->id;
		$input['active'] = 0;
		$noncriticalquestion->update($input);
		return Redirect::to('reference-data/non-critical-question');
	}

}
