<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PackageAssumption;
// use Illuminate\Http\Request;

use Input;
use View;
use Redirect;
use Session;
use Validator;
use Auth;

class PackageAssumptionController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		$package = PackageAssumption::where('project_id','=',Session::get('project_id'))
				->where('active','=',1)
				->get();
		return View::make('package_assumption.index')->with('package',$package);
	}

	public function postPackage(){
		$validator = Validator::make(Input::all(),PackageAssumption::$rules);
		if ($validator->passes()) {
			$checked = PackageAssumption::where('description','=',Input::get('description'))
					->where('name','=',Input::get('name'))
					->where('project_id','=',Session::get('project_id'))
					->where('active','=',1)
					->get();
			if ($checked->isEmpty()) {
				$pack = new PackageAssumption;
				$pack->name = Input::get('name');
				$pack->description = Input::get('description');
				$pack->created_by = Auth::user()->id;
				$pack->project_id = Session::get('project_id');
				$pack->save();
				return Redirect::to('package-assumption')->with('message','Package Assumption Created');
			}else{
				return Redirect::back()->withErrors('Package Assumption duplicate!');
			}
		}
		return Redirect::to('package-assumption')
			->withErrors($validator)->withInput();
	}

	public function postEditpackage(){
		$package = PackageAssumption::find(Input::get('id'));
		return View::make('package_assumption.edit-package', compact('package'));
	}

	public function postDestroypackage(){
		$package = PackageAssumption::find(Input::get('id'));
		$input=array();
		$input['active'] = 0;
		$input['updated_by'] = Auth::user()->id;
		$package->update($input);
		echo "success";
	}

	public function postUpdatepackage(){
		$input = Input::all();
		$input['updated_by'] = Auth::user()->id;
		$check = PackageAssumption::where('id','!=',Input::get('id'))
					->where('name','=',Input::get('name'))
					->where('description','=',Input::get('description'))
					->where('active','=',1)
					->where('project_id','=',Session::get('project_id'))
					->get();
		if($check->isEmpty()){
			$category = PackageAssumption::find(Input::get('id'));
   			$category->update($input);
   			return Redirect::to('package-assumption');
		}else{
			return Redirect::to('package-assumption')
			->withErrors('Package Assumption duplicate!');
		}
	}

}
