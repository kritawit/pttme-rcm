<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicEquipment extends Model
{

    protected $table = 'basic_equipments';

    protected $fillable = array(
    	'id', 'category_id', 'type_id','type_use','active', 'part_id','created_by','project_id', 'updated_by');

    public static $rules = array(
    	'category_id' => 'required',
    	'type_id'=>'required',
    	'part_id'=>'required'
    );

    public function category(){
		return $this->belongsTo('App\\RefCategory');
	}

	public function type(){
		return $this->belongsTo('App\\RefType');
	}

	public function part(){
		return $this->belongsTo('App\\RefPart');
	}
}