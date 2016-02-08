<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefOrderType extends Model {

	protected $table = 'ref_order_type';

	protected $fillable = array('id','name','type_use','description','project_id','active', 'created_by', 'updated_by');

    public static $rules = array(
    	'description' => 'required',
    	'name'=>'required'
    );

    public function members(){
    	return $this->belongsTo('App\Member','created_by');
    }
}
