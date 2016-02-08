<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetBasicFailure extends Model {

	protected $table = 'asset_basic_failure';
    
    protected $fillable = array(
        'id',
        'part_id',
        'basic_failure_id',
        'node',
        'rpn',
        'worst_case',
        'failure_effect_remark',
        'failure_effect',
        'severity',
        'occur',
        'detect',
        'asset_questions',
        'ref1',
        'ref2',
        'ref3',
        'ref4',
        'ref5',
        'ref6',
        'ref7',
        'ref8',
        'color',
        'active',
        'created_by',
        'updated_by',
        'project_id'
    );

}
