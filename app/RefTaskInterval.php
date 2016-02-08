<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefTaskInterval extends Model {

	protected $table = 'ref_task_intervals';

	protected $fillable = array('id','interval','type_use','description','active','project_id', 'created_by', 'updated_by');

    public static $rules = array(
    	'interval'=>'required',
    	'description' => 'required'
    );

    public function members(){
    	return $this->belongsTo('App\Member','created_by');
    }

}