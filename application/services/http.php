<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

$app['request'] = $app->share(function() {
    return Request::createFromGlobals();
});

$app['response'] = $app->share(function() {
    return new Response();
});

$app['session'] = $app->share(
    function () {
        return new Session();
    }
);
