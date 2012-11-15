<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app['request'] = $app->share(function() {
    return Request::createFromGlobals();
});

$app['response'] = $app->share(function() {
    return new Response();
});
