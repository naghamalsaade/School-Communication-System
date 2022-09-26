<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration {

	public function up()
	{
		Schema::create('administrators', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('age');
			$table->string('certification');
			$table->string('user_name')->unique();
            $table->string('password');
			$table->unsignedBigInteger('user_id');
			$table->text('fcm_token')->nullable();
			$table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('administrators');
	}
}