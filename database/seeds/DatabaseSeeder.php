<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CourseTableSeed::class,
            DepartmentTableSeed::class,
            TeacherTableSeeder::class,
            StudentTableSeeder::class,
            ProjectTableSeed::class,
            UserTableSeed::class
        ]);
    }
}
