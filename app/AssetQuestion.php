<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetQuestion extends Model {

	protected $table = 'asset_questions';
    
    protected $fillable = array(
        'id',
        'asset_basic_failure_id',
        'questions',
        'answers',
        'active',
        'project_id',
        'created_by',
        'updated_by'
    );

}
