<?php

// retrieve EntityManager
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;


$app = require_once __DIR__.'/../src/app.php';
require_once __DIR__.'/../src/registers.php';


$isDevMode = $app['debug'];
$paths = array($app['db.orm.entities'][0]['path']);

$cache = new \Doctrine\Common\Cache\ArrayCache();

$reader = new AnnotationReader();
$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, $paths);
AnnotationRegistry::registerLoader('class_exists');
// $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setMetadataCacheImpl( $cache );
$config->setQueryCacheImpl( $cache );
$config->setMetadataDriverImpl( $driver );

$entityManager = EntityManager::create($app['db.options'], $config);

return ConsoleRunner::createHelperSet($entityManager);