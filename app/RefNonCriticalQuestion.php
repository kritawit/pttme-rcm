<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefNonCriticalQuestion extends Model {

	protected $table = 'ref_non_critical_questions';

	protected $fillable = array('id','questions','type_use','project_id','active', 'created_by', 'updated_by');

    public static $rules = array(
    	'questions' => 'required'
    );

    public function members(){
    	return $this->belongsTo('App\Member','created_by');
    }

}
