<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_kios');
			$table->integer('id_pilar');
			$table->integer('id_user');
			$table->string('name');
			$table->string('description');
			$table->string('pilar_addon');
			$table->integer('stok');
			$table->integer('status');
			$table->integer('promo');
			$table->integer('price_range');
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
		Schema::drop('products');
	}

}
