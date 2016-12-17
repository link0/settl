<?php

use Link0\Settl\BoxRepository;
use Link0\Settl\PdoBoxRepository;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

$app['repository.box'] = new PdoBoxRepository(new PDO(
    'mysql:host=127.0.0.1:3306;dbname=vagrant',
    'vagrant',
    'vagrant'
));

$app->get('/{name}.json', function($name) use ($app) {
    /** @var BoxRepository $repository */
    $repository = $app['repository.box'];
    $box = $repository->getByName($name);

    header('Content-Type: application/json');
    return $box->toJson();
});

$app->run();
