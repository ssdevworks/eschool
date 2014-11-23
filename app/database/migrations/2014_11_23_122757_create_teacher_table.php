<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teachers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fname', 30);
			$table->string('lname', 30);
			$table->tinyInteger('gender')->default(0);
			$table->date('dob');
			$table->string('email', 70);
			$table->string('mobile', 14);
			$table->date('doj');
			$table->integer('subject');
			$table->string('qualification', 70);
			$table->string('experience', 30);
			$table->tinyInteger('marital_status')->default(0);
			$table->tinyInteger('blood_group')->default(0);
			$table->tinyInteger('status')->default(1);
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
		Schema::drop('teachers');
	}

}
