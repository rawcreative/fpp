<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('universes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('active');
			$table->integer('universe');
			$table->integer('start_address');
			$table->integer('size');
			$table->enum('type', ['unicast', 'multicast']);
			$table->string('unicast_address')->nullable();
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
		Schema::drop('universes');
	}

}
