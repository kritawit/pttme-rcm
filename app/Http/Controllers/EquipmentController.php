<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RefCategory;
use App\RefType;
use App\RefPart;

// use Illuminate\Http\Request;
use Input;
use Redirect;
use View;
use Validator;
use Session;
use Auth;

class EquipmentController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getCategory(){

		return View::make('reference_data.equipment.category')
			->with('category',RefCategory::where('project_id','=',Session::get('project_id'))->
				where('active','=',1)->orderBy('description')->get());
	}

	public function postCategory(){
		$validator = Validator::make(Input::all(),RefCategory::$rules);
		if ($validator->passes()) {
			$checked = RefCategory::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$category = new RefCategory;
				$category->description = Input::get('description');
				$category->created_by = Auth::user()->id;
				$category->project_id = Session::get('project_id');
				$category->save();
				return Redirect::to('reference-data/equipment/category')->with('message','Equipment Category Created');
			}else{
				return Redirect::back()->withErrors('Equipment category duplicate!');
			}
		}

		return Redirect::to('reference-data/equipment/category')
			->withErrors($validator)->withInput();
	}
	public function postEditcategory(){
		$cate = RefCategory::find(Input::get('id'));
		return View::make('reference_data.equipment.edit-category', compact('cate'));
	}
	public  function postUpdatecategory(){
		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefCategory::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$category = RefCategory::find(Input::get('id'));
   			$category->update($input);
   			return Redirect::to('reference-data/equipment/category');
		}else{
			return Redirect::to('reference-data/equipment/category')
			->withErrors('Equipment category duplicate!');
		}
	}
	public function postDestroycategory(){
		$category = RefCategory::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$category->update($input);
		echo "success";
	}

	public function getType(){
		return View::make('reference_data.equipment.type')
			->with('types',RefType::where('project_id','=',Session::get('project_id'))
				->where('active','=',1)
				->orderBy('description')
				->get());
	}

	public function postType(){

		$validator = Validator::make(Input::all(),RefType::$rules);
		if ($validator->passes()) {
			$checked = RefType::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$type = new RefType;
				$type->description = Input::get('description');
				$type->created_by = Auth::user()->id;
				$type->project_id = Session::get('project_id');
				$type->save();
				return Redirect::to('reference-data/equipment/type')->with('message','Equipment Type Created');
			}else{
				return Redirect::back()->withErrors('Equipment type duplicate!');
			}
		}

		return Redirect::to('reference-data/equipment/type')
			->withErrors($validator)->withInput();
	}

	public function postEdittype(){
		$type = RefType::find(Input::get('id'));
		return View::make('reference_data.equipment.edit-type', compact('type'));
	}

	public function postUpdatetype(){
		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefType::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$type = RefType::find(Input::get('id'));
   			$type->update($input);
   			return Redirect::to('reference-data/equipment/type');
		}else{
			return Redirect::to('reference-data/equipment/type')
			->withErrors('Equipment type duplicate!');
		}
	}

	public function postDestroytype(){
		$type = RefType::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$type->update($input);
		echo "success";
	}

	public function getPart(){

		return View::make('reference_data.equipment.part')
			->with('parts',RefPart::where('project_id','=',Session::get('project_id'))
				->where('active','=',1)->get());
	}

	public function postPart(){

		$validator = Validator::make(Input::all(),RefPart::$rules);
		if ($validator->passes()) {
			$checked = RefPart::where('description','=',Input::get('description'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$type = new RefPart;
				$type->description = Input::get('description');
				$type->created_by = Auth::user()->id;
				$type->project_id = Session::get('project_id');
				$type->save();
				return Redirect::to('reference-data/equipment/part')->with('message','Equipment Part Created');
			}else{
				return Redirect::back()->withErrors('Equipment part duplicate!');
			}
		}
		return Redirect::to('reference-data/equipment/part')
			->withErrors($validator)->withInput();

	}

	public function postEditpart(){
		$part = RefPart::find(Input::get('id'));
		return View::make('reference_data.equipment.edit-part', compact('part'));
	}

	public function postUpdatepart(){
   		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = RefPart::where('id','!=',Input::get('id'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$type = RefPart::find(Input::get('id'));
   			$type->update($input);
   			return Redirect::to('reference-data/equipment/part');
		}else{
			return Redirect::to('reference-data/equipment/part')
			->withErrors('Equipment part duplicate!');
		}
	}

	public function postDestroypart(){
		$type = RefPart::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$type->update($input);
		echo "success";
	}
}
