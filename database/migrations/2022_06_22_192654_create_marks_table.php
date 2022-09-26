<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration {

	public function up()
	{
		Schema::create('marks', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('type');
			$table->enum('semester', array('1', '2'));
			$table->string('value')->default(0.00);
			$table->unsignedBigInteger('subject_id');
			$table->unsignedBigInteger('student_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('marks');
	}
}