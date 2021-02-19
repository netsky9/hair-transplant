<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      => 'Unnamed',
                'email'     => 'noemail@g.g',
                'password'  => bcrypt(Str::random(16))
            ],
            [
                'name'      => 'Administrator',
                'email'     => 'admin@g.g',
                'password'  => bcrypt('root')
            ],
        ];
        \DB::table('users')->insert($users);
    }
}
