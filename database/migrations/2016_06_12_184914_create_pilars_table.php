<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('image');
			$table->string('code');
			$table->string('description');
			$table->timestamps();
		});

		$x = new \App\Pilar;
		$x->image = \App\Image::where('code','faicon_services_pilar')->first()['id'];
		$x->name = 'Services';
		$x->code = 'services_pilar';
		$x->description = 'Pilar for Services';
		$x->save();

		$x = new \App\Pilar;
		$x->image = \App\Image::where('code','faicon_motorcycles_pilar')->first()['id'];
		$x->name = 'Motorcycles';
		$x->code = 'motorcycles_pilar';
		$x->description = 'Pilar for Motorcycles';
		$x->save();

		$x = new \App\Pilar;
		$x->image = \App\Image::where('code','faicon_cars_pilar')->first()['id'];
		$x->name = 'Cars';
		$x->code = 'cars_pilar';
		$x->description = 'Pilar for Cars';
		$x->save();

		$x = new \App\Pilar;
		$x->image = \App\Image::where('code','faicon_trucks_pilar')->first()['id'];
		$x->name = 'Trucks';
		$x->code = 'trucks_pilar';
		$x->description = 'Pilar for Trucks';
		$x->save();


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pilars');
	}

}
