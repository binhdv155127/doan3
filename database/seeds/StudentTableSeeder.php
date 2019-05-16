<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('students')->insert([
//            'name' => 'Student',
//            'email' => 'student@gmail.com',
//            'password' => bcrypt('123456')
//        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('students')->truncate();

        factory(App\Student::class, 10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
