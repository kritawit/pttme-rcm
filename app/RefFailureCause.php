<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefFailureCause extends Model {
	protected $table = 'ref_failure_cause';

	protected $fillable = array('id','description','type_use','project_id','active', 'created_by', 'updated_by');

    public static $rules = array('description' => 'required');
}
