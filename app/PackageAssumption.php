<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageAssumption extends Model {

	protected $table = 'package_assumptions';

	protected $fillable = array('id', 'name', 'description','active', 'project_id', 'created_by', 'updated_by');

    public static $rules = array('name' => 'required', 'description' => 'required');


    

}