<?php

require __DIR__ . '/../application/bootstrap.php';

// Routing
$app['request']->attributes->set('controller', 'index');

// Dispatch
try {
    $app['response']->setContent(
        call_user_func(function() use ($app) {
            return include sprintf(
                '%s/controllers/%s.php',
                APP_PATH,
                $app['request']->attributes->get('controller')
            );
        })
    );
} catch (Exception $e) {
    $app['response']->setStatusCode(500);
    $app['response']->setContent('Internal server error.');
}

$app['response']->send();
