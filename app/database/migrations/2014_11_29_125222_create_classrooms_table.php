<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('class_rooms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('class_name', 30);
			$table->integer('teacher_id')->unsigned();
			$table->tinyInteger('status')->nullable()->default(1);
			$table->timestamps();			
			$table->foreign('teacher_id')->references('id')->on('teachers');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('class_rooms');
	}

}
