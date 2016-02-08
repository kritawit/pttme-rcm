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
use App\RefNonCriticalQuestion;
use App\RefOrderType;
use App\RefTaskType;
use App\RefTaskList;
use App\BasicTask;
use App\RefTaskInterval;
use App\Project;
use App\RefTemp;
use App\AssetRegister;
use App\AssetBasicFailure;
use App\AssetComplexDetail;
use App\AssetQuestion;
use App\TaskSelection;
use App\PackageAssumption;

use View;
use Input;
use Redirect;
use Validator;
use Auth;
use Session;
use Excel;
use DB;
use Response;
use Zipper;
use File;

class ProjectController extends Controller {

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
        return View::make('project')->with('project',$project);
    }
    public function postOpenproject(){
        $project = Project::where('id','=',Input::get('id'))->get();
        Session::put('project_id',$project[0]['id']);
        Session::put('project',$project[0]['name']);
        return Redirect::to('project/home')->with('message','Open project : '.$project[0]['name']);
    }

    public function getHome(){
        return View::make('home');
    }


    public function postSaveproject(){
        if (!empty(Input::get('project_id'))) {
            $input = Input::all();
            $input['updated_by'] = Auth::user()->id;
            $data = Project::find(Input::get('project_id'));
            $data->update($input);
            

            return Redirect::to('project')->withSuccess('Update success!');

        }else{
            $validator = Validator::make(Input::all(),Project::$rules);
            if ($validator->passes()) {
                $project = Project::where('created_by','=',Auth::user()->id)
                ->where('name','=',Input::get('name'))
                ->where('active','=',1)
                ->get();
                if (!$project->isEmpty()) {
                    return Redirect::to('project')->with('message_error','Project duplicate !');
                }else{
                    $project = new Project;
                    $project->name = Input::get('name');
                    $project->member_id = Auth::user()->id;
                    $project->created_by = Auth::user()->id;
                    $project->save();


                $ref_cate = RefCategory::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_cate) {
                    foreach ($ref_cate as $non) {
                        $ref_cate = RefCategory::find($non->id);
                        $clone = $ref_cate->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefCategory::create($data);
                    }
                }




                $basic_equipment = BasicEquipment::where('type_use',1)
                    ->where('active',1)->get();
                if ($basic_equipment) {
                    foreach ($basic_equipment as $non) {
                        $basic_equipment = BasicEquipment::find($non->id);
                        $clone = $basic_equipment->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        BasicEquipment::create($data);
                    }
                }


                $basic_failure = BasicFailure::where('type_use',1)
                    ->where('active',1)->get();
                if ($basic_failure) {
                    foreach ($basic_failure as $non) {
                        $basic_failure = BasicFailure::find($non->id);
                        $clone = $basic_failure->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        BasicFailure::create($data);
                    }
                }


                $basic_task = BasicTask::where('type_use',1)
                    ->where('active',1)->get();
                if ($basic_task) {
                    foreach ($basic_task as $non) {
                        $basic_task = BasicTask::find($non->id);
                        $clone = $basic_task->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        BasicTask::create($data);
                    }
                }


                $ref_task_interval = RefTaskInterval::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_task_interval) {
                    foreach ($ref_task_interval as $non) {
                        $ref_task_interval = RefTaskInterval::find($non->id);
                        $clone = $ref_task_interval->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefTaskInterval::create($data);
                    }
                }



                


                $ref_type = RefType::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_type) {
                    foreach ($ref_type as $non) {
                        $ref_type = RefType::find($non->id);
                        $clone = $ref_type->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefType::create($data);
                    }
                }


                $ref_part = RefPart::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_part) {
                    foreach ($ref_part as $non) {
                        $ref_part = RefPart::find($non->id);
                        $clone = $ref_part->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefPart::create($data);
                    }
                }


                $ref_fail_mode = RefFailureMode::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_fail_mode) {
                    foreach ($ref_fail_mode as $non) {
                        $ref_fail_mode = RefFailureMode::find($non->id);
                        $clone = $ref_fail_mode->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefFailureMode::create($data);
                    }
                }



                $ref_fail_cause = RefFailureCause::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_fail_cause) {
                    foreach ($ref_fail_cause as $non) {
                        $ref_fail_cause = RefFailureCause::find($non->id);
                        $clone = $ref_fail_cause->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefFailureCause::create($data);
                    }
                }




                $ref_task_type = RefTaskType::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_task_type) {
                    foreach ($ref_task_type as $non) {
                        $ref_task_type = RefTaskType::find($non->id);
                        $clone = $ref_task_type->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefTaskType::create($data);
                    }
                }



                $ref_task_list = RefTaskList::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_task_list) {
                    foreach ($ref_task_list as $non) {
                        $ref_task_list = RefTaskList::find($non->id);
                        $clone = $ref_task_list->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefTaskList::create($data);
                    }
                }


                $ref_non_critical_question = RefNonCriticalQuestion::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_non_critical_question) {
                    foreach ($ref_non_critical_question as $non) {
                        $ref_non_critical_question = RefNonCriticalQuestion::find($non->id);
                        $clone = $ref_non_critical_question->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['type_use'] = 2;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefNonCriticalQuestion::create($data);
                    }
                }


                $ref_order_type = RefOrderType::where('type_use',1)
                    ->where('active',1)->get();
                if ($ref_order_type) {
                    foreach ($ref_order_type as $non) {
                        $ref_order_type = RefOrderType::find($non->id);
                        $clone = $ref_order_type->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id'],$clone['type_use']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefOrderType::create($data);
                    }
                }

                    Session::put('project_id',$project->id);
                    Session::put('project',$project->name);
                    return Redirect::to('project')->withSuccess('Project Created');
                }
            }
        }
        return Redirect::to('project')
            ->withErrors($validator)->withInput();
    }

    public function getDestroyproject(){

        $project = Project::find(Input::get('id'));
        if ($project) {
            $data = array(
                'active' => 0
            );
            $project->update($data);
            if (Input::get('id') == Session::get('project_id')) {
                Session::forget('project_id');
            }
            return Redirect::to('project');
        }
        return Redirect::to('project')
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
                return Redirect::to('project')->with('message_error','Project duplicate !');
            }else{
                $project = new Project;
                $project->name = Input::get('name');
                $project->member_id = Auth::user()->id;
                $project->created_by = Auth::user()->id;
                $project->save();

                $ref_cate = RefCategory::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_cate) {
                    foreach ($ref_cate as $non) {
                        $ref_cate = RefCategory::find($non->id);
                        $clone = $ref_cate->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;

                        $data = json_decode($clone, true);

                        $insert_id = RefCategory::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 1;
                        $temp->save();

                    }
                }

                 $ref_type = RefType::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_type) {
                    foreach ($ref_type as $non) {
                        $ref_type = RefType::find($non->id);
                        $clone = $ref_type->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert_id = RefType::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 2;
                        $temp->save();
                    }
                }


                $ref_part = RefPart::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_part) {
                    foreach ($ref_part as $non) {
                        $ref_part = RefPart::find($non->id);
                        $clone = $ref_part->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert_id = RefPart::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 3;
                        $temp->save();

                    }
                }


                $basic_equipment = BasicEquipment::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($basic_equipment) {
                    foreach ($basic_equipment as $non) {
                        $basic_equipment = BasicEquipment::find($non->id);
                        $clone = $basic_equipment->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert = BasicEquipment::create($data);

                        $tempcat = DB::table('ref_template')
                                    ->where('old_id', $insert->category_id)
                                    ->where('table_id', 1)
                                    ->where('project_id', $project->id)
                                    ->first();


                        BasicEquipment::where('project_id',$project->id)
                            ->where('category_id',$insert->category_id)
                            ->update(array('category_id' => $tempcat->new_id));

                        $temptype = DB::table('ref_template')
                                    ->where('old_id', $insert->type_id)
                                    ->where('table_id', 2)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicEquipment::where('project_id',$project->id)
                            ->where('type_id',$insert->type_id)
                            ->update(array('type_id' => $temptype->new_id));

                        $temppart = DB::table('ref_template')
                                    ->where('old_id', $insert->part_id)
                                    ->where('table_id', 3)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicEquipment::where('project_id',$project->id)
                            ->where('part_id',$insert->part_id)
                            ->update(array('part_id' => $temppart->new_id));
                    }

                    // DB::table('ref_template')->delete();
                }



                $ref_fail_cause = RefFailureCause::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_fail_cause) {
                    foreach ($ref_fail_cause as $non) {
                        $ref_fail_cause = RefFailureCause::find($non->id);
                        $clone = $ref_fail_cause->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert_id = RefFailureCause::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 4;
                        $temp->save();
                    }
                }

                $ref_fail_mode = RefFailureMode::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_fail_mode) {
                    foreach ($ref_fail_mode as $non) {
                        $ref_fail_mode = RefFailureMode::find($non->id);
                        $clone = $ref_fail_mode->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert_id = RefFailureMode::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 5;
                        $temp->save();
                    }
                }

                $basic_failure = BasicFailure::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($basic_failure) {
                    foreach ($basic_failure as $non) {
                        $basic_failure = BasicFailure::find($non->id);
                        $clone = $basic_failure->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert = BasicFailure::create($data);

                        $tempcause = DB::table('ref_template')
                                    ->where('old_id', $insert->cause_id)
                                    ->where('table_id', 4)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicFailure::where('project_id',$project->id)
                            ->where('cause_id',$insert->cause_id)
                            ->update(array('cause_id' => $tempcause->new_id));

                        $tempmode = DB::table('ref_template')
                                    ->where('old_id', $insert->mode_id)
                                    ->where('table_id', 5)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicFailure::where('project_id',$project->id)
                            ->where('mode_id',$insert->mode_id)
                            ->update(array('mode_id' => $tempmode->new_id));

                    }
                }

                $ref_task_type = RefTaskType::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_task_type) {
                    foreach ($ref_task_type as $non) {
                        $ref_task_type = RefTaskType::find($non->id);
                        $clone = $ref_task_type->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert_id = RefTaskType::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 6;
                        $temp->save();
                    }
                }



                $ref_task_list = RefTaskList::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_task_list) {
                    foreach ($ref_task_list as $non) {
                        $ref_task_list = RefTaskList::find($non->id);
                        $clone = $ref_task_list->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefTaskList::create($data);

                        $temp = new RefTemp;
                        $temp->old_id = $non->id;
                        $temp->new_id = $insert_id->id;
                        $temp->project_id = $project->id;
                        $temp->table_id = 7;
                        $temp->save();

                    }
                }


                $basic_task = BasicTask::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($basic_task) {
                    foreach ($basic_task as $non) {
                        $basic_task = BasicTask::find($non->id);
                        $clone = $basic_task->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        $insert = BasicTask::create($data);

                        $tempcause = DB::table('ref_template')
                                    ->where('old_id', $insert->cause_id)
                                    ->where('table_id', 4)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicTask::where('project_id',$project->id)
                            ->where('cause_id',$insert->cause_id)
                            ->update(array('cause_id' => $tempcause->new_id));


                        $temptasktype = DB::table('ref_template')
                                    ->where('old_id', $insert->type_id)
                                    ->where('table_id', 6)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicTask::where('project_id',$project->id)
                            ->where('type_id',$insert->type_id)
                            ->update(array('type_id' => $temptasktype->new_id));


                        $templist = DB::table('ref_template')
                                    ->where('old_id', $insert->list_id)
                                    ->where('table_id', 7)
                                    ->where('project_id', $project->id)
                                    ->first();

                        BasicTask::where('project_id',$project->id)
                            ->where('list_id',$insert->list_id)
                            ->update(array('list_id' => $templist->new_id));

                    }
                }


                $ref_task_interval = RefTaskInterval::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_task_interval) {
                    foreach ($ref_task_interval as $non) {
                        $ref_task_interval = RefTaskInterval::find($non->id);
                        $clone = $ref_task_interval->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefTaskInterval::create($data);
                    }
                }


                $ref_non_critical_question = RefNonCriticalQuestion::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_non_critical_question) {
                    foreach ($ref_non_critical_question as $non) {
                        $ref_non_critical_question = RefNonCriticalQuestion::find($non->id);
                        $clone = $ref_non_critical_question->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefNonCriticalQuestion::create($data);
                    }
                }


                $ref_order_type = RefOrderType::where('project_id',Input::get('project_id'))
                    ->where('active',1)->where('type_use',2)->get();
                if ($ref_order_type) {
                    foreach ($ref_order_type as $non) {
                        $ref_order_type = RefOrderType::find($non->id);
                        $clone = $ref_order_type->replicate();
                        unset($clone['created_by'],$clone['updated_by'],$clone['project_id']);
                        $clone['project_id'] = $project->id;
                        $clone['created_by'] = Auth::user()->id;
                        $data = json_decode($clone, true);
                        RefOrderType::create($data);
                    }
                }



                DB::table('ref_template')->delete();

                Session::put('project_id',$project->id);
                Session::put('project',$project->name);
                return Redirect::to('project')->withSuccess('Duplicate Project Success.');

            }

        }
        return Redirect::to('project')
            ->withErrors($validator)->withInput();
    }

    public function getExportproject(){

        $project_arr = array();
        $project_arr = explode(' ', Input::get('projectname'));
        $project_name = implode('_', $project_arr);

        $datefile = date('dmY');
        $ranfile =rand(11111,99999);
        $foldername = $project_name.'_'.$ranfile.'_'.$datefile;

        $basic_equipment = array();
        $basic_equipment = BasicEquipment::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','category_id','type_id','part_id'));

        if (!$basic_equipment->isEmpty()) {
            $filename = '001_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($basic_equipment) {
                $excel->sheet('basic_equipment', function($sheet) use($basic_equipment) {
                    $sheet->fromArray($basic_equipment);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }



        $basic_failure = array();
        $basic_failure = BasicFailure::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','mode_id','cause_id'));
        if (!$basic_failure->isEmpty()) {
            $filename = '002_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($basic_failure) {
                $excel->sheet('basic_failure', function($sheet) use($basic_failure) {
                    $sheet->fromArray($basic_failure);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $basic_task = array();
        $basic_task = BasicTask::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','cause_id','type_id','list_id'));
        if (!$basic_task->isEmpty()) {
            $filename = '003_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($basic_task) {
                $excel->sheet('basic_task', function($sheet) use($basic_task) {
                    $sheet->fromArray($basic_task);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_category = array();
        $ref_category = RefCategory::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));

        if (!$ref_category->isEmpty()) {
            $filename = '004_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_category) {
                $excel->sheet('ref_category', function($sheet) use($ref_category) {
                    $sheet->fromArray($ref_category);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_fail_cause = array();
        $ref_fail_cause = RefFailureCause::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));
        if (!$ref_fail_cause->isEmpty()) {
            $filename = '005_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_fail_cause) {
                $excel->sheet('ref_fail_cause', function($sheet) use($ref_fail_cause) {
                    $sheet->fromArray($ref_fail_cause);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_fail_mode = array();
        $ref_fail_mode = RefFailureMode::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));
        if (!$ref_fail_mode->isEmpty()) {
            $filename = '006_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_fail_mode) {
                $excel->sheet('ref_fail_mode', function($sheet) use($ref_fail_mode) {
                    $sheet->fromArray($ref_fail_mode);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_non = array();
        $ref_non = RefNonCriticalQuestion::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','questions'));
        if (!$ref_non->isEmpty()) {
            $filename = '007_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_non) {
                $excel->sheet('ref_non', function($sheet) use($ref_non) {
                    $sheet->fromArray($ref_non);
                });

            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_order_type = array();
        $ref_order_type = RefOrderType::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','name','description'));
        if (!$ref_order_type->isEmpty()) {
            $filename = '008_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_order_type) {
                $excel->sheet('ref_order_type', function($sheet) use($ref_order_type) {
                    $sheet->fromArray($ref_order_type);
                });
            })->store('csv','public/backup/export/'.$foldername);
            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_part = array();
        $ref_part = RefPart::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));
        if (!$ref_part->isEmpty()) {
            $filename = '009_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_part) {
                $excel->sheet('ref_part', function($sheet) use($ref_part) {
                    $sheet->fromArray($ref_part);
                });
            })->store('csv','public/backup/export/'.$foldername);
            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_task_interval = array();
        $ref_task_interval = RefTaskInterval::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','interval','description'));
        if (!$ref_task_interval->isEmpty()) {
            $filename = '010_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_task_interval) {
                $excel->sheet('ref_task_interval', function($sheet) use($ref_task_interval) {
                    $sheet->fromArray($ref_task_interval);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_task_list = array();
        $ref_task_list = RefTaskList::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));

        if (!$ref_task_list->isEmpty()) {
            $filename = '011_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_task_list) {
                $excel->sheet('ref_task_list', function($sheet) use($ref_task_list) {
                    $sheet->fromArray($ref_task_list);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_task_type = array();
        $ref_task_type = RefTaskType::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));
        if (!$ref_task_type->isEmpty()) {
            $filename = '012_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($ref_task_type) {
                $excel->sheet('ref_task_type', function($sheet) use($ref_task_type) {
                    $sheet->fromArray($ref_task_type);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $ref_type = array();
        $ref_type = RefType::where('project_id',Input::get('project_id'))
                ->where('type_use',2)
                ->where('active',1)
                ->get(array('id','description'));
        if (!$ref_type->isEmpty()) {
            $filename = '013_'.$ranfile.'_'.$datefile;
            Excel::resetValueBinder();
            $file = Excel::create($filename, function($excel) use($ref_type) {
                $excel->sheet('ref_type', function($sheet) use($ref_type) {
                    $sheet->fromArray($ref_type);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }

        $asset_registers = array();
        $asset_registers = AssetRegister::where('active', 1)
                ->where('project_id', Input::get('project_id'))->get();

        if (!$asset_registers->isEmpty()) {

            $filename = '014_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($asset_registers) {
                $excel->sheet('asset_registers', function($sheet) use($asset_registers) {
                    $sheet->fromModel($asset_registers);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $asset_complex_detail = array();
        $asset_complex_detail = AssetComplexDetail::where('active',1)
                                ->where('project_id',Input::get('project_id'))
                                ->get();

        if (!$asset_complex_detail->isEmpty()) {

            $filename = '015_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($asset_complex_detail) {
                $excel->sheet('asset_complex_detail', function($sheet) use($asset_complex_detail) {
                    $sheet->fromArray($asset_complex_detail);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }

        $asset_basic_failure = array();
        $asset_basic_failure = AssetBasicFailure::where('active',1)
                                ->where('project_id',Input::get('project_id'))
                                ->get();
        if (!$asset_basic_failure->isEmpty()) {
            $filename = '016_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($asset_basic_failure) {
                $excel->sheet('asset_basic_failure', function($sheet) use($asset_basic_failure) {
                    $sheet->fromArray($asset_basic_failure);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $asset_questions = array();
        $asset_questions = AssetQuestion::where('active',1)
                            ->where('project_id',Input::get('project_id'))
                            ->get();
        if (!$asset_questions->isEmpty()) {
            $filename = '017_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($asset_questions) {
                $excel->sheet('asset_questions', function($sheet) use($asset_questions) {
                    $sheet->fromArray($asset_questions);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        $task_selection = array();
        $task_selection = TaskSelection::where('active',1)
                        ->where('project_id',Input::get('project_id'))
                        ->get();
        if (!$task_selection->isEmpty()) {
            $filename = '018_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($task_selection) {
                $excel->sheet('task_selection', function($sheet) use($task_selection) {
                    $sheet->fromArray($task_selection);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }

        $package_assumptions = array();
        $package_assumptions = PackageAssumption::where('active',1)
                                ->where('project_id',Input::get('project_id'))
                                ->get();

        if (!$package_assumptions->isEmpty()) {
            $filename = '019_'.$ranfile.'_'.$datefile;
            $file = Excel::create($filename, function($excel) use($package_assumptions) {
                $excel->sheet('package_assumptions', function($sheet) use($package_assumptions) {
                    $sheet->fromArray($package_assumptions);
                });
            })->store('csv','public/backup/export/'.$foldername);

            $filenamezip = "public/backup/export/".$foldername.".zip";
            $files = glob($file->storagePath."/*");
            Zipper::make($filenamezip)->add($files);
        }


        Zipper::close();
        return Response::download($filenamezip);
    }

    public function postImportproject(){

        $input = array(
            'file' => Input::file('import'),
            'name' => Input::get('name')
        );

        $rules = array(
            'file' => 'required|max:50000',
            'name' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {

            $project = Project::where('created_by','=',Auth::user()->id)
                ->where('name','=',Input::get('name'))
                ->where('active','=',1)
                ->get();
                if (!$project->isEmpty()) {
                    return Redirect::to('project')->with('message_error','Project duplicate !');
                }else{

                    $project = new Project;
                    $project->name = Input::get('name');
                    $project->member_id = Auth::user()->id;
                    $project->created_by = Auth::user()->id;
                    $project->save();
                    $project_id = $project->id;

                    $datefile = date('dmY');
                    $ranfile =rand(11111,99999);

                    $destinationPath = 'public/backup/import';
                    $extension = Input::file('import')->getClientOriginalExtension();
                    $fileName = rand(11111,99999).'.'.$extension;
                    Input::file('import')->move($destinationPath, $fileName);
                    $folderimport = $ranfile.'_'.$datefile;
                    Zipper::make($destinationPath.'/'.$fileName)->extractTo('public/backup/import');

                    $ex_ref_basic_equip = glob("public/backup/import/*.csv");

                    for ($i=0; $i < count($ex_ref_basic_equip); $i++) {

                        if (substr($ex_ref_basic_equip[$i],21,3)=='004') {
                            Excel::filter('chunk')->load($ex_ref_basic_equip[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_category = new RefCategory;
                                    $ref_category->description = $row->description;
                                    $ref_category->type_use = 2;
                                    $ref_category->created_by = Auth::user()->id;
                                    $ref_category->project_id = $project_id;
                                    $ref_category->save();

                                    // print_r($row->id);

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_category->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 1;
                                    $temp->save();

                                }
                                });
                            unlink($ex_ref_basic_equip[$i]);
                        }
                        if (substr($ex_ref_basic_equip[$i],21,3)=='013') {

                            Excel::filter('chunk')->load($ex_ref_basic_equip[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_type = new RefType;
                                    $ref_type->description = $row->description;
                                    $ref_type->type_use = 2;
                                    $ref_type->created_by = Auth::user()->id;
                                    $ref_type->project_id = $project_id;
                                    $ref_type->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_type->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 2;
                                    $temp->save();
                                }
                            });
                            unlink($ex_ref_basic_equip[$i]);
                        }
                        if (substr($ex_ref_basic_equip[$i],21,3)=='009') {
                            Excel::filter('chunk')->load($ex_ref_basic_equip[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_part = new RefPart;
                                    $ref_part->description = $row->description;
                                    $ref_part->type_use = 2;
                                    $ref_part->created_by = Auth::user()->id;
                                    $ref_part->project_id = $project_id;
                                    $ref_part->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_part->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 3;
                                    $temp->save();

                                }
                                });
                                unlink($ex_ref_basic_equip[$i]);
                        }

                    }

                    $ex_basic_equip = glob("public/backup/import/*.csv");
                    for ($i=0; $i < count($ex_basic_equip); $i++) {
                        if (substr($ex_basic_equip[$i],21,3)=='001') {
                            Excel::filter('chunk')->load($ex_basic_equip[$i])
                                ->chunk(250, function($results) use ($project_id) {
                                foreach ($results as $row) {
                                    $basic = new BasicEquipment;
                                    $basic->category_id = $row->category_id;
                                    $basic->part_id = $row->part_id;
                                    $basic->type_id = $row->type_id;
                                    $basic->type_use = 2;
                                    $basic->created_by = Auth::user()->id;
                                    $basic->project_id = $project_id;
                                    $basic->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $basic->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 11;
                                    $temp->save();


                                    $tempcat = DB::table('ref_template')
                                        ->where('old_id', $row->category_id)
                                        ->where('table_id', 1)
                                        ->where('project_id', $project_id)
                                        ->first();

                                    if (count($tempcat)) {
                                        BasicEquipment::where('project_id',$project_id)
                                        ->where('category_id',$row->category_id)
                                        ->update(array('category_id' => $tempcat->new_id));
                                    }


                                    $temptype = DB::table('ref_template')
                                                ->where('old_id', $basic->type_id)
                                                ->where('table_id', 2)
                                                ->where('project_id', $project_id)
                                                ->first();

                                    if (count($temptype)) {
                                        BasicEquipment::where('project_id',$project_id)
                                        ->where('type_id',$row->type_id)
                                        ->update(array('type_id' => $temptype->new_id));
                                    }


                                    $temppart = DB::table('ref_template')
                                                ->where('old_id', $row->part_id)
                                                ->where('table_id', 3)
                                                ->where('project_id', $project_id)
                                                ->first();

                                    if (count($temppart)) {
                                        BasicEquipment::where('project_id',$project_id)
                                        ->where('part_id',$row->part_id)
                                        ->update(array('part_id' => $temppart->new_id));
                                    }

                                }
                            });
                            unlink($ex_basic_equip[$i]);
                            unset($ex_basic_equip[$i]);
                        }
                    }


                    $ext_ref_basicfailure = glob("public/backup/import/*.csv");
                    for ($i=0; $i < count($ext_ref_basicfailure); $i++) {
                        if (substr($ext_ref_basicfailure[$i],21,3)=='005') {
                            Excel::filter('chunk')->load($ext_ref_basicfailure[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_failure_cause = new RefFailureCause;
                                    $ref_failure_cause->description = $row->description;
                                    $ref_failure_cause->type_use = 2;
                                    $ref_failure_cause->created_by = Auth::user()->id;
                                    $ref_failure_cause->project_id = $project_id;
                                    $ref_failure_cause->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_failure_cause->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 4;
                                    $temp->save();

                                }
                                });
                                unlink($ext_ref_basicfailure[$i]);
                                unset($ext_ref_basicfailure[$i]);
                        }elseif (substr($ext_ref_basicfailure[$i],21,3)=='006') {
                            Excel::filter('chunk')->load($ext_ref_basicfailure[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_failure_mode = new RefFailureMode;
                                    $ref_failure_mode->description = $row->description;
                                    $ref_failure_mode->type_use = 2;
                                    $ref_failure_mode->created_by = Auth::user()->id;
                                    $ref_failure_mode->project_id = $project_id;
                                    $ref_failure_mode->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_failure_mode->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 5;
                                    $temp->save();
                                }
                                });
                                unlink($ext_ref_basicfailure[$i]);
                                unset($ext_ref_basicfailure[$i]);
                        }
                    }

                    $ex_basic_failure = glob("public/backup/import/*.csv");
                    for ($i=0; $i < count($ex_basic_failure); $i++) {
                        if (substr($ex_basic_failure[$i],21,3)=='002') {
                                Excel::filter('chunk')->load($ex_basic_failure[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $basic_failure = new BasicFailure;
                                    $basic_failure->mode_id = $row->mode_id;
                                    $basic_failure->cause_id = $row->cause_id;
                                    $basic_failure->type_use = 2;
                                    $basic_failure->created_by = Auth::user()->id;
                                    $basic_failure->project_id = $project_id;
                                    $basic_failure->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $basic_failure->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 12;
                                    $temp->save();


                                    $tempcause = DB::table('ref_template')
                                        ->where('old_id', $basic_failure->cause_id)
                                        ->where('table_id', 4)
                                        ->where('project_id', $project_id)
                                        ->first();
                                    if (count($tempcause)) {
                                         BasicFailure::where('project_id',$project_id)
                                        ->where('cause_id',$basic_failure->cause_id)
                                        ->update(array('cause_id' => $tempcause->new_id));
                                    }
                                   

                                    $tempmode = DB::table('ref_template')
                                                ->where('old_id', $basic_failure->mode_id)
                                                ->where('table_id', 5)
                                                ->where('project_id', $project_id)
                                                ->first();
                                    if (count($tempmode)) {
                                        BasicFailure::where('project_id',$project_id)
                                        ->where('mode_id',$basic_failure->mode_id)
                                        ->update(array('mode_id' => $tempmode->new_id));
                                    }

                                }
                                });
                            unlink($ex_basic_failure[$i]);
                        }
                    }

                    $ext_ref_basictask = glob("public/backup/import/*.csv");
                    for ($i=0; $i < count($ext_ref_basictask); $i++) {
                        if (substr($ext_ref_basictask[$i],21,3)=='011') {
                            Excel::filter('chunk')->load($ext_ref_basictask[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_task_list = new RefTaskList;
                                    $ref_task_list->description = $row->description;
                                    $ref_task_list->type_use = 2;
                                    $ref_task_list->created_by = Auth::user()->id;
                                    $ref_task_list->project_id = $project_id;
                                    $ref_task_list->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_task_list->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 7;
                                    $temp->save();
                                }
                                });
                                unlink($ext_ref_basictask[$i]);
                        }
                        if (substr($ext_ref_basictask[$i],21,3)=='012') {
                            Excel::filter('chunk')->load($ext_ref_basictask[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_task_type = new RefTaskType;
                                    $ref_task_type->description = $row->description;
                                    $ref_task_type->type_use = 2;
                                    $ref_task_type->created_by = Auth::user()->id;
                                    $ref_task_type->project_id = $project_id;
                                    $ref_task_type->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_task_type->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 6;
                                    $temp->save();

                                }
                                });
                                unlink($ext_ref_basictask[$i]);
                        }
                    }

                    $ex_basic_task= glob("public/backup/import/*.csv");
                    for ($i=0; $i < count($ex_basic_task); $i++) {
                        if (substr($ex_basic_task[$i],21,3)=='003') {

                            Excel::filter('chunk')->load($ex_basic_task[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {

                                    $basic_task = new BasicTask;
                                    $basic_task->cause_id = $row->cause_id;
                                    $basic_task->type_id = $row->type_id;
                                    $basic_task->list_id = $row->list_id;
                                    $basic_task->type_use = 2;
                                    $basic_task->created_by = Auth::user()->id;
                                    $basic_task->project_id = $project_id;
                                    $basic_task->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $basic_task->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 13;
                                    $temp->save();


                                    $tempcause = DB::table('ref_template')
                                        ->where('old_id', $basic_task->cause_id)
                                        ->where('table_id', 4)
                                        ->where('project_id', $project_id)
                                        ->first();

                                    BasicTask::where('project_id',$project_id)
                                        ->where('cause_id',$basic_task->cause_id)
                                        ->update(array('cause_id' => $tempcause->new_id));


                                    $temptasktype = DB::table('ref_template')
                                                ->where('old_id', $basic_task->type_id)
                                                ->where('table_id', 6)
                                                ->where('project_id', $project_id)
                                                ->first();

                                    BasicTask::where('project_id',$project_id)
                                        ->where('type_id',$basic_task->type_id)
                                        ->update(array('type_id' => $temptasktype->new_id));


                                    $templist = DB::table('ref_template')
                                                ->where('old_id', $basic_task->list_id)
                                                ->where('table_id', 7)
                                                ->where('project_id', $project_id)
                                                ->first();

                                    BasicTask::where('project_id',$project_id)
                                        ->where('list_id',$basic_task->list_id)
                                        ->update(array('list_id' => $templist->new_id));


                                }
                                });
                                unlink($ex_basic_task[$i]);
                                unset($ex_basic_task[$i]);
                        }
                    }

                    $re_other = glob("public/backup/import/*.csv");
                    for ($i=0; $i < count($re_other); $i++) {

                        if (substr($re_other[$i],21,3)=='010') {
                            Excel::filter('chunk')->load($re_other[$i])
                                ->chunk(250, function($results) use ($project_id){
                                foreach ($results as $row) {
                                    $ref_task_interval = new RefTaskInterval;
                                    $ref_task_interval->interval = $row->interval;
                                    $ref_task_interval->description = $row->description;
                                    $ref_task_interval->type_use = 2;
                                    $ref_task_interval->created_by = Auth::user()->id;
                                    $ref_task_interval->project_id = $project_id;
                                    $ref_task_interval->save();

                                    $temp = new RefTemp;
                                    $temp->old_id = $row->id;
                                    $temp->new_id = $ref_task_interval->id;
                                    $temp->project_id = $project_id;
                                    $temp->table_id = 8;
                                    $temp->save();

                                }
                                });
                                unlink($re_other[$i]);
                        }elseif (substr($re_other[$i],21,3)=='008') {
                            Excel::filter('chunk')->load($re_other[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {
                                        $ref_order_type = new RefOrderType;
                                        $ref_order_type->name = $row->name;
                                        $ref_order_type->description = $row->description;
                                        $ref_order_type->type_use = 2;
                                        $ref_order_type->created_by = Auth::user()->id;
                                        $ref_order_type->project_id = $project_id;
                                        $ref_order_type->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $ref_order_type->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 9;
                                        $temp->save();
                                    }
                                });
                                unlink($re_other[$i]);
                        }elseif (substr($re_other[$i],21,3)=='007') {
                            Excel::filter('chunk')->load($re_other[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {
                                        $ref_non = new RefNonCriticalQuestion;
                                        $ref_non->questions = $row->questions;
                                        $ref_non->type_use = 2;
                                        $ref_non->created_by = Auth::user()->id;
                                        $ref_non->project_id = $project_id;
                                        $ref_non->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $ref_non->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 10;
                                        $temp->save();

                                    }
                                });
                                unlink($re_other[$i]);
                        }
                    }
                }


                $ex_asset_register= glob("public/backup/import/*.csv");
                for ($i=0; $i < count($ex_asset_register); $i++) {
                    if (substr($ex_asset_register[$i],21,3)=='014') {
                            Excel::filter('chunk')->load($ex_asset_register[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {
                                        $asset_registers = new AssetRegister;
                                        if (!empty($row->parent)) {
                                            $asset_registers->parent = $row->parent;
                                        }else{
                                            $asset_registers->parent = 0;
                                        }
                                        $asset_registers->asset_name = $row->asset_name;
                                        $asset_registers->description = $row->description;
                                        $asset_registers->cat_id = $row->cat_id;
                                        $asset_registers->type_id = $row->type_id;
                                        $asset_registers->level = $row->level;
                                        $asset_registers->rpn = $row->rpn;
                                        $asset_registers->drawing = $row->drawing;
                                        $asset_registers->picture_path = $row->picture_path;
                                        $asset_registers->severity = $row->severity;
                                        $asset_registers->occur = $row->occur;
                                        $asset_registers->detect = $row->detect;
                                        $asset_registers->color = $row->color;
                                        $asset_registers->complex_node = $row->complex_node;
                                        $asset_registers->business_unit_type_colums = $row->business_unit_type_colums;
                                        $asset_registers->created_by = Auth::user()->id;
                                        $asset_registers->project_id = $project_id;
                                        $asset_registers->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $asset_registers->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 14;
                                        $temp->save();

                                        $tempcate = DB::table('ref_template')
                                                ->where('old_id', $asset_registers->cat_id)
                                                ->where('table_id', 1)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($tempcate)) {
                                             AssetRegister::where('project_id',$project_id)
                                                ->where('cat_id',$asset_registers->cat_id)
                                                ->where('id',$asset_registers->id)
                                                ->update(array('cat_id' => $tempcate->new_id));
                                        }

                                        $temptype = DB::table('ref_template')
                                                ->where('old_id', $asset_registers->type_id)
                                                ->where('table_id', 2)
                                                ->where('project_id', $project_id)
                                                ->first();
                                        if (count($temptype)) {
                                            AssetRegister::where('project_id',$project_id)
                                                ->where('type_id',$asset_registers->type_id)
                                                ->where('id',$asset_registers->id)
                                                ->update(array('type_id' => $temptype->new_id));
                                        }

                                        $tempcate = DB::table('ref_template')
                                                ->where('old_id', $row->parent)
                                                ->where('table_id', 14)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($tempcate)) {
                                            AssetRegister::where('project_id',$project_id)
                                                ->where('parent',$asset_registers->parent)
                                                ->where('id',$asset_registers->id)
                                                ->update(array('parent' => $tempcate->new_id));
                                        }
                                    }
                                });
                        unlink($ex_asset_register[$i]);
                    }
                }

                $ex_asset_complex_detail= glob("public/backup/import/*.csv");
                for ($i=0; $i < count($ex_asset_complex_detail); $i++) {
                    if (substr($ex_asset_complex_detail[$i],21,3)=='015') {
                            Excel::filter('chunk')->load($ex_asset_complex_detail[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {

                                        $asset_complex_detail = new AssetComplexDetail;
                                        $asset_complex_detail->node = $row->node;
                                        $asset_complex_detail->complex_id = $row->complex_id;
                                        $asset_complex_detail->rows = $row->rows;
                                        $asset_complex_detail->columns = $row->columns;
                                        $asset_complex_detail->description = $row->description;
                                        $asset_complex_detail->type = $row->type;
                                        $asset_complex_detail->ref1 = $row->ref1;
                                        $asset_complex_detail->ref_id = $row->ref_id;
                                        $asset_complex_detail->question = $row->question;//Yes /No
                                        $asset_complex_detail->created_by = Auth::user()->id;
                                        $asset_complex_detail->project_id = $project_id;
                                        $asset_complex_detail->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $asset_complex_detail->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 15;
                                        $temp->save();

                                        $node = array();
                                        $node = DB::table('ref_template')
                                                ->where('old_id', $asset_complex_detail->node)
                                                ->where('table_id', 14)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($node)) {
                                            AssetComplexDetail::where('project_id',$project_id)
                                                ->where('node',$asset_complex_detail->node)
                                                ->where('id',$asset_complex_detail->id)
                                                ->update(array('node' => $node->new_id));
                                        }
                                    }
                                });
                            unlink($ex_asset_complex_detail[$i]);
                    }
                }

                $ex_asset_basic_failure= glob("public/backup/import/*.csv");
                for ($i=0; $i < count($ex_asset_basic_failure); $i++) {
                    if (substr($ex_asset_basic_failure[$i],21,3)=='016') {
                            Excel::filter('chunk')->load($ex_asset_basic_failure[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {

                                        $asset_basic_failure = new AssetBasicFailure;
                                        $asset_basic_failure->part_id = $row->part_id;
                                        $asset_basic_failure->basic_failure_id = $row->basic_failure_id;
                                        $asset_basic_failure->node = $row->node;
                                        $asset_basic_failure->rpn = $row->rpn;
                                        $asset_basic_failure->worst_case = $row->worst_case;
                                        $asset_basic_failure->failure_effect_remark = $row->failure_effect_remark;
                                        $asset_basic_failure->failure_effect = $row->failure_effect;
                                        $asset_basic_failure->severity = $row->severity;
                                        $asset_basic_failure->occur = $row->occur;
                                        $asset_basic_failure->detect = $row->detect;
                                        $asset_basic_failure->ref1 = $row->ref1;
                                        $asset_basic_failure->ref2 = $row->ref2;
                                        $asset_basic_failure->ref3 = $row->ref3;
                                        $asset_basic_failure->ref4 = $row->ref4;
                                        $asset_basic_failure->ref5 = $row->ref5;
                                        $asset_basic_failure->ref6 = $row->ref6;
                                        $asset_basic_failure->ref7 = $row->ref7;
                                        $asset_basic_failure->ref8 = $row->ref8;
                                        $asset_basic_failure->color = $row->color;
                                        $asset_basic_failure->created_by = Auth::user()->id;
                                        $asset_basic_failure->project_id = $project_id;
                                        $asset_basic_failure->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $asset_basic_failure->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 16;
                                        $temp->save();

                                        $node = array();
                                        $node = DB::table('ref_template')
                                                ->where('old_id', $asset_basic_failure->node)
                                                ->where('table_id', 14)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($node)) {
                                            AssetBasicFailure::where('project_id',$project_id)
                                                ->where('node',$asset_basic_failure->node)
                                                ->where('id',$asset_basic_failure->id)
                                                ->update(array('node' => $node->new_id));
                                        }


                                        $ref_part = array();
                                        $ref_part = DB::table('ref_template')
                                                ->where('old_id', $asset_basic_failure->part_id)
                                                ->where('table_id', 3)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($ref_part)) {
                                            AssetBasicFailure::where('project_id',$project_id)
                                                ->where('part_id',$asset_basic_failure->part_id)
                                                ->where('id',$asset_basic_failure->id)
                                                ->update(array('part_id' => $ref_part->new_id));
                                        }



                                        $basic_failure = array();
                                        $basic_failure = DB::table('ref_template')
                                                ->where('old_id', $asset_basic_failure->basic_failure_id)
                                                ->where('table_id', 12)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($basic_failure)) {
                                            AssetBasicFailure::where('project_id',$project_id)
                                                ->where('basic_failure_id',$asset_basic_failure->basic_failure_id)
                                                ->where('id',$asset_basic_failure->id)
                                                ->update(array('basic_failure_id' => $basic_failure->new_id));
                                        }
                                    }
                                });
                            unlink($ex_asset_basic_failure[$i]);
                    }
                }

                $ex_asset_questions= glob("public/backup/import/*.csv");
                for ($i=0; $i < count($ex_asset_questions); $i++) {
                    if (substr($ex_asset_questions[$i],21,3)=='017') {
                            Excel::filter('chunk')->load($ex_asset_questions[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {

                                        $asset_questions = new AssetQuestion;
                                        $asset_questions->asset_basic_failure_id = $row->asset_basic_failure_id;
                                        $asset_questions->questions = $row->questions;
                                        $asset_questions->answers = $row->answers;
                                        $asset_questions->created_by = Auth::user()->id;
                                        $asset_questions->project_id = $project_id;
                                        $asset_questions->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $asset_questions->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 17;
                                        $temp->save();

                                        $asset_basic_failure = array();
                                        $asset_basic_failure = DB::table('ref_template')
                                                ->where('old_id', $asset_questions->asset_basic_failure_id)
                                                ->where('table_id', 16)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($asset_basic_failure)) {
                                            AssetQuestion::where('project_id',$project_id)
                                                ->where('asset_basic_failure_id',$asset_questions->asset_basic_failure_id)
                                                ->where('id',$asset_questions->id)
                                                ->update(array('asset_basic_failure_id' => $asset_basic_failure->new_id));
                                        }
                                    }
                                });
                            unlink($ex_asset_questions[$i]);
                    }
                }

                $ex_task_selection= glob("public/backup/import/*.csv");
                for ($i=0; $i < count($ex_task_selection); $i++) {
                    if (substr($ex_task_selection[$i],21,3)=='018') {
                            Excel::filter('chunk')->load($ex_task_selection[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {

                                        $task_selection = new TaskSelection;
                                        $task_selection->node = $row->node;
                                        $task_selection->asset_basic_failure_id = $row->asset_basic_failure_id;
                                        $task_selection->failure_effect_id = $row->failure_effect_id;
                                        $task_selection->evident_id = $row->evident_id;
                                        $task_selection->order_type_id = $row->order_type_id;
                                        $task_selection->interval_num = $row->interval_num;
                                        $task_selection->interval = $row->interval;
                                        $task_selection->basic_task_id = $row->basic_task_id;
                                        $task_selection->activity_status_id = $row->activity_status_id;
                                        $task_selection->activity_detail = $row->activity_detail;
                                        $task_selection->created_by = Auth::user()->id;
                                        $task_selection->project_id = $project_id;
                                        $task_selection->save();


                                        $temp = new RefTemp;
                                        $temp->old_id = $row->task_selection_id;
                                        $temp->new_id = $task_selection->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 18;
                                        $temp->save();


                                        $asset_registers = array();
                                        $asset_registers = DB::table('ref_template')
                                                ->where('old_id', $row->node)
                                                ->where('table_id', 14)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($asset_registers)) {
                                            TaskSelection::where('project_id',$project_id)
                                                ->where('node',$row->node)
                                                ->where('task_selection_id',$task_selection->id)
                                                ->update(array('node' => $asset_registers->new_id));
                                        }



                                        $asset_basic_failure = array();
                                        $asset_basic_failure = DB::table('ref_template')
                                                ->where('old_id', $row->asset_basic_failure_id)
                                                ->where('table_id', 16)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($asset_basic_failure)) {
                                            TaskSelection::where('project_id',$project_id)
                                                ->where('asset_basic_failure_id',$row->asset_basic_failure_id)
                                                ->where('task_selection_id',$task_selection->id)
                                                ->update(array('asset_basic_failure_id' => $asset_basic_failure->new_id));
                                        }


                                        $ref_order_type = array();
                                        $ref_order_type = DB::table('ref_template')
                                                ->where('old_id', $row->order_type_id)
                                                ->where('table_id', 9)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($ref_order_type)) {
                                            TaskSelection::where('project_id',$project_id)
                                                ->where('order_type_id',$row->order_type_id)
                                                ->where('task_selection_id',$task_selection->id)
                                                ->update(array('order_type_id' => $ref_order_type->new_id));
                                        }


                                        $basic_task = array();
                                        $basic_task = DB::table('ref_template')
                                                ->where('old_id', $task_selection->basic_task_id)
                                                ->where('table_id', 13)
                                                ->where('project_id', $project_id)
                                                ->first();

                                        if (count($basic_task)) {
                                            TaskSelection::where('project_id',$project_id)
                                                ->where('basic_task_id',$task_selection->basic_task_id)
                                                ->where('task_selection_id',$task_selection->id)
                                                ->update(array('basic_task_id' => $basic_task->new_id));
                                        }
                                    }
                                });
                            unlink($ex_task_selection[$i]);
                    }
                }

                $ex_package_assum= glob("public/backup/import/*.csv");
                for ($i=0; $i < count($ex_package_assum); $i++) {
                    if (substr($ex_package_assum[$i],21,3)=='019') {
                            Excel::filter('chunk')->load($ex_package_assum[$i])
                                ->chunk(250, function($results) use ($project_id){
                                    foreach ($results as $row) {

                                        $package_assumptions = new PackageAssumption;
                                        $package_assumptions->name = $row->name;
                                        $package_assumptions->description = $row->description;
                                        $package_assumptions->created_by = Auth::user()->id;
                                        $package_assumptions->project_id = $project_id;
                                        $package_assumptions->save();

                                        $temp = new RefTemp;
                                        $temp->old_id = $row->id;
                                        $temp->new_id = $package_assumptions->id;
                                        $temp->project_id = $project_id;
                                        $temp->table_id = 19;
                                        $temp->save();

                                    }
                                });
                            unlink($ex_package_assum[$i]);
                    }
                }

            DB::table('ref_template')->delete();

            return Redirect::to('project')
            ->with('message','imported project successfully.');
        }
        return Redirect::to('project')
            ->withErrors($validator)->withInput();
    }


}
