<?php
require_once '../src/Tonic/Autoloader.php';
require_once '../lib/Pimple.php';

// set up the container
$container = new Pimple();
$container['dsn'] = 'mysql://root:root@localhost/tonic';
$container['database'] = function ($c) {
    return new DB($c['dsn']);
};
$container['dataStore'] = function ($c) {
    return new DataStore($c['database']);
};

$app = new Tonic\Application();
$request = new Tonic\Request();
$resource = $app->getResource($request);

// make the container available to the resource before executing it
$resource->container = $container;

$response = $resource->exec();
$response->output();
