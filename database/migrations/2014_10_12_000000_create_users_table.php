<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('status');
			$table->string('type');
			$table->integer('id_province');
			$table->integer('id_city');
			$table->integer('id_store');
			$table->string('role');
			$table->text('address');
			$table->integer('photo');
			$table->integer('banner');
			$table->integer('confirmed');
			$table->string('code');
			$table->rememberToken();
			$table->timestamps();
		});

		$a = new \App\User;
		$a->name = 'Arief Setya';
		$a->email = 'ariefsetya@live.com';
		$a->password = bcrypt('windows10');
		$a->role = 'admin';
		$a->save();
		$a = new \App\User;
		$a->name = 'Revalinostesia';
		$a->email = 'reval@live.com';
		$a->password = bcrypt('windows10');
		$a->role = 'user';
		$a->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
