<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_user');//if user is login
			$table->string('tmp_name');//if user not login
			$table->string('tmp_email');//if user not login
			$table->string('tmp_phone');//if user not login
			$table->integer('to');
			$table->text('message');
			$table->string('uniqid');
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
		Schema::drop('chats');
	}

}
