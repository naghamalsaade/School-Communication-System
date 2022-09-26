<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceChecksTable extends Migration {

	public function up()
	{
		Schema::create('attendance_checks', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->date('date');
			$table->string('type');
			$table->unsignedBigInteger('student_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('attendance_checks');
	}
}