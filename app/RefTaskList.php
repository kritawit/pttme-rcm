<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefTaskList extends Model {

	protected $table = 'ref_task_lists';

	protected $fillable = array('id','description','type_use','project_id','active', 'created_by', 'updated_by');

    public static $rules = array(
    	'description' => 'required'
    );

}
