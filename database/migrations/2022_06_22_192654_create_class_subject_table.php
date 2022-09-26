<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSubjectTable extends Migration {

	public function up()
	{
		Schema::create('class_subject', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('school_class_id');
			$table->unsignedBigInteger('subject_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('class_subject');
	}
}