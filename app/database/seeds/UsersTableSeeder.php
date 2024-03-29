<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = [
			[
				'email'      => 'ratul27@gmail.com',
				'password'   => Hash::make('a'),
				'user_name'   => 'talha',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			]

		];

		DB::table('users')->insert($users);
	}

}