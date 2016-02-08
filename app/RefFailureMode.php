<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefFailureMode extends Model {
	protected $table = 'ref_failure_mode';

	protected $fillable = array('id','description','type_use','project_id','active', 'created_by', 'updated_by');

    public static $rules = array(
    	'description' => 'required'
    );

    public function members(){
    	return $this->belongsTo('App\Member','created_by');
    }
}