<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration {

	public function up()
	{
		Schema::create('schedules', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('type');
			$table->enum('semester', array('1', '2'));
			$table->string('file');
			$table->unsignedBigInteger('class_group_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('schedules');
	}
}