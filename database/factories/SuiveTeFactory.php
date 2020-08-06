<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SuiveTe;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\DefaultGenerator;
use Faker\UniqueGenerator;
use Faker\ValidGenerator;


$factory->define(SuiveTe::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'Tractionnaire' => 1,
        'RTS_time' => $faker->dateTime,
        'Plate_Number' => $faker->sentence(1),
        'Van’s_type' => $faker->sentence(1),
        'Origin' => $faker->sentence(1),
        'Destination' => $faker->dateTime,
        'RTS_request_Time' => $faker->dateTime,
        'RTS_closing_Time' => $faker->dateTime,
        'Positionning_time' => $faker->dateTime,
        'Van_arrival_Time' => $faker->dateTime,
        'Invoice_sharing_time' => $faker->dateTime,
        'Warehouse_exit' => $faker->dateTime,
        'CustomsClearance' => $faker->dateTime,
        'Port_exit' => $faker->dateTime,
        'Arrival_Time' => $faker->dateTime,
        'Unloading_time' => $faker->dateTime,
        'Immobilisation_Loading' => $faker->dateTime,
        'Immobilisation_Unloading' => $faker->dateTime,
        'Comments_trspt_team' => $faker->sentence(1),
        'List_of_shipment_nbrs' => $faker->randomDigit,
        'Nbr_of_DNs' => $faker->randomDigit,
        'AEP_validation_Time' => $faker->dateTime,
        'WH_comments' =>$faker->sentence(1),
        'Transportation_comments' => $faker->sentence(1),
        'Poids_Taxable' => $faker->randomDigit,
        'Weight' => $faker->randomDigit,
        'Volume' => $faker->randomDigit
    ];
});
