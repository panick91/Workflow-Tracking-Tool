<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(WTT\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(WTT\EISRequest::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->randomNumber(),
        'external_id2' => "IIPA6509",
        'name' => $faker->randomLetter . $faker->randomNumber(),
        'start_dt' => "2015-04-08 10:22:27",
        'end_dt' => "2015-05-04 00:00:00"
    ];
});


$factory->define(WTT\Project::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomNumber(),
        'state' => "Activated",
        'name' => $faker->randomLetter . $faker->randomNumber(),
        'update_dt' => "2015-04-08"
    ];
});

$factory->define(WTT\EISRequestInfo::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomNumber(),
        'eisrequest_id' => $faker->randomNumber()
    ];
});

$factory->define(WTT\EHI_SunCla::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomNumber(),
        'deliverdt' => "2015-04-08"
    ];
});

$factory->define(WTT\Network::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(WTT\NetworkNode::class, function (Faker\Generator $faker) {
    return [
        'milestone' => 1
    ];
});

$factory->define(WTT\MilestoneTemplate::class, function (Faker\Generator $faker) {
    return [
        'milestonetemplategroup_id' => 22
    ];
});