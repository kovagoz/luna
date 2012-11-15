<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app['db'] = $app->share(function($app) {
    $dbParams = array(
        'driver' => 'pdo_sqlite',
        'path'   => APP_PATH . '/db.sqlite3'
    );

    $config = Setup::createAnnotationMetadataConfiguration(array(
        APP_PATH . '/models'
    ), true);

    return EntityManager::create($dbParams, $config);
});
