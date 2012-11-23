<?php

define('APP_ROOT', __DIR__);

require APP_ROOT . '/../vendor/autoload.php';

$app = new Pimple();

// Load services
foreach (glob(APP_ROOT . '/services/*.php') as $service) {
    call_user_func(function() use ($app) {
        include func_get_arg(0);
    }, $service);
}
