<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_user');
			$table->string('image_type');
			$table->string('image');
			$table->string('code');
			$table->string('used_for');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});


		$x = new \App\Image;
		$x->image_type = 'fa-icon';
		$x->image = 'fa-motorcycle';
		$x->used_for = 'pilar';
		$x->code = 'faicon_motorcycles_pilar';
		$x->name = 'Motorcycles';
		$x->description = 'Image for Motorcycles';
		$x->save();

		$x = new \App\Image;
		$x->image_type = 'fa-icon';
		$x->image = 'fa-car';
		$x->used_for = 'pilar';
		$x->name = 'Cars';
		$x->code = 'faicon_cars_pilar';
		$x->description = 'Image for Cars';
		$x->save();

		$x = new \App\Image;
		$x->image_type = 'fa-icon';
		$x->image = 'fa-wrench';
		$x->used_for = 'pilar';
		$x->name = 'Services';
		$x->code = 'faicon_services_pilar';
		$x->description = 'Image for Services';
		$x->save();

		$x = new \App\Image;
		$x->image_type = 'fa-icon';
		$x->image = 'fa-sliders';
		$x->used_for = 'pilar';
		$x->name = 'Accessories';
		$x->code = 'faicon_accessories_pilar';
		$x->description = 'Image for Accessories';
		$x->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}
