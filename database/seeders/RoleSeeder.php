<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')
            ->insert(([
                [
                    'id' => (string) Str::uuid(),
                    'name' => "mahasiswa"
                ],
                [
                    'id' => (string) Str::uuid(),
                    'name' => "biro"
                ],
                [
                    'id' => (string) Str::uuid(),
                    'name' => "wr3"
                ],
                [
                    'id' => (string) Str::uuid(),
                    'name' => "wd3"
                ],
                [
                    'id' => (string) Str::uuid(),
                    'name' => "dosen"
                ]
            ]));
    }
}
