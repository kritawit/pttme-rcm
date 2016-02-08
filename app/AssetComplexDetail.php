<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetComplexDetail extends Model {

	protected $table = 'asset_complex_detail';
    
    protected $fillable = array(
        'id',
        'node',
        'complex_id',
        'rows',
        'columns',
        'description',
        'type',
        'ref1',
        'ref_id',
        'question',
        'active',
        'created_by',
        'updated_by',
        'project_id'
    );

}
