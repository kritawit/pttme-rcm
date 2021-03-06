<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicFailure extends Model {

	protected $table = 'basic_failures';

    protected $fillable = array('id', 'mode_id','type_use', 'cause_id','active','created_by','project_id', 'updated_by');

    public static $rules = array(
    	'mode_id' => 'required',
    	'cause_id'=>'required'
    );

    public function mode(){
		return $this->belongsTo('App\\RefFailureMode');
	}

	public function cause(){
		return $this->belongsTo('App\\RefFailureCause');
	}
}
