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
		$x = new \App\Appconfig;
		$x->key = 'panel_title';
		$x->type = 'page-home';
		$x->value = 'Who We Are';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'panel_description';
		$x->type = 'page-home';
		$x->value = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal letters, as opposed to using Content here.';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'contact_us';
		$x->type = 'page-home';
		$x->value = 'Contact Us';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'contact_hq';
		$x->type = 'page-home';
		$x->value = 'Our headquarters';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'contact_place';
		$x->type = 'page-home';
		$x->value = 'center for financial assistance to deposed nigerian royalty';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'contact_phone';
		$x->type = 'page-home';
		$x->value = '+0 561 111 235';
		$x->save();
		$x = new \App\Appconfig;
		$x->key = 'contact_email';
		$x->type = 'page-home';
		$x->value = 'mail@example.com';
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
