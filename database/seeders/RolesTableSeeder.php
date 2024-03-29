<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'title'      => 'Administrator'
            ],
            [
                'title'      => 'User'
            ],
            [
                'title'      => 'Unnamed'
            ],
        ];
        \DB::table('roles')->insert($roles);
    }
}
