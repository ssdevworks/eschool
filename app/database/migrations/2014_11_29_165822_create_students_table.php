<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fname', 30);
			$table->string('lname', 30);
			$table->tinyInteger('gender')->default(0);
			$table->date('dob');
			$table->string('mobile', 14);
			$table->date('doj');
			$table->string('native_place', 70);			
			$table->tinyInteger('blood_group')->default(0);
			$table->tinyInteger('status')->default(1);
			$table->integer('user_id')->unsigned();
			$table->integer('class_room_id')->unsigned();
			$table->foreign('class_room_id')->references('id')->on('class_rooms');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
	}

}
