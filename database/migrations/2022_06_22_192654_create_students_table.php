<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('father_name');
			$table->string('mother_name');
			$table->string('phone');
			$table->string('user_name')->unique();
            $table->string('password');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('class_group_id');
			$table->text('fcm_token')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
}