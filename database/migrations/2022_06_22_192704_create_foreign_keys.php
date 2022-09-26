<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('administrators', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('students', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('students', function(Blueprint $table) {
			$table->foreign('class_group_id')->references('id')->on('class_group')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('complaints', function(Blueprint $table) {
			$table->foreign('sender_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('complaint_receivers', function(Blueprint $table) {
			$table->foreign('complaint_id')->references('id')->on('complaints')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('complaint_receivers', function(Blueprint $table) {
			$table->foreign('receiver_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_group', function(Blueprint $table) {
			$table->foreign('school_class_id')->references('id')->on('school_classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_group', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_group', function(Blueprint $table) {
			$table->foreign('administrator_id')->references('id')->on('administrators')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('schedules', function(Blueprint $table) {
			$table->foreign('class_group_id')->references('id')->on('class_group')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_subject', function(Blueprint $table) {
			$table->foreign('school_class_id')->references('id')->on('school_classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_subject', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('educational_contents', function(Blueprint $table) {
			$table->foreign('class_subject_id')->references('id')->on('class_subject')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('attendance_checks', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('justifications', function(Blueprint $table) {
			$table->foreign('attendance_check_id')->references('id')->on('attendance_checks')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_event', function(Blueprint $table) {
			$table->foreign('school_class_id')->references('id')->on('school_classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_event', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('administrators', function(Blueprint $table) {
			$table->dropForeign('administrators_user_id_foreign');
		});
		Schema::table('students', function(Blueprint $table) {
			$table->dropForeign('students_user_id_foreign');
		});
		Schema::table('students', function(Blueprint $table) {
			$table->dropForeign('students_class_group_id_foreign');
		});
		Schema::table('complaints', function(Blueprint $table) {
			$table->dropForeign('complaints_sender_id_foreign');
		});
		Schema::table('complaint_receivers', function(Blueprint $table) {
			$table->dropForeign('complaint_receivers_complaint_id_foreign');
		});
		Schema::table('complaint_receivers', function(Blueprint $table) {
			$table->dropForeign('complaint_receivers_receiver_id_foreign');
		});
		Schema::table('class_group', function(Blueprint $table) {
			$table->dropForeign('class_group_school_class_id_foreign');
		});
		Schema::table('class_group', function(Blueprint $table) {
			$table->dropForeign('class_group_group_id_foreign');
		});
		Schema::table('class_group', function(Blueprint $table) {
			$table->dropForeign('class_group_administrator_id_foreign');
		});
		Schema::table('schedules', function(Blueprint $table) {
			$table->dropForeign('schedules_class_group_id_foreign');
		});
		Schema::table('class_subject', function(Blueprint $table) {
			$table->dropForeign('class_subject_school_class_id_foreign');
		});
		Schema::table('class_subject', function(Blueprint $table) {
			$table->dropForeign('class_subject_subject_id_foreign');
		});
		Schema::table('educational_contents', function(Blueprint $table) {
			$table->dropForeign('educational_contents_class_subject_id_foreign');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->dropForeign('marks_subject_id_foreign');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->dropForeign('marks_student_id_foreign');
		});
		Schema::table('attendance_checks', function(Blueprint $table) {
			$table->dropForeign('attendance_checks_student_id_foreign');
		});
		Schema::table('justifications', function(Blueprint $table) {
			$table->dropForeign('justifications_attendance_check_id_foreign');
		});
		Schema::table('class_event', function(Blueprint $table) {
			$table->dropForeign('class_event_school_class_id_foreign');
		});
		Schema::table('class_event', function(Blueprint $table) {
			$table->dropForeign('class_event_event_id_foreign');
		});
	}
}