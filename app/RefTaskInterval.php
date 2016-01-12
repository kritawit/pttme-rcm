<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefTaskInterval extends Model {

	protected $table = 'ref_task_intervals';

	protected $fillable = array('id','interval','description','active','project_id', 'created_by', 'updated_by');

    public static $rules = array(
    	'interval'=>'required',
    	'description' => 'required'
    );

}
