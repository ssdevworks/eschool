<?php

// app/database/seeds/SubjectTableSeeder.php

class SubjectTableSeeder extends Seeder
{

	public function run()
	{
		//DB::table('subject')->delete();
		Subject::create(array('subject_name' => 'Tamil'));
		Subject::create(array('subject_name' => 'English'));
		Subject::create(array('subject_name' => 'Maths'));
		Subject::create(array('subject_name' => 'Science'));
		Subject::create(array('subject_name' => 'Social'));
		Subject::create(array('subject_name' => 'Physics'));
		Subject::create(array('subject_name' => 'Chemisty'));		
	}

}
