<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app['em'] = $app->share(function($app) {
    $dbParams = array(
        'driver' => 'pdo_sqlite',
        'path'   => APP_ROOT . '/data/db.sqlite3'
    );

    $config = Setup::createAnnotationMetadataConfiguration(array(
        APP_ROOT . '/data/entities'
    ), true);

    return EntityManager::create($dbParams, $config);
});
