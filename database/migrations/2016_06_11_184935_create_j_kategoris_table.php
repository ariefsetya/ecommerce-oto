<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJKategorisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('j_kategoris', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('image');
			$table->string('status');
			$table->string('code');
			$table->string('purpose');
			$table->string('description');
			$table->timestamps();
		});

		$x = new \App\JKategori;
		$x->name = 'Year';
		$x->image = 0;
		$x->code = 'year';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Year';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Vehicle Mileage';
		$x->code = 'vehicle_mileage';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Vehicle Mileage';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Engine Size';
		$x->code = 'engine_size';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Engine Size';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Model';
		$x->code = 'model';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Model';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Model';
		$x->code = 'model';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Model';
		$x->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('j_kategoris');
	}

}
