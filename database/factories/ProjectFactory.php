<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    $department_id= $faker->randomElement(DB::table('departments')->select('id')->get())->id;
    $student_id= $faker->randomElement(DB::table('students')->select('id')->get())->id;
    $teacher_id= $faker->randomElement(DB::table('teachers')->select('id')->get())->id;
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'student_id' => $student_id,
        'teacher_id' => $teacher_id,
        'department_id' => $department_id,
        'progress' => $faker->numberBetween($min=0,$max=100),
        'read_me' => $faker->text,
        'data'=>$faker->text,
        'citation'=>$faker->text,
        'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
