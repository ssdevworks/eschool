<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeachersMakeDefaultNull extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE `teachers` MODIFY `marital_status` TINYINT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `teachers` MODIFY `blood_group` TINYINT NULL DEFAULT 0; ');
		DB::statement('ALTER TABLE `teachers` MODIFY `experience` varchar(30) NULL;');
		DB::statement('ALTER TABLE `teachers` MODIFY `qualification` varchar(70) NULL;');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE `teachers` MODIFY `marital_status` TINYINT NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `teachers` MODIFY `blood_group` TINYINT NOT NULL DEFAULT 0;');
		DB::statement('ALTER TABLE `teachers` MODIFY `experience` varchar(30) NOT NULL;');
		DB::statement('ALTER TABLE `teachers` MODIFY `qualification` varchar(70) NOT NULL;');
	}

}
