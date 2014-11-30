<?php

// app/database/seeds/ClassRoomTableSeeder.php

class ClassRoomTableSeeder extends Seeder
{

	public function run()
	{
		//DB::table('subject')->delete();
		ClassRoom::create(array('class_name' => '10th', 'teacher_id' => 3));
		ClassRoom::create(array('class_name' => '+1', 'teacher_id' => 6));
		ClassRoom::create(array('class_name' => '+2','teacher_id' => 3));
				
	}

}
