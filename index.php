<?php

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$service = ServiceAccount::fromJsonFile(__DIR__.'/Secret/tester-428f8-094d4f06ab73.json');

$factory = (new Factory)
    ->withServiceAccount($service)
    // The following line is optional if the project id in your credentials file
    // is identical to the subdomain of your Firebase project. If you need it,
    // make sure to replace the URL with the URL of your project.
    ->withDatabaseUri('https://tester-428f8.firebaseio.com/');

$database = $factory->createDatabase();

die(print_r($database));