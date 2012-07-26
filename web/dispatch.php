<?php

// load Tonic
require_once '../src/Tonic/Autoloader.php';
require_once '../lib/Pimple.php';
require_once '../src/Itec/Hello.php';
require_once '../src/Itec/Object.php';
require_once '../src/Itec/ObjectCollection.php';

$config = array(
    //'load' => array('../*.php', '../src/Tyrell/*.php'), // Load example resources
    'load' => array('../*.php', '../src/Itec/*.php'), // load resources
    #'mount' => array('Tyrell' => '/nexus'), // mount in example resources at URL /nexus
    #'cache' => new Tonic\MetadataCache('/tmp/tonic.cache') // use the metadata cache
);

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