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
		$x->name = 'For Sale By';
		$x->code = 'for_sale_by';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar For Sale By';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Exterior Color';
		$x->code = 'exterior_color';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Exterior Color';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Make';
		$x->code = 'make';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Make';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Condition';
		$x->code = 'condition';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Condition';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Format';
		$x->code = 'format';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Format';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Item Location';
		$x->code = 'item_location';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Item Location';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Sellers Type';
		$x->code = 'sellers_type';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Sellers Type';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Delivery Options';
		$x->code = 'delivery_options';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Delivery Options';
		$x->save();
		$x = new \App\JKategori;
		$x->image = 0;
		$x->name = 'Return Accepted';
		$x->code = 'return_accepted';
		$x->status = 'active';
		$x->purpose = 'J-K';
		$x->description = 'Sub Pilar Return Accepted';
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
