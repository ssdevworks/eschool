<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fname', 30);
			$table->string('lname', 30);
			$table->string('email', 70);
			$table->string('mobile', 14);
			$table->tinyInteger('relation')->unsigned()->default(0);
			$table->integer('student_id')->unsigned();
			$table->tinyInteger('status')->default(1);
			$table->integer('user_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
		Schema::drop('parents');
	}

}
