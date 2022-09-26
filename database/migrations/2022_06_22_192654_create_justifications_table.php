<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificationsTable extends Migration {

	public function up()
	{
		Schema::create('justifications', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('text');
			$table->string('file')->default('null');
			$table->unsignedBigInteger('attendance_check_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('justifications');
	}
}