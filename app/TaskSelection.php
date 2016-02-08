<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskSelection extends Model {

	protected $table = 'task_selection';
    
    protected $fillable = array(
        'task_selection_id',
        'node',
        'asset_basic_failure_id',
        'failure_effect_id',
        'evident_id',
        'order_type_id',
        'interval_num',
        'interval',
        'basic_task_id',
        'activity_status_id',
        'activity_detail',
        'active',
        'project_id',
        'created_by',
        'updated_by'
    );


}
