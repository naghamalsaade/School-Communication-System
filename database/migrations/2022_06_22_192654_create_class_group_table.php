<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassGroupTable extends Migration {

	public function up()
	{
		Schema::create('class_group', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('school_class_id');
			$table->unsignedBigInteger('group_id');
			$table->unsignedBigInteger('administrator_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('class_group');
	}
}