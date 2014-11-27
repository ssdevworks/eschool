<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectForeignKeyInTeachers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('teachers', function($table)
		{
		    
			DB::statement('ALTER TABLE `teachers` CHANGE COLUMN `subject` `subject` INT(11) UNSIGNED NOT NULL ;');
			$table->foreign('subject')->references('id')->on('subjects');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('teachers', function($table)
		{
		    DB::statement('ALTER TABLE `teachers` CHANGE COLUMN `subject` `subject` INT(11) NOT NULL ;');
			$table->dropForeign('teachers_subject_foreign');
		});
	}

}
