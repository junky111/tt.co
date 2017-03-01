<?php 

use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ArrayCache;

$db_config = require __DIR__.'/../config/db/mysql_config.php';

$app->register(new Silex\Provider\DoctrineServiceProvider(), array('db.options' => $db_config));

$app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(), array(
    'db.orm.proxies_dir'           => __DIR__.'/../cache/doctrine/proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.cache'                 =>
        !$app['debug'] && extension_loaded('apc') ? new ApcCache() : new ArrayCache(),

    'db.orm.auto_generate_proxies' => true,
    'db.orm.auto_mapping' =>  true,
    'db.orm.entities'              => array(array(
    	'alias'	 	=> 'core',
        'type'      => 'annotation',       
        'path'      => __DIR__.'/../src/Entities/',   
        'namespace' => 'App\Entities',
        'use_simple_annotation_reader' => false
    )),
    'orm.em.mappings' => array(
        'App\Entities' => '~'
    ),
    'orm.em.options' => array(
	    'mappings' => array(
	        array(
	            'type' => 'annotation',
		        'path'      => __DIR__.'/../src/Entities/',   
		        'namespace' => 'App\Entities',
	        ),
	    ),
        'entity_dirs' => array(
            array('path' => __DIR__ . '/../src/Entities')
            // array('path' => __DIR__ . '/../src/Bar/Entity'),
            // ...
        ),
	)
));