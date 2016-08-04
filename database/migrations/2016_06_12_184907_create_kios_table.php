<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_user');
			$table->integer('id_province');
			$table->integer('id_city');
			$table->string('address');
			$table->string('name');
			$table->string('phone');
			$table->string('accept_wa');
			$table->string('bbm');
			$table->string('description');
			$table->integer('photo');
			$table->integer('banner');
			$table->string('status');
			$table->integer('confirmed');
			$table->string('code');
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
		Schema::drop('kios');
	}

}
