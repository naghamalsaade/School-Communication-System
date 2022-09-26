<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration {

	public function up()
	{
		Schema::create('complaints', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('title');
			$table->text('text');
			$table->date('date');
			$table->unsignedBigInteger('sender_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('complaints');
	}
}