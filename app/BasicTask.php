<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicTask extends Model {

	protected $table = 'basic_tasks';

    protected $fillable = array(
    	'id',
    	'cause_id',
    	'type_id',
    	'active',
        'type_use',
    	'list_id',
    	'created_by',
    	'updated_by','project_id'
    );

    public static $rules = array(
    	'cause_id' => 'required',
    	'type_id'=>'required',
    	'list_id'=>'required'
    );

    public function tasklist(){
    	return $this->belongsTo('App\\RefTaskList','list_id');
    }

    public function cause(){
    	return $this->belongsTo('App\\RefFailureCause','cause_id');
    }

    public function type(){
    	return $this->belongsTo('App\\RefTaskType','type_id');
    }
}
