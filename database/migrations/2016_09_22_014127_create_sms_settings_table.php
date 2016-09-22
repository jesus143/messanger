<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sms_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('sms_third_party_id');
			$table->string('username');
			$table->string('password');
			$table->string('app_key');
			$table->string('secret_key');
			$table->Integer('device_id');
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
		Schema::drop('sms_settings');
	}

}
