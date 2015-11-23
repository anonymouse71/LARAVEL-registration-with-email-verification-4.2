<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');


		$this->call('RolesTableSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('EntrustTableSeeder');
		$this->call('UserInfoTableSeeder');
		//$this->call('PriceListTableSeeder');

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	}

}
