<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RefCategory;
use App\RefPart;
use App\RefType;
use App\BasicEquipment;

use App\BasicFailure;
use App\RefFailureMode;
use App\RefFailureCause;

use App\RefTaskType;
use App\RefTaskList;
use App\BasicTask;

use App\RefTaskInterval;

// use Illuminate\Http\Request;
use App\Project;
use View;
use Input;
use Redirect;
use Validator;
use Auth;
use Session;

class DashBoardController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct()
    {
        $this->middleware('auth');
        $this->beforeFilter('csrf',array('on'=>'post'));
    }
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $project = Project::where('created_by','=',Auth::user()->id)
                ->where('active','=',1)
                ->get();
        return View::make('dashboard')->with('project',$project);
    }
    public function postOpenproject(){
        $project = Project::where('id','=',Input::get('id'))->get();
        Session::put('project_id',$project[0]['id']);
        Session::put('project',$project[0]['name']);
        return Redirect::to('dash-board/home')->with('message','Open project : '.$project[0]['name']);
    }

    public function getHome(){
        return View::make('home');
    }


    public function postNewproject(){
        $validator = Validator::make(Input::all(),Project::$rules);
        if ($validator->passes()) {
            $project = Project::where('created_by','=',Auth::user()->id)
                ->where('name','=',Input::get('name'))
                ->where('active','=',1)
                ->get();
            if (!$project->isEmpty()) {
                return Redirect::to('dash-board')->with('message_error','Project duplicate !');
            }else{
                $project = new Project;
                $project->name = Input::get('name');
                $project->member_id = Auth::user()->id;
                $project->created_by = Auth::user()->id;
                $project->save();
                Session::put('project_id',$project->id);
                Session::put('project',$project->name);
                return Redirect::to('dash-board')->withSuccess('Project Created');
            }
        }
        return Redirect::to('dash-board')
            ->withErrors($validator)->withInput();
    }

    public function postDestroyproject(){

        $project = Project::find(Input::get('id'));
        if ($project) {
            $data = array(
                'active' => 0
            );
            $project->update($data);
            if (Input::get('id') == Session::get('project_id')) {
                Session::forget('project_id');
            }
            return Redirect::to('dash-board');
        }
        return Redirect::to('dash-board')
            ->with('message','Something went wrong, please try again');
    }

    public function postDupproject(){

        $validator = Validator::make(Input::all(),Project::$rules);
        if ($validator->passes()) {
            $project = Project::where('created_by','=',Auth::user()->id)
                ->where('name','=',Input::get('name'))
                ->where('active','=',1)
                ->get();
            if (!$project->isEmpty()) {
                return Redirect::to('dash-board')->with('message_error','Project duplicate !');
            }else{
                $project = new Project;
                $project->name = Input::get('name');
                $project->member_id = Auth::user()->id;
                $project->created_by = Auth::user()->id;
                $project->save();

                $project_id = Input::get('project_id');

                $basic_equipment = BasicEquipment::where('project_id','=',$project_id)
                            ->where('active','=',1)
                            ->get();

                $basic_failure = BasicFailure::where('project_id','=',$project_id)
                            ->where('active','=',1)
                            ->get();

                $basic_task = BasicTask::where('project_id','=',$project_id)
                            ->where('active','=',1)
                            ->get();

                $ref_task_interval = RefTaskInterval::where('project_id','=',$project_id)
                            ->where('active','=',1)
                            ->get();

                // Duplicate Basic Equipment
                if (!$basic_equipment->isEmpty()) {
                    foreach ($basic_equipment as $bq) {
                        $ref_cate = RefCategory::find($bq->category_id);
                        $category = new RefCategory;
                        $category->description = $ref_cate->description;
                        $category->created_by = Auth::user()->id;
                        $category->project_id = $project->id;
                        $category->save();

                        $ref_type = RefType::find($bq->type_id);
                        $type = new RefType;
                        $type->description = $ref_type->description;
                        $type->created_by = Auth::user()->id;
                        $type->project_id = $project->id;
                        $type->save();

                        $ref_part = RefPart::find($bq->part_id);
                        $part = new RefPart;
                        $part->description = $ref_part->description;
                        $part->created_by = Auth::user()->id;
                        $part->project_id = $project->id;
                        $part->save();

                        $basic_eq = new BasicEquipment;
                        $basic_eq->category_id = $category->id;
                        $basic_eq->type_id = $type->id;
                        $basic_eq->part_id = $part->id;
                        $basic_eq->created_by = Auth::user()->id;
                        $basic_eq->project_id = $project->id;
                        $basic_eq->save();
                    }
                }

                // Duplicate Basic Failure
                if (!$basic_failure->isEmpty()) {
                    foreach ($basic_failure as $bf) {
                        $mode = RefFailureMode::find($bf->mode_id);
                        $f_mode = new RefFailureMode;
                        $f_mode->description = $mode->description;
                        $f_mode->created_by = Auth::user()->id;
                        $f_mode->project_id = $project->id;
                        $f_mode->save();

                        $cause = RefFailureCause::find($bf->cause_id);
                        $f_cause = new RefFailureCause;
                        $f_cause->description = $cause->description;
                        $f_cause->created_by = Auth::user()->id;
                        $f_cause->project_id = $project->id;
                        $f_cause->save();

                        $basic_f = new BasicFailure;
                        $basic_f->mode_id = $f_mode->id;
                        $basic_f->cause_id = $f_cause->id;
                        $basic_f->created_by = Auth::user()->id;
                        $basic_f->project_id = $project->id;
                        $basic_f->save();
                    }
                }

                // Duplication Basic Task

                if(!$basic_task->isEmpty()){
                    foreach ($basic_task as $bt) {
                        $basic_tk = new BasicTask;

                        $cause_t = RefFailureCause::where('id','=',$bt->cause_id)
                                ->where('project_id','=',$project->id)
                                ->where('active','=',1)
                                ->get();

                        // print_r($cause_t);
                        if($cause_t->isEmpty()){
                            $cause_ft = RefFailureCause::find($bt->cause_id);
                            $f_cause_t = new RefFailureCause;
                            $f_cause_t->description = $cause_ft->description;
                            $f_cause_t->created_by = Auth::user()->id;
                            $f_cause_t->project_id = $project->id;
                            $f_cause_t->save();
                            $basic_tk->cause_id = $f_cause_t->id;
                        }else{
                            $basic_tk->cause_id = $cause_t->id;
                        }

                        $task_tp = RefTaskType::find($bt->type_id);
                        $tk_type = new RefTaskType;
                        $tk_type->description = $task_tp->description;
                        $tk_type->created_by = Auth::user()->id;
                        $tk_type->project_id = $project->id;
                        $tk_type->save();
                        $basic_tk->type_id = $tk_type->id;

                        $task_lt = RefTaskList::find($bt->list_id);
                        $tk_list = new RefTaskList;
                        $tk_list->description = $task_lt->description;
                        $tk_list->created_by = Auth::user()->id;
                        $tk_list->project_id = $project->id;
                        $tk_list->save();
                        $basic_tk->list_id = $tk_list->id;

                        $basic_tk->created_by = Auth::user()->id;
                        $basic_tk->project_id = $project->id;
                        $basic_tk->save();
                    }
                }

                if(!$ref_task_interval->isEmpty()){
                    foreach ($ref_task_interval as $t_inter) {
                        $tk_inter = new RefTaskInterval;
                        $tk_inter->interval = $t_inter->interval;
                        $tk_inter->description = $t_inter->description;
                        $tk_inter->created_by = Auth::user()->id;
                        $tk_inter->project_id = $project->id;
                        $tk_inter->save();
                    }
                }

                Session::put('project_id',$project->id);
                Session::put('project',$project->name);
                return Redirect::to('dash-board')->withSuccess('Duplicate Project Success.');
            }
        }
        return Redirect::to('dash-board')
            ->withErrors($validator)->withInput();
    }
}
