<?php

use Carbon\Carbon;

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

$factory->define(App\Models\Business\Business::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'slug' => $faker->domainWord,
    ];
});

$factory->define(App\Models\Emails\Sequence::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
        'remote_plan_id' => $faker->md5,
    ];
});

$factory->define(App\Models\Emails\Email::class, function (Faker\Generator $faker) {
    return [
        'subject' => $faker->sentence,
        'body' => $faker->paragraphs(4, true),
        'delay' => 0,
        'index' => 0
    ];
});

$factory->define(App\Models\Invoice::class, function (Faker\Generator $faker) {
    return [
        'remote_id'                 => $faker->sentence,
        'amount'                    => $faker->randomNumber(),
        'currency'                  => 'usd',
        'status'                    => 'complete',
        'date_due'                  => Carbon::now(),
        'remote_customer_id'        => $faker->md5,
        'remote_subscription_id'    => $faker->md5,
        'remote_plan_id'            => $faker->md5
    ];
});

// $factory->define(App\CardUpdateToken::class, function (Faker\Generator $faker) {
// Don't think we need this, but stubbing out just in case
// });

$factory->define(App\Models\Customer\Customer::class, function (Faker\Generator $faker) {
    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'email'             => $faker->safeEmail,
        'remote_id'         => $faker->md5
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
