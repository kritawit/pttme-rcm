<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\AssetRegister;
use App\RefCategory;
use App\RefPart;
use App\RefType;
use App\RefFailureMode;
use App\RefFailureCause;
use App\RefTaskList;
use App\RefTaskType;
use App\Level;
use App\Complex;
use App\BasicEquipment;
use App\AssetQuestion;
use App\AssetBasicFailure;
use App\AssetComplexDetail;
use App\TaskSelection;

use View;
use Input;
use Redirect;
use Validator;
use Session;
use Auth;
use Response;
use File;
use Image;
use DB;
use Excel;

class AssetRegisterController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
        $this->beforeFilter('csrf', array('on' => 'post'));
        if (Session::get('project_id') == '') {
            return Redirect::to('dash-board');
        }
    }
    
    public function getL8detail() {
        return View::make('asset_register.index');
    }
    
    public function getTree() {
        $data = AssetRegister::where('active', '=', 1)->where('project_id', '=', Session::get('project_id'))->get();
        $menu = array();
        $temp = array();
        foreach ($data as $val) {
            $menu['id'] = $val->id;
            $menu['parentId'] = $val->parent;
            $menu['name'] = '<font color="' . $val->color . '">' . $val->asset_name . '</font>';
            $temp[] = $menu;
        }
        return Response::json($temp);
    }
    
    public function postAddnode() {
        
        $asset = new AssetRegister;
        $asset->asset_name = Input::get('node');
        $asset->parent = 0;
        $asset->level = 1;
        $asset->created_by = Auth::user()->id;
        $asset->project_id = Session::get('project_id');
        if ($asset->save()) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function postAddsubnode() {
        $data = array();
        $data = AssetRegister::find(Input::get('node_id_asset'));
        
        $asset = new AssetRegister;
        $asset->asset_name = Input::get('asset_name');
        $asset->parent = Input::get('node_id_asset');
        
        if (!empty(Input::get('cat_id'))) {
            $asset->cat_id = Input::get('cat_id');
        }
        if (!empty(Input::get('type_id'))) {
            $asset->type_id = Input::get('type_id');
        }
        
        if (!empty(Input::get('business_unit_type_colums'))) {
            $asset->business_unit_type_colums = Input::get('business_unit_type_colums');
        }
        $level = $data->level + 1;
        $asset->level = $level;
        $asset->created_by = Auth::user()->id;
        $asset->project_id = Session::get('project_id');
        if ($asset->save()) {
            if ($level == 3) {
                $data = AssetRegister::find($asset->id);
                $input = array();
                $input['complex_node'] = $asset->id;
                $data->update($input);
            } 
            else {
                if (!empty($data)) {
                    if (!empty($data->complex_node)) {
                        $input = array();
                        $asset_upnode = AssetRegister::find($asset->id);
                        $input['complex_node'] = $data->complex_node;
                        $asset_upnode->update($input);
                    }
                }
            }
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function postRemovenode() {
        $data = AssetRegister::find(Input::get('id'));
        $input = array();
        $input['active'] = 0;
        $input['updated_by'] = Auth::user()->id;
        if ($data->update($input)) {

            AssetBasicFailure::where('node',Input::get('id'))->update(array('active'=> 0));
            AssetComplexDetail::where('node',Input::get('id'))->update(array('active'=> 0));
            TaskSelection::where('node',Input::get('id'))->update(array('active'=> 0));

            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function getLevel() {
        $data = AssetRegister::find(Input::get('id'));
        
        $output[0]['level'] = $data->level;
        $output[1]['name'] = $data->asset_name;
        echo json_encode($output);
    }
    
    public function getFormsub3() {
        return View::make('asset_register.form_sub3');
    }
    
    public function getFormsub8() {
        
        $categories = array();
        $types = array();
        $parts = array();
        
        foreach (RefCategory::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $category) {
            $categories[$category->id] = $category->description;
        }
        
        foreach (RefType::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $type) {
            $types[$type->id] = $type->description;
        }
        
        foreach (RefPart::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $part) {
            $parts[$part->id] = $part->description;
        }
        
        $modes = array();
        $causes = array();
        
        foreach (RefFailureMode::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $mode) {
            $modes[$mode->id] = $mode->description;
        }
        
        foreach (RefFailureCause::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $cause) {
            $causes[$cause->id] = $cause->description;
        }
        
        $tlists = array();
        $ttypes = array();
        
        foreach (RefTaskList::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $list) {
            $tlists[$list->id] = $list->description;
        }
        
        foreach (RefTaskType::where('project_id', '=', Session::get('project_id'))->where('active', '=', 1)->get() as $type) {
            $ttypes[$type->id] = $type->description;
        }
        $assets = array();
        
        // $asset = AssetRegister::find(Input::get('id'));
        $assets = DB::table('asset_registers')->join('ref_categories', 'asset_registers.cat_id', '=', 'ref_categories.id')->join('ref_parts', 'asset_registers.part_id', '=', 'ref_parts.id')->join('ref_types', 'asset_registers.type_id', '=', 'ref_types.id')->where('asset_registers.active', '=', 1)->select('asset_registers.*', 'ref_categories.description as cat_desc', 'ref_parts.description as part_desc', 'ref_types.description as type_desc')->get();
        
        return View::make('asset_register.form_sub8')->with('assets', $assets)->with('categories', $categories)->with('types', $types)->with('parts', $parts)->with('modes', $modes)->with('causes', $causes)->with('tlists', $tlists)->with('ttypes', $ttypes)->with('node', Input::get('node'))->with('id', Input::get('id'));
    }
    
    public function getFormlevel() {
        $risk = 0;
        $risk = Input::get('risk');
        $level = Level::where('level', '=', Input::get('level'));
        $assets = array();
        reset($assets);
        $assets = DB::Select(DB::raw("SELECT a.*,level.description as level_desc,
				m1.name as create_name,m2.name as update_name,t.description as type,
                c.description as category
                FROM asset_registers a
				LEFT JOIN level
				ON a.level = level.level
				LEFT JOIN members m1
				ON a.created_by = m1.id
				LEFT JOIN members m2
				ON a.updated_by = m2.id
                LEFT JOIN ref_types t
                ON a.type_id = t.id
                LEFT JOIN ref_categories c
                ON a.cat_id = c.id
				WHERE a.active = 1
				AND a.id = " . Input::get('id') . "
		")) [0];
        
        // Query ดึงข้อมูลรายละเอียดของแต่ละ node
        $unders = array();
        
        $unders = DB::Select(DB::raw("
           	SELECT ag.*,l.type_name FROM asset_registers ag
           	LEFT JOIN level l
           	ON ag.level = l.level
			WHERE ag.level > " . Input::get('level') . "
			AND ag.id > " . Input::get('id') . " AND ag.active = 1
			AND ag.project_id = " . Session::get('project_id') . "
			ORDER BY ag.parent asc"));
        
        if (Input::get('level') == 3) {
            $com_detail = array();
            $complex_detail = array();
            $color = array();
            
            $bss_unit = array();
            $bss_unit = DB::Select(DB::raw("select * from asset_registers where active = 1 and id = " . $assets->parent)) [0];
            $business_unit = $bss_unit->business_unit_type_colums;
            
            $color = DB::Select(DB::raw("SELECT * FROM complex_detail_default WHERE active = 1 and type = 5 GROUP BY description"));
            
            $com_detail = DB::Select(DB::raw("
				select ac.id,ac.node,ac.complex_id,c.name as 'complex_name'
				from asset_complex_detail ac
				left join complex c
				on ac.complex_id = c.id
				where ac.active = 1
				and ac.project_id = " . Session::get('project_id') . "
				and ac.node = " . Input::get('id')));
            
            $status = 0;
            if (!empty($com_detail)) {
                
                //Status = 1 ต่อเมื่อ มีการบันทึกค่า ลง asset_complex_detail แล้ว
                $status = 1;
                $complex_detail = DB::Select(DB::raw("
				select ac.id,ac.node,ac.complex_id,c.name as 'complex_name'
				from asset_complex_detail ac
				left join complex c
				on ac.complex_id = c.id
				where ac.active = 1
				and ac.project_id = " . Session::get('project_id') . "
				and ac.node = " . Input::get('id'))) [0];
            }
            
            foreach (Complex::where('active', '=', 1)->get() as $com) {
                $complexs[$com->id] = $com->name;
            }
            
            return View::make('asset_register.level_three')->with(compact('complexs'))->with(compact('assets'))->with(compact('complex_detail'))->with('status', $status)->with('color', $color)->with('business_unit', $business_unit)->with('node', Input::get('id'));
        } 
        elseif (Input::get('level') == 8) {
            
            $category = array();
            $cat = DB::Select(DB::raw("SELECT be.id,be.category_id,c.description,be.type_id,be.part_id
					FROM basic_equipments be
					LEFT JOIN ref_categories c
					ON be.category_id = c.id
					WHERE be.active = 1
					AND be.project_id = " . Session::get('project_id')));
            
            foreach ($cat as $c) {
                $category[$c->category_id] = $c->description;
            }
            
            $asset_basic_failure = array();
            $asset_basic_failure = DB::Select(DB::raw("SELECT * FROM asset_basic_failure
					WHERE active = 1 AND project_id = " . Session::get('project_id')));
            
            // $parantdata = array();
            // $parantdata = DB::Select(DB::raw("
            // 	SELECT * FROM asset_registers WHERE active = 1
            // 	AND level = 7 AND id = ".$assets->parent."
            // 	AND project_id = ".Session::get('project_id')
            // ))[0];
            
            $equip_part = array();
            $equip = array();
            $equip = DB::Select(DB::raw("
				select e.*,c.description from basic_equipments e
				left join ref_parts c
				on e.part_id = c.id
				where e.active = 1 AND e.category_id = " . $assets->cat_id . "
				AND e.type_id = " . $assets->type_id . " AND
				e.project_id = " . Session::get('project_id')));
            
            foreach ($equip as $c) {
                $equip_part[$c->part_id] = $c->description;
            }
            
            $failuremode = array();
            $mode = DB::Select(DB::raw("select fm.id,fm.cause_id,fm.mode_id,m.description from basic_failures fm
				left join ref_failure_mode m
				on fm.mode_id=m.id
				where fm.active = 1
				AND fm.project_id = " . Session::get('project_id')));
            
            foreach ($mode as $c) {
                $failuremode[$c->mode_id] = $c->description;
            }
            
            return View::make('asset_register.level_eight')
                ->with('asset_basic_failure', $asset_basic_failure)
                ->with('node_id', Input::get('id'))
                ->with(compact('equip_part'))
                ->with(compact('failuremode'))
                ->with(compact('assets'))
                ->with(compact('category'));

        } 
        elseif (Input::get('level') == 7) {
            $unders = array();
            $unders = DB::table('asset_registers')->select('*')->where('id', '>', Input::get('id'))->where('level', '>', Input::get('level'))->where('active', '=', 1)->where('project_id', '=', Session::get('project_id'))->orderBy('parent', 'asc')->get();
            return View::make('asset_register.level_seven')->with('unders', $unders)->with(compact('assets'));
        } 
        else {
            return View::make('asset_register.form_other')->with('unders', $unders)->with(compact('assets'));
        }
    }
    
    public function getChartcolour() {
        $charts = array();
        
        $charts = DB::Select(DB::raw("SELECT DISTINCT color,COUNT(id)as 'value'
			FROM asset_registers where level > 7 and active = 1
			and id > " . Input::get('node_id') . " and project_id = " . Session::get('project_id') . " GROUP BY color "));
        
        $chart = array();
        $temp = array();
        
        foreach ($charts as $val) {
            $chart['value'] = $val->value;
            $chart['color'] = $val->color;
            $chart['highlight'] = $val->color;
            $chart['label'] = '';
            $temp[] = $chart;
        }
        
        return Response::json($temp);
    }
    
    public function postSaveformlevel8() {
        $mes = array();
        
        $asset = AssetRegister::find(Input::get('node_id'));
        $input = array();
        $input['description'] = Input::get('description');
        $input['drawing'] = Input::get('drawing');
        $input['failure_effect'] = Input::get('failure_effect');
        $input['rpn'] = Input::get('rpn');
        $input['ref1'] = Input::get('ref1');
        $input['ref2'] = Input::get('ref2');
        $input['ref3'] = Input::get('ref3');
        $input['ref4'] = Input::get('ref4');
        $input['ref5'] = Input::get('ref5');
        $input['ref6'] = Input::get('ref6');
        $input['ref7'] = Input::get('ref7');
        $input['ref8'] = Input::get('ref8');
        $image = Input::file('file_upload');
        if (!empty($image)) {
            $filename = date('YmdHis') . "-" . $image->getClientOriginalName();
            Image::make($image->getRealPath())->resize(468, 249)->save('public/images/level/' . $asset->level . '/' . $filename);
            $input['picture_path'] = $filename;
        }
        $input['updated_by'] = Auth::user()->id;
        if ($asset->update($input)) {
            $mes[]['message'] = 'success';
        } 
        else {
            $mes[]['message'] = 'fail';
        }
        
        echo json_encode($mes);
    }
    
    public function getComplexform() {
        
        $consequence = array();
        $occorrence = array();
        $detection = array();
        $header_consequence = array();
        $header_occorrence = array();
        $header_detection = array();
        $rows_consequence = array();
        $rows_occorrence = array();
        $rows_detection = array();
        $bss_unit = Input::get('bss_unit');
        
        $header_consequence = DB::table('complex_detail_default')->select('complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.columns', array($bss_unit, 4, 5, 6))->whereIn('complex_detail_default.type', array(6))->get();
        
        $rows_consequence = DB::table('complex_detail_default')->select('complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.type', array(4))->get();
        
        $consequence = DB::table('asset_complex_detail')->select('asset_complex_detail.ref1', 'asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.columns', array($bss_unit, 4, 5, 6))->whereIn('asset_complex_detail.type', array(1))->get();
        
        $occorrence = DB::table('asset_complex_detail')->select('asset_complex_detail.ref1', 'asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(2))->get();
        
        $detection = DB::table('asset_complex_detail')->select('asset_complex_detail.ref1', 'asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(3))->get();
        
        if (empty($consequence)) {
            $consequence = DB::table('complex_detail_default')->select('complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.columns', array($bss_unit, 4, 5, 6))->whereIn('complex_detail_default.type', array(1))->get();
        }
        
        if (empty($occorrence)) {
            $occorrence = DB::table('complex_detail_default')->select('complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.type', array(2))->get();
        }
        
        if (empty($detection)) {
            $detection = DB::table('complex_detail_default')->select('complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.type', array(3))->get();
        }
        
        if (Input::get('risk') == 1) {
            
            //กรณีเรียกจาก Level 8
            return View::make('asset_register.view_risk_detail_complex')->with('consequence', $consequence)->with('header_consequence', $header_consequence)->with('rows_consequence', $rows_consequence)->with('header_consequence', $header_consequence)->with('rows_consequence', $rows_consequence)->with('header_consequence', $header_consequence)->with('rows_consequence', $rows_consequence)->with('occorrence', $occorrence)->with('detection', $detection);
        } 
        else {
            return View::make('asset_register.detail_complex')->with('consequence', $consequence)->with('header_consequence', $header_consequence)->with('rows_consequence', $rows_consequence)->with('header_consequence', $header_consequence)->with('rows_consequence', $rows_consequence)->with('header_consequence', $header_consequence)->with('rows_consequence', $rows_consequence)->with('occorrence', $occorrence)->with('detection', $detection);
        }
    }
    
    public function getColorform() {
        $complex_color = array();
        $color_header = array();
        $color_rows = array();
        
        $color_header = DB::table('asset_complex_detail')->select('asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(7))->get();
        
        $color_rows = DB::table('asset_complex_detail')->select('asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(4))->get();
        
        $complex_color = DB::table('asset_complex_detail')->select('asset_complex_detail.id', 'asset_complex_detail.ref1', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(5))->get();
        
        if (empty($complex_color)) {
            $color_header = DB::table('complex_detail_default')->select('complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.type', array(7))->get();
            
            $color_rows = DB::table('complex_detail_default')->select('complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.type', array(4))->get();
            
            $complex_color = DB::table('complex_detail_default')->select('complex_detail_default.id', 'complex_detail_default.ref1', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_id'))->whereIn('complex_detail_default.type', array(5))->get();
        }
        
        return View::make('asset_register.table_color_default')->with('complex_color', $complex_color)->with('color_header', $color_header)->with('color_rows', $color_rows);
    }
    
    public function postUpdatecolor() {
        
        $color_code = Input::get('color');
        $complex_color = array();
        $comp_default = array();
        
        $complex_color = DB::table('asset_complex_detail')->select('asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.ref1', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('com_id'))->where('asset_complex_detail.node', '=', Input::get('nd_id'))->where('asset_complex_detail.id', '=', Input::get('color_id'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->where('asset_complex_detail.type', '=', 5)->get();
        
        if (!empty($complex_color)) {
            
            $rs = DB::table('asset_complex_detail')->where('id', Input::get('color_id'))->where('node', Input::get('nd_id'))->where('complex_id', Input::get('com_id'))->update(['description' => $color_code, 'question' => Input::get('question'), 'ref1' => Input::get('ref1'), 'updated_by' => Auth::user()->id]);
            
            if ($rs == 1) {
                echo "success";
            } 
            else {
                echo "fail";
            }
        } 
        else {
            
            $comp_default = array();
            $comp_default = DB::table('complex_detail_default')->select('complex_detail_default.type', 'complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description', 'complex_detail_default.question')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('com_id'))->where('complex_detail_default.type', '=', 5)->get();
            foreach ($comp_default as $cold) {
                DB::table('asset_complex_detail')->insert(['node' => Input::get('nd_id'), 'complex_id' => Input::get('com_id'), 'rows' => $cold->rows, 'columns' => $cold->columns, 'description' => $cold->description, 'question' => $cold->question, 'ref1' => $cold->ref1, 'type' => $cold->type, 'ref_id' => $cold->id, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
            
            $rs = DB::table('asset_complex_detail')->where('ref_id', Input::get('color_id'))->where('node', Input::get('nd_id'))->where('complex_id', Input::get('com_id'))->update(['description' => $color_code, 'question' => Input::get('question'), 'ref1' => Input::get('ref1'), 'updated_by' => Auth::user()->id]);
            
            if ($rs == 1) {
                echo 'success';
            } 
            else {
                echo "fail";
            }
        }
    }
    
    public function postSavecompnode() {
        $data = AssetRegister::find(Input::get('node_id'));
        $input = array();
        $input['complex_node'] = Input::get('node_id');
        $input['updated_by'] = Auth::user()->id;
        if ($data->update($input)) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function getChecktaskselection() {
        $data = AssetRegister::find(Input::get('node_id'));
        
        $asset_failure = DB::Select(DB::raw("select * from asset_basic_failure where active = 1 and node = " . Input::get('node_id')));
        
        if ((!empty($data->severity)) && (!empty($asset_failure))) {
            echo "has";
        } 
        else {
            echo "not";
        }
    }
    
    public function postSaveconseq() {
        $input = array();
        $consequence = array();
        
        $consequence = DB::table('asset_complex_detail')->select('asset_complex_detail.type', 'asset_complex_detail.ref1', 'asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_conseq'))->where('asset_complex_detail.node', '=', Input::get('node_conseq'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(1))->get();
        
        if (empty($consequence)) {
            echo "insert";
            $consequence = DB::table('complex_detail_default')->select('complex_detail_default.ref1', 'complex_detail_default.type', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_conseq'))->whereIn('complex_detail_default.type', array(1))->get();
            
            foreach ($consequence as $conseq) {
                $val = Input::get($conseq->id);
                if (!empty($val)) {
                    DB::table('asset_complex_detail')->insert(['node' => Input::get('node_conseq'), 'complex_id' => Input::get('complex_conseq'), 'rows' => $conseq->rows, 'columns' => $conseq->columns, 'description' => $val, 'type' => $conseq->type, 'ref1' => $conseq->ref1, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
                } 
                else {
                    DB::table('asset_complex_detail')->insert(['node' => Input::get('node_conseq'), 'complex_id' => Input::get('complex_conseq'), 'rows' => $conseq->rows, 'columns' => $conseq->columns, 'description' => $conseq->description, 'type' => $conseq->type, 'ref1' => $conseq->ref1, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
                }
            }
        } 
        else {
            echo "update";
            foreach ($consequence as $conseq) {
                $val = Input::get($conseq->id);
                
                if (!empty($val)) {
                    DB::table('asset_complex_detail')->where('id', $conseq->id)->update(['node' => Input::get('node_conseq'), 'complex_id' => Input::get('complex_conseq'), 'rows' => $conseq->rows, 'columns' => $conseq->columns, 'description' => $val, 'type' => $conseq->type, 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
                }
            }
        }
    }
    public function postSaveocc() {
        $occorrence = array();
        
        $occorrence = DB::table('asset_complex_detail')->select('asset_complex_detail.type', 'asset_complex_detail.ref1', 'asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_occ'))->where('asset_complex_detail.node', '=', Input::get('node_occ'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(2))->get();
        
        if (empty($occorrence)) {
            echo "insert";
            $occorrence = DB::table('complex_detail_default')->select('complex_detail_default.ref1', 'complex_detail_default.type', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_occ'))->whereIn('complex_detail_default.type', array(2))->get();
            
            foreach ($occorrence as $occ) {
                $val = Input::get($occ->id);
                $ref1 = Input::get($occ->rows);
                DB::table('asset_complex_detail')->insert(['node' => Input::get('node_occ'), 'complex_id' => Input::get('complex_occ'), 'rows' => $occ->rows, 'columns' => $occ->columns, 'description' => $val, 'type' => $occ->type, 'ref1' => $ref1, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
        } 
        else {
            echo "update";
            foreach ($occorrence as $occ) {
                $val = Input::get($occ->id);
                $ref1 = Input::get($occ->rows);
                DB::table('asset_complex_detail')->where('id', $occ->id)->update(['node' => Input::get('node_occ'), 'complex_id' => Input::get('complex_occ'), 'rows' => $occ->rows, 'columns' => $occ->columns, 'description' => $val, 'ref1' => $ref1, 'type' => $occ->type, 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
            }
        }
    }
    public function postSavedec() {
        $detection = array();
        
        $detection = DB::table('asset_complex_detail')->select('asset_complex_detail.type', 'asset_complex_detail.ref1', 'asset_complex_detail.id', 'asset_complex_detail.complex_id', 'asset_complex_detail.columns', 'asset_complex_detail.rows', 'asset_complex_detail.description')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('complex_dec'))->where('asset_complex_detail.node', '=', Input::get('node_dec'))->where('asset_complex_detail.project_id', '=', Session::get('project_id'))->whereIn('asset_complex_detail.type', array(3))->get();
        
        if (empty($detection)) {
            echo "insert";
            $detection = DB::table('complex_detail_default')->select('complex_detail_default.ref1', 'complex_detail_default.type', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('complex_dec'))->whereIn('complex_detail_default.type', array(3))->get();
            foreach ($detection as $dec) {
                $val = Input::get($dec->id);
                $ref1 = Input::get($dec->rows);
                DB::table('asset_complex_detail')->insert(['node' => Input::get('node_dec'), 'complex_id' => Input::get('complex_dec'), 'rows' => $dec->rows, 'columns' => $dec->columns, 'description' => $val, 'type' => $dec->type, 'ref1' => $ref1, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
        } 
        else {
            echo "update";
            foreach ($detection as $dec) {
                $val = Input::get($dec->id);
                $ref1 = Input::get($dec->rows);
                DB::table('asset_complex_detail')->where('id', $dec->id)->update(['node' => Input::get('node_dec'), 'complex_id' => Input::get('complex_dec'), 'rows' => $dec->rows, 'columns' => $dec->columns, 'description' => $val, 'ref1' => $ref1, 'type' => $dec->type, 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
            }
        }
    }
    
    public function getType() {
        $types = array();
        $types = DB::Select(DB::raw("SELECT be.id,be.category_id,c.description,be.type_id,be.part_id
				FROM basic_equipments be
				LEFT JOIN ref_types c
				ON be.type_id = c.id
				WHERE be.active = 1
				AND be.project_id = " . Session::get('project_id') . " AND be.category_id = " . Input::get('cat_id') . " GROUP BY be.type_id"));
        return View::make('asset_register.selected.type')->with('types', $types);
    }
    
    public function getPart() {
        $parts = array();
        $parts = DB::Select(DB::raw("SELECT be.id,be.category_id,
			c.description,be.type_id,be.part_id
			FROM basic_equipments be
			LEFT JOIN ref_parts c
			ON be.type_id = c.id
			WHERE be.active = 1
			AND be.project_id = " . Session::get('project_id') . "
			AND be.type_id = " . Input::get('type_id')));
        return View::make('asset_register.selected.part')->with('parts', $parts);
    }
    
    public function getFuncfailure() {
        $func_failure = DB::Select(DB::raw("select f.id,bf.cause,bf.mode,f.worst_case from asset_basic_failure f
left join(
	select s.id,c.description as 'cause',m.description as 'mode'
	from basic_failures s
	left join ref_failure_cause c
	on s.cause_id = c.id
	left join ref_failure_mode m
	on s.mode_id = m.id
	where s.active = 1
) bf
on f.basic_failure_id = bf.id
where f.active = 1 and f.project_id = " . Session::get('project_id') . " and f.node = " . Input::get('node')));
        return View::make('asset_register.table.func_failure')->with('func_failure', $func_failure);
    }
    
    public function getBasicfailureform() {
        $failuremode = array();
        $mode = DB::Select(DB::raw("select fm.id,fm.cause_id,fm.mode_id,m.description from basic_failures fm
			left join ref_failure_mode m
			on fm.mode_id=m.id
			where fm.active = 1
			AND fm.project_id = " . Session::get('project_id')));
        
        foreach ($mode as $c) {
            $failuremode[$c->mode_id] = $c->description;
        }
        return View::make('asset_register.form.func_failure')->with(compact('failuremode'));
    }
    
    public function getCause() {
        $failurecause = array();
        $failurecause = DB::Select(DB::raw("
			select fm.id,fm.cause_id,fm.mode_id,m.description from basic_failures fm
				left join ref_failure_cause m
				on fm.cause_id=m.id
			where fm.active = 1
			AND fm.mode_id = " . Input::get('mode_id') . "
			AND fm.project_id = " . Session::get('project_id')));
        return View::make('asset_register.selected.cause')->with('failurecause', $failurecause);
    }
    
    public function postSavefuncfailure() {
        
        $failurecause = DB::Select(DB::raw("
			select * from asset_basic_failure
			where active = 1
			AND node = " . Input::get('node') . " AND basic_failure_id = " . Input::get('basic_failure_id') . "
			AND project_id = " . Session::get('project_id')));
        
        if (empty($failurecause)) {
            $rs = DB::table('asset_basic_failure')->insert(['node' => Input::get('node'), 'basic_failure_id' => Input::get('basic_failure_id'), 'worst_case' => Input::get('worst_case'), 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            if ($rs = 1) {
                echo "success";
            } 
            else {
                echo "fail";
            }
        } 
        else {
            echo "duplicate";
        }
    }
    
    public function getDeletefuncfailure() {
        $rs = DB::table('asset_basic_failure')->where('id', Input::get('id'))->update(['active' => 0, 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    public function getEditfuncfailure() {
        $assets_func = DB::Select(DB::raw("
		select f.id,f.basic_failure_id,f.node,f.worst_case,m.cause,m.mode,m.cause_id,m.mode_id from asset_basic_failure f
		left join (
			select b.id,b.cause_id,b.mode_id,c.description as 'cause',md.description as 'mode' from basic_failures b
			left join ref_failure_cause c
			on b.cause_id = c.id
			left join ref_failure_mode md
			on b.mode_id = md.id
			where b.active = 1
		) m
		on f.basic_failure_id = m.id
		where f.active = 1 and f.id=" . Input::get('id') . " and f.project_id = " . Session::get('project_id'))) [0];
        
        $mode = DB::Select(DB::raw("
				select f.id,f.mode_id,f.cause_id,m.description as 'mode',c.description as 'cause',f.project_id from basic_failures f
left join ref_failure_mode m
on f.mode_id = m.id
left join ref_failure_cause c
on f.cause_id = c.id
where f.active = 1
and f.project_id = " . Session::get('project_id')));
        
        return View::make('asset_register.form.edit_func_failure')->with('assets_func', $assets_func)->with('mode', $mode);
    }
    
    public function postUpdatefuncfailure() {
        $rs = DB::table('asset_basic_failure')->where('id', Input::get('id'))->update(['basic_failure_id' => Input::get('basic_failure_id'), 'worst_case' => Input::get('worst_case'), 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    public function getPicturelevel() {
        $picture = AssetRegister::find(Input::get('node_id'));
        return View::make('asset_register.images.picture')->with('picture', $picture);
    }
    
    public function getColourcal() {
        $asset = AssetRegister::find(Input::get('node_id'));
        if ((!empty($asset->severity) && (!empty($asset->occur)) && ($asset->detect))) {
            $step1 = DB::Select(DB::raw("select c.name,c.id from asset_complex_detail ac,complex c
			where ac.node = " . $asset->complex_node . "
			and ac.complex_id = c.id
			and ac.type = 5")) [0];
            
            $r = 0;
            $od = 0;
            $rs = 0;
            
            if ($step1->id == 1) {
                $r = 100 / 4;
            } 
            elseif ($step1->id == 2) {
                $r = 100 / 5;
            }
            
            $od = $asset->occur * $asset->detect;
            
            if ($od <= $r) {
                $rs = 1;
            } 
            elseif ($od <= $r * 2) {
                $rs = 2;
            } 
            elseif ($od <= $r * 3) {
                $rs = 3;
            } 
            elseif ($od <= $r * 4) {
                $rs = 4;
            } 
            elseif ($od <= $r * 5) {
                $rs = 5;
            }
            
            $step2 = DB::Select(DB::raw("SELECT * FROM asset_complex_detail
					WHERE active = 1 AND type = 5
					AND node = " . $asset->complex_node . "
					AND rows = " . $asset->severity . "
					AND columns = " . $rs)) [0];
            
            if ($step2->description != $asset->color) {
                $input['color'] = $step2->description;
                $asset->update($input);
            }
            
            return View::make('asset_register.table.colour_eight')->with('step2', $step2);
        }
    }
    
    public function getServoccdec() {
        $assets = array();
        $assets = DB::Select(DB::raw("SELECT s.*,d.description as 'sev_desc' FROM asset_registers s
			LEFT JOIN (select * from asset_complex_detail where type = 4 and project_id = " . Session::get('project_id') . ") d
			ON s.severity = d.rows
			WHERE s.active = 1 and  s.id = " . Input::get('node_id'))) [0];
        
        return View::make('asset_register.table.servrity_occ_dec')->with('assets', $assets);
    }
    
    public function postUpdateservoccdec() {
        $rs = DB::table('asset_registers')->where('id', Input::get('node_id'))->update(['severity' => Input::get('serv_id'), 'occur' => Input::get('occ_id'), 'detect' => Input::get('detection_id'), 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function getBasicequip() {
        $assets = array();
        $assets = DB::Select(DB::raw("select c.description as 'category',t.description as 'type',p.description as 'part',rs.id from asset_registers rs
left join ref_categories c
on rs.cat_id = c.id
left join ref_types t
on rs.type_id = t.id
left join ref_parts p
on rs.part_id = p.id
where rs.active = 1
and rs.id = " . Input::get('node_id'))) [0];
        
        return View::make('asset_register.table.basic_equip')->with('assets', $assets);
    }
    
    public function postUpdatebasicequip() {
        
        $rs = DB::table('asset_registers')->where('id', Input::get('node_id'))->update(['cat_id' => Input::get('cat_id'), 'type_id' => Input::get('type_id'), 'part_id' => Input::get('part_id'), 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function postSaveformlevel() {
        
        $check_color = array();
        $check_color = $comp_color = DB::table('asset_complex_detail')->select('*')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('com_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.type', '=', 5)->get();
        
        if (empty($check_color)) {
            
            //กรณี้ Save แบบ Default
            $comp_color = DB::table('complex_detail_default')->select('complex_detail_default.type', 'complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('com_id'))->where('complex_detail_default.type', '=', 5)->get();
            
            foreach ($comp_color as $cold) {
                DB::table('asset_complex_detail')->insert(['node' => Input::get('node_id'), 'complex_id' => Input::get('com_id'), 'rows' => $cold->rows, 'columns' => $cold->columns, 'description' => $cold->description, 'ref1' => $cold->ref1, 'type' => $cold->type, 'ref_id' => $cold->id, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
        }
        
        $mes = array();
        $input = array();
        $asset = array();
        $asset = AssetRegister::find(Input::get('node_id'));
        $input['description'] = Input::get('description');
        $input['asset_name'] = Input::get('asset_name');
        $image = Input::file('file_upload');
        if (!empty($image)) {
            $filename = date('YmdHis') . "-" . $image->getClientOriginalName();
            Image::make($image->getRealPath())->resize(468, 249)->save('public/images/level/' . $asset->level . '/' . $filename);
            $input['picture_path'] = $filename;
        }
        $input['updated_by'] = Auth::user()->id;
        if ($asset->update($input)) {
            $mes[]['message'] = 'success';
        } 
        else {
            $mes[]['message'] = 'fail';
        }
        
        echo json_encode($mes);
    }
    
    public function getTaskselection() {
        
        $func_failure = DB::Select(DB::raw("select bf.cause_id,f.id,f.color,bf.cause,bf.mode,f.worst_case,f.basic_failure_id,f.failure_effect from asset_basic_failure f
left join(
	select s.id,s.cause_id,c.description as 'cause',m.description as 'mode'
	from basic_failures s
	left join ref_failure_cause c
	on s.cause_id = c.id
	left join ref_failure_mode m
	on s.mode_id = m.id
	where s.active = 1
) bf
on f.basic_failure_id = bf.id
where f.active = 1 and f.project_id = " . Session::get('project_id') . " and f.node = " . Input::get('node_id')." and f.id = ".Input::get('id')))[0];
        
        $assets = DB::Select(DB::raw("SELECT a.*,level.description as level_desc,
				m1.name as create_name,m2.name as update_name FROM asset_registers a
				LEFT JOIN level
				ON a.level = level.level
				LEFT JOIN members m1
				ON a.created_by = m1.id
				LEFT JOIN members m2
				ON a.updated_by = m2.id
				WHERE a.active = 1
				AND a.id = " . Input::get('node_id') . "
		")) [0];
        
        $evident = array();
        $evid = DB::Select(DB::raw("select * from ref_evident where active = 1"));
        foreach ($evid as $ev) {
            $evident[$ev->evident_id] = $ev->description;
        }
        
        $failure_effect = array();
        $fail = DB::Select(DB::raw("select * from ref_failure_effect where active = 1"));
        foreach ($fail as $fa) {
            $failure_effect[$fa->failure_effect_id] = $fa->description;
        }
        
        $order_type = array();
        $order = DB::Select(DB::raw("select * from ref_order_type where active = 1 and project_id =".Session::get('project_id')));
        foreach ($order as $od) {
            $order_type[$od->id] = $od->name;
        }
        
        $statusactivity = array();
        $status = DB::Select(DB::raw("select * from ref_activity_status where active = 1"));
        foreach ($status as $st) {
            $statusactivity[$st->activity_status_id] = $st->description;
        }
        
        $taskinterval = array();
        $tskin = DB::Select(DB::raw("select * from ref_task_intervals where active = 1 and project_id = " . Session::get('project_id')));
        foreach ($tskin as $st) {
            $taskinterval[$st->interval] = $st->interval;
        }
        

        $types = array();
        $task_type = DB::Select(DB::raw("select t.*,y.description as 'type',
			l.description as 'list' from basic_tasks t
			left join ref_task_types y
			on t.type_id = y.id
			left join ref_task_lists l
			on t.list_id = l.id
			where t.active = 1 and t.project_id = " . Session::get('project_id') . "
			and t.cause_id = " . $func_failure->cause_id));
        
        foreach ($task_type as $st) {
            $types[$st->type_id] = $st->type;
        }


        return View::make('asset_register.table.failure_task_selection')
        		->with(compact('func_failure'))
        		->with('node_id', Input::get('node_id'))
        		->with('asset_basic_failure_id', Input::get('id'))
        		->with(compact('evident'))
        		->with(compact('failure_effect'))
        		->with(compact('types'))
        		->with(compact('statusactivity'))
        		->with(compact('taskinterval'))
        		->with(compact('order_type'))
        		->with(compact('assets'));
    }
    
    public function getBasictask() {
        $assets = array();
        $assets = DB::Select(DB::raw("select f.id,f.basic_failure_id,
			f.node,b.cause_id,b.mode_id from
			asset_basic_failure f
			left join basic_failures b
			on f.basic_failure_id=b.id
			where f.active = 1
			and f.project_id = " . Session::get('project_id') . "
			and f.id =" . Input::get('id'))) [0];
        
        $types = array();
        $task_type = DB::Select(DB::raw("select t.*,y.description as 'type',
			l.description as 'list' from basic_tasks t
			left join ref_task_types y
			on t.type_id = y.id
			left join ref_task_lists l
			on t.list_id = l.id
			where t.active = 1 and t.project_id = " . Session::get('project_id') . "
			and t.cause_id = " . $assets->cause_id));
        
        foreach ($task_type as $st) {
            $types[$st->type_id] = $st->type;
        }
        
        return View::make('asset_register.selected.task_type')->with(compact('types'));
    }
    
    public function getBasictaskfinal() {
        $assets = DB::Select(DB::raw("select f.id,f.basic_failure_id,
			f.node,b.cause_id,b.mode_id from asset_basic_failure f
			left join basic_failures b
			on f.basic_failure_id=b.id
			where f.active = 1
			and f.project_id = " . Session::get('project_id') . "
			and f.id =" . Input::get('id'))) [0];
        
        $type_list = array();
        $list = DB::Select(DB::raw("select t.*,y.description as 'type',
			l.description as 'list' from basic_tasks t
			left join ref_task_types y
			on t.type_id = y.id
			left join ref_task_lists l
			on t.list_id = l.id
			where t.active = 1 and t.project_id = " . Session::get('project_id') . "
			and t.cause_id = " . $assets->cause_id . " and t.type_id = " . Input::get('type_id')));
        
        foreach ($list as $st) {
            $type_list[$st->id] = $st->list;
        }
        
        return View::make('asset_register.selected.task_list')->with(compact('type_list'));
    }
    
    public function postSavetaskselection() {
        
        if (!empty(Input::get('task_selection_id'))) {
            $rs = DB::table('task_selection')->where('task_selection_id', Input::get('task_selection_id'))->update(['asset_basic_failure_id' => Input::get('asset_basic_failure_id'), 'node' => Input::get('node_id'), 'failure_effect_id' => Input::get('failure_effect_id'), 'evident_id' => Input::get('evident_id'), 'interval_num' => Input::get('interval_num'), 'interval' => Input::get('interval'), 'basic_task_id' => Input::get('basic_task_id'), 'activity_status_id' => Input::get('activity_status_id'), 'activity_detail' => Input::get('activity_detail'), 'order_type_id' => Input::get('order_type_id'), 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
        } 
        else {
            $rs = DB::table('task_selection')->insert(['asset_basic_failure_id' => Input::get('asset_basic_failure_id'), 'node' => Input::get('node_id'), 'failure_effect_id' => Input::get('failure_effect_id'), 'evident_id' => Input::get('evident_id'), 'interval_num' => Input::get('interval_num'), 'interval' => Input::get('interval'), 'basic_task_id' => Input::get('basic_task_id'), 'activity_status_id' => Input::get('activity_status_id'), 'activity_detail' => Input::get('activity_detail'), 'order_type_id' => Input::get('order_type_id'), 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
        }
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function getTaskselectiondata() {
        $taskselection = DB::Select(DB::raw("select tk.*,ef.description as 'failure_effect',ev.description as 'evident',ty.type,ot.description as 'work_center_description',
a.description as 'activity_status',ty.list,ot.name as 'order_type'
from task_selection tk
left join ref_failure_effect ef
on tk.failure_effect_id = ef.failure_effect_id
left join ref_evident ev
on tk.evident_id = ev.evident_id
left join (
	select bt.*,t.description as 'type',l.description as 'list' from basic_tasks bt
	left join ref_task_types t
	on bt.type_id = t.id
	left join ref_task_lists l
	on bt.list_id = l.id
	where bt.active = 1
) ty
on tk.basic_task_id = ty.id
left join ref_order_type ot
on tk.order_type_id=ot.id
left join ref_activity_status a
on tk.activity_status_id = a.activity_status_id
where tk.active = 1 and tk.asset_basic_failure_id = ".Input::get('asset_basic_failure_id')." and tk.project_id = " . Session::get('project_id') . " and tk.node = " . Input::get('node_id')));
        
        return View::make('asset_register.table.table_task_selection')->with('taskselection', $taskselection);
    }
    
    public function postDeletetaskselection() {
        $rs = DB::table('task_selection')->where('task_selection_id', Input::get('task_selection_id'))->update(['active' => 0, 'project_id' => Session::get('project_id'), 'updated_by' => Auth::user()->id, ]);
        
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function getEquiponnode() {
        $category = array();
        $cat = DB::Select(DB::raw("SELECT be.id,be.category_id,c.description,be.type_id,be.part_id
			FROM basic_equipments be
			LEFT JOIN ref_categories c
			ON be.category_id = c.id
			WHERE be.active = 1
			AND be.project_id = " . Session::get('project_id')));
        
        foreach ($cat as $c) {
            $category[$c->category_id] = $c->description;
        }
        
        return View::make('asset_register.form.form_basic_equip')->with(compact('category'));
    }
    
    public function postSetdetailcomplex() {
        
        $check_columns_color = array();
        $check_columns_color = DB::table('asset_complex_detail')->select('*')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('com_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.type', '=', 7)->get();
        if (empty($check_columns_color)) {
            $comp_columns_color = array();
            $comp_columns_color = DB::table('complex_detail_default')->select('complex_detail_default.type', 'complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('com_id'))->where('complex_detail_default.type', '=', 7)->get();
            foreach ($comp_columns_color as $cold) {
                DB::table('asset_complex_detail')->insert(['node' => Input::get('node_id'), 'complex_id' => Input::get('com_id'), 'rows' => $cold->rows, 'columns' => $cold->columns, 'description' => $cold->description, 'ref1' => $cold->ref1, 'type' => $cold->type, 'ref_id' => $cold->id, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
            
            echo "insert : columns color ";
        }
        
        $check_columns_conq = array();
        $check_columns_conq = DB::table('asset_complex_detail')->select('*')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('com_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->whereIn('asset_complex_detail.columns', array(Input::get('bss_unit'), 4, 5, 6))->where('asset_complex_detail.type', '=', 6)->get();
        
        if (empty($check_columns_conq)) {
            $comp_columns_conq = array();
            $comp_columns_conq = DB::table('complex_detail_default')->select('complex_detail_default.type', 'complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('com_id'))->whereIn('complex_detail_default.columns', array(Input::get('bss_unit'), 4, 5, 6))->where('complex_detail_default.type', '=', 6)->get();
            foreach ($comp_columns_conq as $cold) {
                DB::table('asset_complex_detail')->insert(['node' => Input::get('node_id'), 'complex_id' => Input::get('com_id'), 'rows' => $cold->rows, 'columns' => $cold->columns, 'description' => $cold->description, 'ref1' => $cold->ref1, 'type' => $cold->type, 'ref_id' => $cold->id, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
            
            echo "insert : columns ";
        }
        
        $check_rows = array();
        $check_rows = DB::table('asset_complex_detail')->select('*')->where('asset_complex_detail.active', '=', 1)->where('asset_complex_detail.complex_id', '=', Input::get('com_id'))->where('asset_complex_detail.node', '=', Input::get('node_id'))->where('asset_complex_detail.type', '=', 4)->get();
        
        if (empty($check_rows)) {
            $comp_rows = array();
            $comp_rows = DB::table('complex_detail_default')->select('complex_detail_default.type', 'complex_detail_default.ref1', 'complex_detail_default.id', 'complex_detail_default.complex_id', 'complex_detail_default.columns', 'complex_detail_default.rows', 'complex_detail_default.description')->where('complex_detail_default.active', '=', 1)->where('complex_detail_default.complex_id', '=', Input::get('com_id'))->where('complex_detail_default.type', '=', 4)->get();
            foreach ($comp_rows as $cold) {
                DB::table('asset_complex_detail')->insert(['node' => Input::get('node_id'), 'complex_id' => Input::get('com_id'), 'rows' => $cold->rows, 'columns' => $cold->columns, 'description' => $cold->description, 'ref1' => $cold->ref1, 'type' => $cold->type, 'ref_id' => $cold->id, 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
            }
            
            echo "insert : rows ";
        }
    }
    
    public function postSavebasic() {
        
        $rs = DB::table('asset_basic_failure')->insert(['part_id' => Input::get('part_id'), 'basic_failure_id' => Input::get('basic_failure_id'), 'node' => Input::get('node_id'), 'project_id' => Session::get('project_id'), 'created_by' => Auth::user()->id, ]);
        if ($rs == 1) {
            echo "success";
        } 
        else {
            echo "fail";
        }
    }
    
    public function getBasictable() {
        $basic = array();
        $basic = DB::Select(DB::raw("
			select af.*,p.description as parts,bf.failure_mode,bf.failure_cause from asset_basic_failure af
				left join ref_parts p
				on af.part_id = p.id
				left join (
					select f.id,m.description as failure_mode,ca.description as failure_cause from basic_failures f
					left join ref_failure_mode m
					on f.mode_id = m.id
					left join ref_failure_cause ca
					on f.cause_id = ca.id
				) bf
				on af.basic_failure_id = bf.id
				where af.active =1 and af.node = " . Input::get('node_id') . "
				and af.project_id = " . Session::get('project_id')));
        
        return View::make('asset_register.table.table_basic')->with('basic', $basic);
    }
    
    public function getFormdetail() {
        
        $basic_failure = array();
        $basic_failure = DB::Select(DB::raw("
				select * from asset_basic_failure
				where active = 1 and project_id = " . Session::get('project_id') . "
				and id = " . Input::get('id'))) [0];
        
        $severity = array();
        $servr = DB::Select(DB::raw("SELECT * FROM asset_complex_detail
				WHERE type in (4)
				AND project_id = " . Session::get('project_id') . "  AND active = 1 ORDER BY type "));
        
        foreach ($servr as $ser) {
            $severity[$ser->rows] = $ser->description;
        }
        
        $occorrence = array();
        $occor = DB::Select(DB::raw("SELECT * FROM asset_complex_detail
				WHERE type in (2)
				AND project_id = " . Session::get('project_id') . " ORDER BY type AND active = 1 "));
        
        foreach ($occor as $occ) {
            $occorrence[$occ->rows] = $occ->rows . ' - ' . $occ->description;
        }
        
        $detection = array();
        $detect = DB::Select(DB::raw("SELECT * FROM asset_complex_detail
				WHERE type in (3)
				AND project_id = " . Session::get('project_id') . " ORDER BY type AND active = 1 "));
        
        foreach ($detect as $dec) {
            $detection[$dec->rows] = $dec->rows . ' - ' . $dec->description;
        }
        
        return View::make('asset_register.form.form_fmeca')->with('id', Input::get('id'))->with('node_id', Input::get('node_id'))->with(compact('severity'))->with(compact('occorrence'))->with(compact('detection'))->with('basic_failure', $basic_failure);
    }
    
    public function postAddfmeca() {

        $rs = DB::table('asset_basic_failure')->where('id', Input::get('id'))->where('node', Input::get('node'))->update(['rpn' => Input::get('rpn'), 'severity' => Input::get('serv_id'), 'occur' => Input::get('occ_id'), 'detect' => Input::get('detection_id'), 'failure_effect_remark' => Input::get('failure_effect_remark'), 'worst_case' => Input::get('worst_case'), 'updated_by' => Auth::user()->id, ]);

            for ($i = 0; $i < count(Input::get('question')); $i++) {
                if (!empty(Input::get('question_id')[$i])) {
                    if (!empty(Input::get('answers') [$i]) && !empty(Input::get('question') [$i])) {
                        DB::table('asset_questions')
                        // ->where('asset_basic_failure_id', Input::get('id'))
                        ->where('id', Input::get('question_id')[$i])
                        ->where('project_id', Session::get('project_id'))
                        ->update([
                        	'questions' => Input::get('question') [$i],
                        	'answers' => Input::get('answers') [$i],
                        	'updated_by' => Auth::user()->id,
                        ]);
                    }
                }else {
                    if (!empty(Input::get('answers') [$i]) && !empty(Input::get('question') [$i])) {
                        $question = new AssetQuestion;
                        $question->questions = Input::get('question') [$i];
                        $question->answers = Input::get('answers') [$i];
                        $question->project_id = Session::get('project_id');
                        $question->asset_basic_failure_id = Input::get('id');
                        $question->save();
                    }
                }
            }
            $this->failurecolourcalculate(Input::get('node'), Input::get('id'));
            
            $max_basic_failure = array();
            $max_basic_failure = DB::Select(DB::raw("
				select id,max(rpn)as rpn,part_id,basic_failure_id,node,
				worst_case,severity,occur,detect,color
				from asset_basic_failure
				where active = 1 and node = " . Input::get('node') . "
				and project_id = " . Session::get('project_id'))) [0];
            
            $res = DB::table('asset_registers')->where('id', Input::get('node'))->update(['rpn' => $max_basic_failure->rpn, 'severity' => $max_basic_failure->severity, 'occur' => $max_basic_failure->occur, 'detect' => $max_basic_failure->detect, 'updated_by' => Auth::user()->id, ]);
            
            if ($res == 1) {
                $this->colourcalculate(Input::get('node'), Input::get('id'));
            }
            
            // if ($rs == 1 || $res == 1) {
               
            // }
            echo "success";
        }
        
        public function failurecolourcalculate($id = null, $asset_basic_failure_id = null) {
            $asset = array();
            reset($asset);
            $asset = DB::Select(DB::raw("
			SELECT af.*,r.complex_node FROM asset_basic_failure af
			left JOIN asset_registers r
			on af.node = r.id
			WHERE af.active = 1
			AND af.id = " . $asset_basic_failure_id . "
			AND af.node = " . $id . " AND af.project_id =" . Session::get('project_id'))) [0];
            
            if ((!empty($asset->severity)) && (!empty($asset->occur)) && (!empty($asset->detect))) {
                
                $step1 = DB::Select(DB::raw("
			select c.name,c.id from asset_complex_detail ac,complex c
			where ac.node = " . $asset->complex_node . "
			and ac.complex_id = c.id
			and ac.type = 5")) [0];
                
                $r = 0;
                $od = 0;
                $rs = 0;
                
                if ($step1->id == 1 || $step1->id == 2) {
                    $r = 100 / 4;
                } 
                elseif ($step1->id == 3) {
                    $r = 100 / 5;
                }
                
                $od = $asset->occur * $asset->detect;
                
                if ($od <= $r) {
                    $rs = 1;
                } 
                elseif ($od <= $r * 2) {
                    $rs = 2;
                } 
                elseif ($od <= $r * 3) {
                    $rs = 3;
                } 
                elseif ($od <= $r * 4) {
                    $rs = 4;
                } 
                elseif ($od <= $r * 5) {
                    $rs = 5;
                }
                
                $step2 = DB::Select(DB::raw("
					SELECT * FROM asset_complex_detail
					WHERE active = 1 AND type = 5
					AND node = " . $asset->complex_node . "
					AND rows = " . $asset->severity . "
					AND columns = " . $rs)) [0];
                
                DB::table('asset_basic_failure')->where('id', $asset_basic_failure_id)->where('node', $id)->update(['color' => $step2->description, 'failure_effect' => $step2->ref1, 'updated_by' => Auth::user()->id, ]);
            }
        }
        
        public function colourcalculate($id = null, $asset_basic_failure_id = null) {
            $asset = array();
            reset($asset);
            $asset = AssetRegister::find($id);
            if ((!empty($asset->severity) && (!empty($asset->occur)) && ($asset->detect))) {
                
                $step1 = DB::Select(DB::raw("
			select c.name,c.id from asset_complex_detail ac,complex c
			where ac.node = " . $asset->complex_node . "
			and ac.complex_id = c.id
			and ac.type = 5")) [0];
                
                $r = 0;
                $od = 0;
                $rs = 0;
                
                if ($step1->id == 1 || $step1->id == 2) {
                    $r = 100 / 4;
                } 
                elseif ($step1->id == 3) {
                    $r = 100 / 5;
                }
                
                $od = $asset->occur * $asset->detect;
                
                if ($od <= $r) {
                    $rs = 1;
                } 
                elseif ($od <= $r * 2) {
                    $rs = 2;
                } 
                elseif ($od <= $r * 3) {
                    $rs = 3;
                } 
                elseif ($od <= $r * 4) {
                    $rs = 4;
                } 
                elseif ($od <= $r * 5) {
                    $rs = 5;
                }
                
                $step2 = DB::Select(DB::raw("
					SELECT * FROM asset_complex_detail
					WHERE active = 1 AND type = 5
					AND node = " . $asset->complex_node . "
					AND rows = " . $asset->severity . "
					AND columns = " . $rs)) [0];
                
                if ($step2->description != $asset->color) {
                    $input['color'] = $step2->description;
                    $asset->update($input);
                }
                
                DB::table('asset_basic_failure')->where('id', $asset_basic_failure_id)->where('node', $id)->update(['color' => $step2->description, 'failure_effect' => $step2->ref1, 'updated_by' => Auth::user()->id, ]);
            }
        }
        
        public function getCalulatequestion() {
            $asset = array();
            $asset = AssetRegister::find(Input::get('node_fmeca'));
            $step1 = DB::Select(DB::raw("
			select c.name,c.id from asset_complex_detail ac,complex c
			where ac.node = " . $asset->complex_node . "
			and ac.complex_id = c.id
			and ac.type = 5")) [0];
            
            $r = 0;
            $od = 0;
            $rs = 0;
            
            if ($step1->id == 1 || $step1->id == 2) {
                $r = 100 / 4;
            } 
            elseif ($step1->id == 3) {
                $r = 100 / 5;
            }
            
            $od = Input::get('occ_id') * Input::get('detection_id');
            
            if ($od <= $r) {
                $rs = 1;
            } 
            elseif ($od <= $r * 2) {
                $rs = 2;
            } 
            elseif ($od <= $r * 3) {
                $rs = 3;
            } 
            elseif ($od <= $r * 4) {
                $rs = 4;
            } 
            elseif ($od <= $r * 5) {
                $rs = 5;
            }
            
            $step2 = DB::Select(DB::raw("
					SELECT * FROM asset_complex_detail
					WHERE active = 1 AND type = 5
					AND node = " . $asset->complex_node . "
					AND rows = " . Input::get('serv_id') . "
					AND columns = " . $rs)) [0];
            
            echo $step2->question;
        }
        
        function getMaxbasicfailure() {
            
            $max_basic_failure = array();
            $max_basic_failure = DB::Select(DB::raw("
				select id,max(rpn)as rpn,part_id,basic_failure_id,node,
				worst_case,severity,occur,detect,color
				from asset_basic_failure
				where active = 1 and node = " . Input::get('node') . "
				and project_id = " . Session::get('project_id'))) [0];
            
            echo $max_basic_failure->rpn;
        }
        
        public function getPropertieslevel() {
            $unit = array();
            $bss_unit = DB::Select(DB::raw("select * from complex_detail_default
			where type = 6 and columns in (1,2,3) "));
            foreach ($bss_unit as $ser) {
                $unit[$ser->columns] = $ser->description;
            }
            return View::make('asset_register.selected.business_unit')->with(compact('unit'));
        }
        
        public function getBusinessunittype() {
            $parent = array();
            $parent = DB::Select(DB::raw("select * from asset_registers where active = 1 and id = " . Input::get('node_id'))) [0];
            $bss_unit = array();
            $bss_unit = DB::Select(DB::raw("select * from asset_registers where active = 1 and id = " . $parent->parent)) [0];
            echo $bss_unit->business_unit_type_colums;
        }
        
        public function getQuestiondefault() {
            $question = array();
            $question = DB::Select(DB::raw("
			select * from ref_non_critical_questions
			where active = 1 and project_id = " . Session::get('project_id')));
            
            // print_r($question);
            
            return View::make('asset_register.form.form_question_one')->with('question', $question);
        }
        
        public function getFormquestion() {
            $question = array();
            $question = AssetQuestion::where('project_id', Session::get('project_id'))->where('active', 1)->where('asset_basic_failure_id', Input::get('id'))->get();
            
            return View::make('asset_register.form.form_question_edit')->with('question', $question);
        }

        public function getRemovequestion(){
        	 $data = AssetQuestion::find(Input::get('id'));
             $input = array();
             $input['active'] = 0;
             $input['updated_by'] = Auth::user()->id;
             if($data->update($input)){
             	echo "success";
             }
        }

        public function postImportasset(){
            $input = array(
                'file' => Input::file('import'),
            );

            $rules = array(
                'file' => 'required|max:50000',
            );

            $validator = Validator::make($input, $rules);
            if ($validator->passes()) {

                $destinationPath = 'public/import/asset';
                $extension = Input::file('import')->getClientOriginalExtension();
                $fileName = rand(11111,99999).'.'.$extension;
                $import =  Input::file('import')->move($destinationPath, $fileName);

                Excel::load($import->getPathName(), function($reader) {
                    $reader->each(function($sheet) {
                        $sheet->each(function($row) {

                            if (!empty($row->level1)) {
                                $level1 = new AssetRegister;
                                $level1->asset_name = $row->level1;
                                $level1->parent = 0;
                                $level1->level = 1;
                                $level1->active = 2;
                                $level1->project_id = Session::get('project_id');
                                $level1->save();
                            }


                            if (!empty($row->level2)) {
                                $arr_level2 = explode(',', $row->level2);
                                if (!empty($arr_level2[1])) {

                                    $bss_unit = DB::table('complex_detail_default')
                                        ->where('type','=', 6)
                                        ->whereIn('columns', [1,2,3])
                                        ->where('description','like', $arr_level2[1])
                                        ->first();

                                    if (count($bss_unit)) {

                                        $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',1)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level2[2])
                                            ->first();
                                        if (count($parent)) {
                                            $level2 = new AssetRegister;
                                            $level2->asset_name = $arr_level2[0];
                                            $level2->level = 2;
                                            $level2->active = 2;
                                            $level2->project_id = Session::get('project_id');
                                            $level2->business_unit_type_colums = $bss_unit->columns;
                                            $level2->parent = $parent->id;
                                            $level2->save();
                                        }else{
                                            DB::table('asset_registers')->where('active', '=', 2)->delete();
                                            Session::flash('message_import', 'asset hierarchy level not found !');
                                            return Redirect::to('asset-register/l8detail');
                                        }
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'business unit type not found : '.$arr_level2[1].'!');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                            if (!empty($row->level3)) {
                                $arr_level3 = explode(',', $row->level3);
                                if (!empty($arr_level3[1])) {
                                    $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',2)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level3[1])
                                            ->first();
                                    if (count($parent) > 0) {
                                        $level3 = new AssetRegister;
                                        $level3->asset_name = $arr_level3[0];
                                        $level3->level = 3;
                                        $level3->active = 2;
                                        $level3->project_id = Session::get('project_id');
                                        $level3->parent = $parent->id;
                                        $level3->save();
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'asset hierarchy level not found !');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                            if (!empty($row->level4)) {
                                $arr_level4 = explode(',', $row->level4);
                                if (!empty($arr_level4[1])) {

                                    $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',3)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level4[1])
                                            ->first();

                                    if (count($parent) > 0) {
                                        $level4 = new AssetRegister;
                                        $level4->asset_name = $arr_level4[0];
                                        $level4->level = 4;
                                        $level4->active = 2;
                                        $level4->project_id = Session::get('project_id');
                                        $level4->parent = $parent->id;
                                        $level4->save();
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'asset hierarchy level not found !');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                            if (!empty($row->level5)) {
                                $arr_level5 = explode(',', $row->level5);
                                if (!empty($arr_level5[1])) {
                                    $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',4)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level5[1])
                                            ->first();
                                    print_r($parent);
                                    if (count($parent) > 0) {
                                        $level5 = new AssetRegister;
                                        $level5->asset_name = $arr_level5[0];
                                        $level5->level = 5;
                                        $level5->active = 2;
                                        $level5->project_id = Session::get('project_id');
                                        $level5->parent = $parent->id;
                                        $level5->save();
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'asset hierarchy level not found !');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                            if (!empty($row->level6)) {
                                $arr_level6 = explode(',', $row->level6);
                                if (!empty($arr_level6[1])) {
                                    $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',5)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level6[1])
                                            ->first();
                                    if (count($parent)) {
                                        $level6 = new AssetRegister;
                                        $level6->asset_name = $arr_level6[0];
                                        $level6->level = 6;
                                        $level6->active = 2;
                                        $level6->project_id = Session::get('project_id');
                                        $level6->parent = $parent->id;
                                        $level6->save();
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'asset hierarchy level not found !');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                            if (!empty($row->level7)) {
                                $arr_level7 = explode(',', $row->level7);
                                if (!empty($arr_level7[1])) {
                                    $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',6)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level7[1])
                                            ->first();
                                    if (count($parent) > 0) {
                                        $level7 = new AssetRegister;
                                        $level7->asset_name = $arr_level7[0];
                                        $level7->level = 7;
                                        $level7->active = 2;
                                        $level7->project_id = Session::get('project_id');
                                        $level7->parent = $parent->id;
                                        $level7->save();
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'asset hierarchy level not found !');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                            if (!empty($row->level8)) {
                                $arr_level8 = explode(',', $row->level8);
                                if (!empty($arr_level8[1])) {
                                    $parent = DB::table('asset_registers')
                                            ->where('active','=', 2)
                                            ->where('level','=',7)
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->where('asset_name','=', $arr_level8[3])
                                            ->first();
                                    if (count($parent)) {
                                        $level8 = new AssetRegister;
                                        $level8->asset_name = $arr_level8[0];
                                        $level8->level = 8;
                                        $level8->active = 2;
                                        $level8->project_id = Session::get('project_id');
                                        $level8->parent = $parent->id;

                                        $category = DB::table('ref_categories')
                                            ->where('active','=', 1)
                                            ->where('description','=',$arr_level8[1])
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->first();

                                        if (count($category)) {
                                            $level8->cat_id = $category->id;
                                        }else{
                                            DB::table('asset_registers')->where('active', '=', 2)->delete();
                                            Session::flash('message_import', 'categories not found !');
                                            return Redirect::to('asset-register/l8detail');
                                        }

                                        $type = DB::table('ref_types')
                                            ->where('active','=', 1)
                                            ->where('description','=',$arr_level8[2])
                                            ->where('project_id','=',Session::get('project_id'))
                                            ->first();

                                        if (count($type)) {
                                            $level8->type_id = $type->id;
                                        }else{
                                            DB::table('asset_registers')->where('active', '=', 2)->delete();
                                            Session::flash('message_import', 'type not found !');
                                            return Redirect::to('asset-register/l8detail');
                                        }

                                        $level8->save();
                                    }else{
                                        DB::table('asset_registers')->where('active', '=', 2)->delete();
                                        Session::flash('message_import', 'asset hierarchy level not found !');
                                        return Redirect::to('asset-register/l8detail');
                                    }
                                }
                            }

                        });
                    });
                });

                DB::table('asset_registers')
                    ->where('active', 2)
                    ->update(array('active' => 1));
                // Session::flash('message', 'import asset hierarchy level successfully !');
                unlink($import->getPathName());
                return Redirect::to('asset-register/l8detail');
            }

            return Redirect::to('asset-register/l8detail')
                ->withErrors($validator)->withInput();
        }

    }