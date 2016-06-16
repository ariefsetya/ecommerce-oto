<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategorisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kategoris', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_induk');
			$table->integer('id_jenis');
			$table->string('name');
			$table->integer('image');
			$table->string('status');
			$table->string('description');
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
		Schema::drop('kategoris');
	}

}
