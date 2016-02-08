<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\RefCategory;
use App\RefPart;
use App\RefType;
use App\RefFailureMode;
use App\RefTaskType;

use View;
use Input;
use Redirect;
use Validator;
use Session;
use Auth;
use Response;
use DB;
use PDF;


class ReportController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getCategory(){
		$categories =array();

		foreach (RefCategory::where('project_id','=',Session::get('project_id'))
			->where('active','=',1)
			->get() as $category) {
			$categories[$category->id] = $category->description;
		}

		return View::make('report.report_by_category')
			->with('categories',$categories);
	}

	public function getType(){
		$types = array();

		foreach (RefType::where('project_id','=',Session::get('project_id'))
			->where('active','=',1)
			->get() as $type) {
			$types[$type->id] = $type->description;
		}

		return View::make('report.report_by_type')
			->with('types',$types);
	}

	public function postCategory(){

    	$where = '';
    	if (!empty(Input::get('category_id'))) {
    		$where .= ' AND cat_id ='.Input::get('category_id');
    	}
			$data = array();
			$cat = array();
			$cat = RefCategory::find(Input::get('category_id'));
			$data =	DB::Select(DB::raw("select c.description as category,a.* from asset_registers a
				left join ref_categories c
				on a.cat_id = c.id
				where a.level = 8 $where and a.project_id = " . Session::get('project_id')));

			$input = array('asset_name' => $data);
			$rules = array(
        		'asset_name' => 'required',
    		);

    		$messages = array(
    			'asset_name.required' =>'data not found!',
    		);

			$validator = Validator::make($input, $rules,$messages);
			if ($validator->passes()) {

				$count = DB::Select(DB::raw("select count(*) as 'total' from asset_registers a
				left join ref_categories c
				on a.cat_id = c.id
				where a.level = 8 $where and a.project_id = " . Session::get('project_id')))[0];
				$total = $count->total;


				// return View::make('report.print.report_category')
				// ->with(compact('cat'))
				// ->with('total',$total)
				// ->with('data',$data);

				$view =  \View::make('report.print.report_category')
				->with(compact('cat'))
				->with('total',$total)
				->with('data',$data)->render();
        		$pdf = \App::make('dompdf.wrapper');
        		$pdf->loadHTML($view);
        		return $pdf->stream();
			}
		return Redirect::to('report/category')
			->withErrors($validator)->withInput();


	}

	public function postType(){

		$where = '';
		if (!empty(Input::get('type_id'))) {
			$where .= ' AND a.type_id = '.Input::get('type_id');
		}
			$data = array();
			$type = array();
			$type = RefType::find(Input::get('type_id'));
			$data =	DB::Select(DB::raw("select t.description as type,a.* from asset_registers a
				left join ref_types t
				on a.type_id = t.id
				where a.level = 8 $where and a.project_id = " . Session::get('project_id')));

			$input = array('asset_name' => $data);
			$rules = array(
        		'asset_name' => 'required',
    		);

    		$messages = array(
    			'asset_name.required' =>'data not found!',
    		);

			$validator = Validator::make($input, $rules,$messages);
			if ($validator->passes()) {

				$count = DB::Select(DB::raw("select count(*) as 'total' from asset_registers a
				left join ref_types t
				on a.type_id = t.id
				where a.level = 8 $where and a.project_id = " . Session::get('project_id')))[0];
				$total = $count->total;


        		$view =  \View::make('report.print.report_type')
						->with(compact('type'))
						->with('total',$total)
						->with('data',$data)->render();
        		$pdf = \App::make('dompdf.wrapper');
        		$pdf->loadHTML($view);
        		return $pdf->stream();
			}
		return Redirect::to('report/type')
			->withErrors($validator)->withInput();



	}

	public function getChartsunit(){
		return View::make('report.report_chart_unit');
	}

	public function postChartsunit(){
		$input = array('chart_type' => Input::get('chart_type'));
		$rules = array(
        	'chart_type' => 'required',
    	);
    	$messages = array(
    			'chart_type.required' =>'Please select the Equipment Type!',
    	);
    	$validator = Validator::make($input, $rules,$messages);
		if ($validator->passes()) {
			if (Input::get('chart_type')==1) {
				return View::make('report.chart.chart_unit_categories');
			}else if(Input::get('chart_type')==2){
				return View::make('report.chart.chart_unit_type');
			}
		}
		return Redirect::to('report/chartsunit')
			->withErrors($validator)->withInput();
	}

	public function getChartcategory(){
		$category = DB::Select(DB::raw("
				select c.description,COUNT(c.id) as 'units' from  asset_registers a
				inner join ref_categories c
				on a.cat_id = c.id
				where a.level = 8 and a.active = 1
				and a.project_id = " . Session::get('project_id')." group by c.description "));

		$chart = array();
        $temp = array();
        foreach ($category as $val) {
            $chart['label'] = $val->description;
            $chart['y'] = $val->units;
            $temp[] = $chart;
        }

        return Response::json($temp);
	}

	public function getCharttype(){
		$types = DB::Select(DB::raw("
				select c.description,COUNT(a.type_id) as 'units' from  asset_registers a
				inner join ref_types c
				on a.type_id = c.id
				where a.level = 8 and a.active = 1
				and a.project_id = " . Session::get('project_id')." group by c.description "));

		$chart = array();
        $temp = array();
        foreach ($types as $val) {
            $chart['label'] = $val->description;
            $chart['y'] = $val->units;
            $temp[] = $chart;
        }

        return Response::json($temp);
	}

	public function getChartpercent(){
		return View::make('report.report_chart_percent');
	}

	public function postChartpercent(){

		$input = array('chart_type' => Input::get('chart_type'));
		$rules = array(
        	'chart_type' => 'required',
    	);
    	$messages = array(
    			'chart_type.required' =>'Please select the Equipment Type!',
    	);
    	$validator = Validator::make($input, $rules,$messages);
		if ($validator->passes()) {
			if (Input::get('chart_type')==1) {
				return View::make('report.chart.chart_percent_categories');
			}else if(Input::get('chart_type')==2){
				return View::make('report.chart.chart_percent_type');
			}
		}
		return Redirect::to('report/chartpercent')
			->withErrors($validator)->withInput();
	}

	public function getChartpercentcategories(){
		$sum = DB::Select(DB::raw("SELECT\n".
"	SUM(T1.units)as 'total'\n".
"FROM\n".
"	(\n".
"		SELECT\n".
"			c.description AS category,\n".
"			COUNT(a.cat_id) AS 'units'\n".
"		FROM\n".
"			asset_registers a\n".
"		LEFT JOIN ref_categories c ON a.cat_id = c.id\n".
"		WHERE\n".
"			a. LEVEL = 8\n".
"		AND a.project_id = ".Session::get('project_id')."\n".
"		GROUP BY\n".
"			c.description\n".
"	)T1"))[0];

		$category = DB::Select(DB::raw("
				select c.description,COUNT(c.id) as 'units' from  asset_registers a
				inner join ref_categories c
				on a.cat_id = c.id
				where a.level = 8 and a.active = 1
				and a.project_id = " . Session::get('project_id')." group by c.description "));

		$chart = array();
        $temp = array();
        foreach ($category as $val) {
            $chart['label'] = $val->description;
            $per = $val->units * 100 / $sum->total;
            $chart['y'] = (double)number_format($per,2);
            $temp[] = $chart;
        }
        return Response::json($temp);
	}

	public function getChartpercenttype(){
		$sum = DB::Select(DB::raw("SELECT\n".
"	SUM(T1.units)as 'total'\n".
"FROM\n".
"	(\n".
"		SELECT\n".
"			c.description AS type,\n".
"			COUNT(a.type_id) AS 'units'\n".
"		FROM\n".
"			asset_registers a\n".
"		LEFT JOIN ref_types c ON a.type_id = c.id\n".
"		WHERE\n".
"			a. LEVEL = 8\n".
"		AND a.project_id = ".Session::get('project_id')."\n".
"		GROUP BY\n".
"			c.description\n".
"	)T1"))[0];

		$type = DB::Select(DB::raw("
				select c.description,COUNT(a.type_id) as 'units' from  asset_registers a
				inner join ref_types c
				on a.type_id = c.id
				where a.level = 8 and a.active = 1
				and a.project_id = " . Session::get('project_id')." group by c.description "));

		$chart = array();
        $temp = array();
        foreach ($type as $val) {
            $chart['label'] = $val->description;
            $per = $val->units * 100 / $sum->total;
            $chart['y'] = (double)number_format($per,2);
            // $chart['y'] = $val->units * 100 / $sum->total;
            $temp[] = $chart;
        }
        return Response::json($temp);
	}

	public function getFailuremode(){
		$mode = array();

		foreach (RefFailureMode::where('project_id','=',Session::get('project_id'))
			->where('active','=',1)
			->get() as $m) {
			$mode[$m->id] = $m->description;
		}

		return View::make('report.report_by_failuremode')
			->with('mode',$mode);
	}

	public function postFailuremode(){
		// $input = array('mode_id' => Input::get('mode_id'));
		// $rules = array(
  //       	'mode_id' => 'required',
  //   	);
  //   	$validator = Validator::make($input, $rules);
		// if ($validator->passes()) {
		
		$where = '';
		if (!empty(Input::get('mode_id'))) {
			$where .= "WHERE T1.mode_id = ".Input::get('mode_id');
		}

			$data = array();
			$mode = array();
			$mode = RefFailureMode::find(Input::get('mode_id'));
			$data =	DB::Select(DB::raw("
				SELECT
	*
FROM
	(
		SELECT
			b.mode,
			b.mode_id,
			s.asset_name,s.description,
			f.*
		FROM
			asset_basic_failure f
		INNER JOIN (
			SELECT
				bf.id,
				m.description AS 'mode',
				m.id AS 'mode_id'
			FROM
				basic_failures bf
			LEFT JOIN ref_failure_mode m ON bf.mode_id = m.id
			WHERE
				m.active = 1
		) b ON f.basic_failure_id = b.id
		INNER JOIN asset_registers s ON f.node = s.id
		WHERE
			f.active = 1
		AND f.project_id = ".Session::get('project_id')."
	) T1
$where GROUP BY T1.asset_name"));

			$input = array('asset_name' => $data);
			$rules = array(
        		'asset_name' => 'required',
    		);

    		$messages = array(
    			'asset_name.required' =>'data not found!',
    		);

			$validator = Validator::make($input, $rules,$messages);
			if ($validator->passes()) {

				$count = DB::Select(DB::raw("SELECT\n".
"	COUNT(DISTINCT T1.asset_name) as 'total'\n".
"FROM\n".
"	(\n".
"		SELECT\n".
"			b.mode,\n".
"			b.mode_id,\n".
"			s.asset_name,s.description,\n".
"			f.*\n".
"		FROM\n".
"			asset_basic_failure f\n".
"		INNER JOIN (\n".
"			SELECT\n".
"				bf.id,\n".
"				m.description AS 'mode',\n".
"				m.id AS 'mode_id'\n".
"			FROM\n".
"				basic_failures bf\n".
"			LEFT JOIN ref_failure_mode m ON bf.mode_id = m.id\n".
"			WHERE\n".
"				m.active = 1\n".
"		) b ON f.basic_failure_id = b.id\n".
"		INNER JOIN asset_registers s ON f.node = s.id\n".
"		WHERE\n".
"			f.active = 1\n".
"		AND f.project_id = ".Session::get('project_id')."\n".
"	) T1\n".
" $where"))[0];
				$total = $count->total;

				$view =  \View::make('report.print.report_failuremode')
				->with(compact('mode'))
				->with('total',$total)
				->with('data',$data)->render();
        		$pdf = \App::make('dompdf.wrapper');
        		$pdf->loadHTML($view);
        		return $pdf->stream();
			}

		return Redirect::to('report/failuremode')
			->withErrors($validator)->withInput();
	}

	public function getFailureeffect(){
		return View::make('report.report_chart_failure_eff');
	}

	public function postFailureeffect(){
		return View::make('report.chart.chart_unit_failureeffect')->with('type',Input::get('chart_type'));
	}

	public function getChartfailureeffect(){
		$where = '';
		if (!empty(Input::get('type'))) {
			$where .= "WHERE T1.failure_effect = '".Input::get('type')."'";
		}
		$category = DB::Select(DB::raw("select T1.failure_effect,COUNT(DISTINCT T1.asset_name) as 'unit' from (\n".
"	select s.asset_name,f.node,f.failure_effect,f.rpn,f.id from asset_basic_failure f\n".
"	inner join asset_registers s\n".
"	on f.node = s.id \n".
"	WHERE f.active = 1 and f.rpn and f.project_id =".Session::get('project_id')."\n".
")T1\n".
" $where \n".
"GROUP BY T1.failure_effect"));

		$chart = array();
        $temp = array();
        foreach ($category as $val) {
            $chart['label'] = $val->failure_effect;
            $chart['y'] = $val->unit;
            $temp[] = $chart;
        }

        return Response::json($temp);
	}

	public function getFormtypeandfailureeffect(){
		$ref_types = array();
		$ref_types = RefType::where('project_id',Session::get('project_id'))
						->where('active',1)
						->get();

		$types = array();

		foreach ($ref_types as $ty) {
			$types[$ty->id] = $ty->description;
		}

		return View::make('report.report_by_type_failure_effect')->with(compact('types'));
	}

	public function postTypefailureeffect(){
		$where = '';
		if (!empty(Input::get('type_id'))) {
			$where .= " s.type_id = ".Input::get('type_id')." and  ";

			$type_data = array();
			$type_data = RefType::find(Input::get('type_id'));
			$type = array(
				'title' => $type_data->description,
			);
		}else{
			$type = array(
				'title' => 'All Equipment Type',
			);
		}
		$data = array();
		$data = DB::Select(DB::raw("select t.description as 'type',count(n.failure_effect) as 'non_critical',count(c.failure_effect) as 'critical' from asset_registers s\n".
"INNER join ref_types t\n".
"on s.type_id = t.id\n".
"LEFT JOIN (\n".
"	SELECT * FROM asset_basic_failure where failure_effect = 'Non Critical' and active = 1\n".
") n\n".
"on s.id = n.node\n".
"LEFT JOIN (\n".
"	SELECT * FROM asset_basic_failure where failure_effect = 'Critical' and active = 1\n".
") c\n".
"on s.id = c.node\n".
"where $where s.active = 1 and s.level = 8 and s.project_id = ".Session::get('project_id')."\n".
"group by t.description "));

				if (count($data)) {
					$view = \View::make('report.print.report_type_failure_effect')
					->with(compact('type'))
					->with('data',$data)->render();

        			$pdf = \App::make('dompdf.wrapper');
        			$pdf->loadHTML($view);
        			return $pdf->stream();
				}

	}

	public function getTasktype(){
		$tasktype = array();
		foreach (RefTaskType::where('project_id',Session::get('project_id'))
			->where('active',1)->get() as $ty) {
			$tasktype[$ty->id] = $ty->description;
		}

		return View::make('report.report_chart_task_type')->with(compact('tasktype'));
	}

	public function postCharttasktype(){
		$data = array();
		$where = '';
		if (!empty(Input::get('type_id'))) {
			$where .= ' AND b.task_type_id = '.Input::get('type_id');
		}

		$data = DB::Select(DB::raw(
			"select b.id,b.task_type_id,b.task_type,COUNT(t.node)as 'units' from task_selection t\n".
"inner join (\n".
"	select t.id,r.id as 'task_type_id',r.description as 'task_type' from basic_tasks t\n".
"	inner join ref_task_types r\n".
"	on t.type_id = r.id\n".
")b\n".
"on t.basic_task_id = b.id\n".
"where t.active = 1 $where  and t.project_id = ".Session::get('project_id')."\n".
"group by b.task_type"
		));

		$chart = array();
        $temp = array();
        foreach ($data as $val) {
            $chart['label'] = $val->task_type;
            $chart['y'] = $val->units;
            $temp[] = $chart;
        }

        $json = json_encode($temp);

        if (count($data)) {
	        return View::make('report.chart.chart_unit_tasktype')->with(compact('json'));
		}
	}
}
