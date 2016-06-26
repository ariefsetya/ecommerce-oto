<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppconfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appconfigs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('key');
			$table->string('type');
			$table->string('value');
			$table->timestamps();
		});

		$x = new \App\Appconfig;
		$x->key = 'title';
		$x->type = 'page-home';
		$x->value = '<span>Bursa</span>Oto';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'btn_signin';
		$x->type = 'page-home';
		$x->value = 'Sign In';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'btn_heading_url';
		$x->type = 'page-home';
		$x->value = 'ads_create';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'btn_signup';
		$x->type = 'page-home';
		$x->value = 'Sign Up';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'heading';
		$x->type = 'page-home';
		$x->value = 'Sell and advertise automotive online with BursaOto';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'subheading';
		$x->type = 'page-home';
		$x->value = 'You\'ve Got It!';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'btn_heading';
		$x->type = 'page-home';
		$x->value = 'Create New Ad';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'body_heading';
		$x->type = 'page-home';
		$x->value = 'Most Popular';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'foot_heading';
		$x->type = 'page-home';
		$x->value = 'BursaOto';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'img_banner';
		$x->type = 'page-home';
		$x->value = 'assets/images/advanced_manufacturing.jpg';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'foot_subheading';
		$x->type = 'page-home';
		$x->value = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum. ';
		$x->save();

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('appconfigs');
	}

}
