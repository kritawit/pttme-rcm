<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageAssumption extends Model {

	protected $table = 'package_assumptions';

	protected $fillable = array('id', 'package_name', 'product_process_function'
		,'assumtion_for_rcm','active', 'project_id', 'created_by', 'updated_by');

    public static $rules = array(
    	'package_name' => 'required',
    	'product_process_function' => 'required',
    	'assumtion_for_rcm' => 'required'
    );
}