<?php

// app/database/seeds/UserTableSeeder.php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Shatheesh',
			'username' => 'shatheesh',
			'email'    => 'shatheeshece@yahoo.co.in',
			'password' => Hash::make('test123'),
		));
	}

}
