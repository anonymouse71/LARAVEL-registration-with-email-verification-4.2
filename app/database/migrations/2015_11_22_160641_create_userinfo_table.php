<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userinfo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('fullName')->nullable();
			$table->boolean('activation');
			$table->string('activation_key')->nullable();
			$table->string('address')->nullable();
			$table->string('company')->nullable();
			$table->string('paypal_id')->nullable();
			$table->string('contact')->nullable();
			$table->string('avatar_url')->nullable();
			$table->string('icon_url')->nullable();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('userinfo');
	}

}
