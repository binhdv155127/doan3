<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CourseTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('courses')->truncate();

        $name = [55,56,57,58,59,60,61,62,63,64];

        foreach ($name as $st) {
            DB::table('courses')->insert([
                'course' => $st,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
