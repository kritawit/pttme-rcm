<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $table = 'projects';

	protected $fillable = array('id','name','member_id','active', 'created_by', 'updated_by');

    public static $rules = array(
    	'name' => 'required'
    );
}