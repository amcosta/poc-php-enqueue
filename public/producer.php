<?php

use \PicPay\Enqueue\Broker\Kafka\Producer;

require __DIR__ . "/../vendor/autoload.php";

$faker = Faker\Factory::create();

$limit = 5;
for ($i = 1; $i <= $limit; $i++) {
    $payload = [
        'name' => $faker->name,
        'email' => $faker->email,
        'company' => $faker->company,
        'age' => $faker->numberBetween(18, 100),
        'password' => $faker->sha256
    ];

    (new Producer('kafka1:9092,kafka2:9098'))->produce($argv[1], $payload);
}
