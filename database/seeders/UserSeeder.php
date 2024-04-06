<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->insert(([
                [
                    'id' => (string) Str::uuid(),
                    'name' => "Biro",
                    'personal_email' => "biro@ukdw.ac.id",
                    'campus_email' => "biro@ukdw.ac.id",
                    'role_id' => DB::table('roles')
                                ->where('name' ,'biro')
                                ->first()
                                ->id,
                    'password' => bcrypt('password'),
                    'created_by' => 'Seeder',
                    'updated_by' => 'Seeder',
                ]
            ]));
    }
}
