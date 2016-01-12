<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetRegistersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset_registers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent')->unsigned();
			$table->string('asset_name');
			$table->integer('cat_id')->unsigned();
			$table->foreign('cat_id')->references('id')->on('ref_categories');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('ref_types');
			$table->integer('part_id')->unsigned();
			$table->foreign('part_id')->references('id')->on('ref_parts');
			$table->string('drawno');
			$table->string('description');
			$table->integer('level')->unsigned();
			$table->integer('rpn')->unsigned();
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
		Schema::drop('asset_registers');
	}

}
