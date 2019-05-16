<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DepartmentTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('departments')->truncate();

        $name = ['Software Engineering','Computer Science','Computer Engineering','Data communication and Computer network'];

        foreach ($name as $st) {
            DB::table('departments')->insert([
                'department' => $st,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
