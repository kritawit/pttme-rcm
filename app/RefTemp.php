<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RefTemp extends Model {

	protected $table = 'ref_template';

	protected $fillable = array('id','old_id','new_id','table_id','project_id');

	// 1 = ref_categories
	// 2 = ref_types
	// 3 = ref_parts
	// 4 = ref_failure_cause
	// 5 = ref_failure_mode
	// 6 = ref_task_types
	// 7 = ref_task_lists
	// 8 = ref_task_intervals
	// 9 = ref_order_type
	// 10 = ref_non_critical_question
	// 11 = basic_equipments
	// 12 = basic_failures
	// 13 = basic_tasks

}
