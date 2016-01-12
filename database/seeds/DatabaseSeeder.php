<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder
{
	public function run(){
		DB::table('members')->delete();
		DB::table('members')->insert([
			'email'=>'admin@mail.com',
			'name'=>'Administrator',
			'username'=>'admin',
			'password'=>bcrypt('admin'),
			'created_at'=>date('Y-m-d H:i:s'),
			'role'=>3
		]);
	}
}
