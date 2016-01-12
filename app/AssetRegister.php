<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetRegister extends Model
{
    
    protected $table = 'asset_registers';
    
    protected $fillable = array(
        'id', 
        'color', 
        'parent', 
        'asset_name', 
        'description',
        'level', 
        'picture_path', 
        'cat_id', 
        'type_id', 
        'drawing', 
        'severity', 
        'occur', 
        'detect', 
        'rpn', 
        'basic_failure_id',
        'active',
        'project_id',
        'complex_node', 
        'created_by', 
        'updated_by'
    );
    
    public static $rules = array('level' => 'required', 'asset_name' => 'required');
    
    public function category() {
        return $this->belongsTo('App\\RefCategory');
    }
    
    public function type() {
        return $this->belongsTo('App\\RefType');
    }
    
    public function part() {
        return $this->belongsTo('App\\RefPart');
    }
}
