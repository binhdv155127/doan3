<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('teachers')->insert([
//            'name' => 'Teacher',
//            'email' => 'teacher@gmail.com',
//            'password' => bcrypt('123456')
//        ]);
        Schema::disableForeignKeyConstraints();
        DB::table('teachers')->truncate();

        factory(App\Teacher::class, 10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
