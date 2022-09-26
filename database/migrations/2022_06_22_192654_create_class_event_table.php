<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassEventTable extends Migration {

	public function up()
	{
		Schema::create('class_event', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('school_class_id');
			$table->unsignedBigInteger('event_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('class_event');
	}
}