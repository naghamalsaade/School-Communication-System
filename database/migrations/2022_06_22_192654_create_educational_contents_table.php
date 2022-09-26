<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalContentsTable extends Migration {

	public function up()
	{
		Schema::create('educational_contents', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title');
			$table->string('file');
			$table->enum('semester', array('1', '2'));
			$table->unsignedBigInteger('class_subject_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('educational_contents');
	}
}