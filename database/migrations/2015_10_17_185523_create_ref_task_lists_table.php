<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTaskListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_task_lists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('description');
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->integer('active')->default(1);
			$table->integer('project_id')->unsigned();
		    $table->foreign('project_id')->references('id')->on('projects');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ref_task_lists');
	}

}
