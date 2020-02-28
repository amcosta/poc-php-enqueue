<?php

use \PicPay\Enqueue\Broker\Kafka\Producer;

require __DIR__ . "/../vendor/autoload.php";

$faker = Faker\Factory::create();

$limit = 1;
for ($i = 1; $i <= $limit; $i++) {
    $payload = [
        'name' => $faker->name,
        'email' => $faker->email,
        'company' => $faker->company,
        'age' => $faker->numberBetween(18, 100),
        'password' => $faker->sha256,
        'execution_time' => $faker->numberBetween(1, 25)
    ];

    $payload = ['resourceId' => 23];
//    {"resourceId": 23}

    $server = '10.151.16.167:9092,10.151.16.167:9098';
//    $server = 'kafka1:9092';

    (new Producer($server))->produce($argv[1], $payload);
}
