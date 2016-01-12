<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\RefCategory;
use App\RefPart;
use App\RefType;

use View;
use Input;
use Redirect;
use Validator;
use Session;
use Auth;
use Response;

use JasperPHP;


class ReportController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getEquipment(){
		$categories =array();
		$types = array();
		$parts = array();

		foreach (RefCategory::where('project_id','=',Session::get('project_id'))
			->where('active','=',1)
			->get() as $category) {
			$categories[$category->id] = $category->description;
		}

		foreach (RefType::where('project_id','=',Session::get('project_id'))
			->where('active','=',1)
			->get() as $type) {
			$types[$type->id] = $type->description;
		}

		foreach (RefPart::where('project_id','=',Session::get('project_id'))
			->where('active','=',1)
			->get() as $part) {
			$parts[$part->id] = $part->description;
		}

		return View::make('report.equipment')
			->with('categories',$categories)
			->with('types',$types)
			->with('parts',$parts);
	}

	public function getPrint(){
		JasperPHP::process(
    		base_path() . '/vendor/cossou/jasperphp/examples/hello_world.jasper',
    		false,
    		array("pdf", "rtf"),
    		array("php_version" => phpversion())
		)->execute();
	}

	public function postEquipment(){

		// $database = \Config::get('database.connections.mysql');
  //       $output = public_path() . '\report\\'.time().'_equipment';
  //       $ext = "pdf";
  //       $filejas = public_path() . '/report/equipment2.jasper';
  //      	JasperPHP::process(
  //           $filejas,
  //           $output,
  //           array($ext),
  //           array(),
  //           $database,
  //           false,
  //           false
  //       )->execute();

        // header('Content-Description: File Transfer');
        // header('Content-Type: application/octet-stream');
        // header('Content-Disposition: attachment; filename='.time().'_equipment.'.$ext);
        // header('Content-Transfer-Encoding: binary');
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        // header('Pragma: public');
        // header('Content-Length: ' . filesize($output.'.'.$ext));
        // flush();
        // readfile($output.'.'.$ext);
        // unlink($output.'.'.$ext); // deletes the temporary file
    	//Build your Laravel Response with your content, the HTTP code and the Header application/pdf
		$file = public_path() . '/report/demo_report.pdf';
        $content = file_get_contents($file);
    	return Response::make($content, 200,array('content-type'=>'application/pdf'));

	}

}
