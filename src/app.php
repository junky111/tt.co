<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;


// $config = array(
//     'debug' => true,
//     'monolog.name' => 'tt.co',
//     'monolog.level' => \Monolog\Logger::DEBUG,
//     'monolog.logfile' => __DIR__ . '/log/app.log',
//     'twig.path' => __DIR__ . '/../templates',
//     'twig.options' => array(
//         'cache' => __DIR__ . '/cache/twig',
//     ),
// );

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});





$app['app.controllers.index_controller'] = function () use ($app) {
        return new \App\Controllers\IndexController($app, $app['twig']);
};

return $app;
