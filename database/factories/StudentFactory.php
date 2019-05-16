<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Student::class, function (Faker $faker) {
    $department_id= $faker->randomElement(DB::table('departments')->select('id')->get())->id;
    $course_id= $faker->randomElement(DB::table('courses')->select('id')->get())->id;
    return [
        'password' => bcrypt('123456'),
        'name'=>$faker->name,
        'code' => $faker->numberBetween($min=1000,$max=99999),
        'department_id'=>$department_id,
        'course_id'=>$course_id,
        'email'=>$faker->email,
        'phone'=>$faker->phoneNumber,
        'remember_token' => str_random(10),
        'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
