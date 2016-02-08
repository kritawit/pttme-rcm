<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use App\RefOrderType;

use Input;
use Redirect;
use View;
use Validator;
use Session;
use Auth;

class OrderTypeController extends Controller {

	public function getIndex(){
		$ordertype = RefOrderType::where('project_id',Session::get('project_id'))
				->where('active',1)
				->orderBy('description')
				->get();
		return View::make('reference_data.order_type.index')->with('ordertype',$ordertype);
	}

	public function postAdd(){
		$validator = Validator::make(Input::all(),RefOrderType::$rules);
		if ($validator->passes()) {

			$noncriticalquestion = new RefOrderType;
			$noncriticalquestion->name = Input::get('name');
			$noncriticalquestion->description = Input::get('description');
			$noncriticalquestion->created_by = Auth::user()->id;
			$noncriticalquestion->project_id = Session::get('project_id');
			$noncriticalquestion->save();

			return Redirect::to('reference-data/order-type')->with('message','Order Type Created');
		}

		return Redirect::to('reference-data/order-type')
			->withErrors($validator)->withInput();
	}

	public function getEdit(){
		$data = array();
		$data = RefOrderType::find(Input::get('id'));
		return View::make('reference_data.order_type.edit')->with('data',$data);
	}

	public function postUpdate(){
		$ordertype = RefOrderType::find(Input::get('id'));
		$input=array();
		$input['updated_by'] = Auth::user()->id;
		$ordertype->update(Input::all());
		return Redirect::to('reference-data/order-type')->with('message','Order Type Updated');
	}

	public function getDestroy(){
		$ordertype = RefOrderType::find(Input::get('id'));
		$input=array();
		$input['updated_by'] = Auth::user()->id;
		$input['active'] = 0;
		$ordertype->update($input);
		return Redirect::to('reference-data/order-type');
	}
}
