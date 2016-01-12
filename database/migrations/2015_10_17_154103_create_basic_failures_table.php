<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicFailuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basic_failures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('mode_id')->unsigned();
			$table->foreign('mode_id')->references('id')->on('ref_failure_mode');
			$table->integer('cause_id')->unsigned();
			$table->foreign('cause_id')->references('id')->on('ref_failure_cause');
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
		Schema::drop('basic_failures');
	}

}
