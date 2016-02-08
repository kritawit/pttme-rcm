<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefType extends Model {

	
	protected $fillable = array('id','description','type_use','project_id','active', 'created_by', 'updated_by');

    public static $rules = array('description' => 'required|unique:ref_types');

    public function members(){
    	return $this->belongsTo('App\Member','created_by');
    }
}
