<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBasicEquipments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basic_equipments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('ref_categories');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('ref_types');
			$table->integer('part_id')->unsigned();
			$table->foreign('part_id')->references('id')->on('ref_parts');
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
		Schema::drop('basic_equipments');
	}

}
