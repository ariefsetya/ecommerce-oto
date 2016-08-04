<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('cities', function(Blueprint $table)
		// {
		// 	$table->increments('id');
		// 	$table->integer('id_provinsi');
		// 	$table->string('provinsi');
		// 	$table->string('nama');
		// 	$table->string('type');
		// 	$table->string('kodepos');
		// 	$table->timestamps();
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('cities');
	}

}
