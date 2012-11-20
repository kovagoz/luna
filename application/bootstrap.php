<?php

define('APP_PATH', __DIR__);

require APP_PATH . '/../vendor/autoload.php';

$app = new Pimple();

// Load services
foreach (glob(APP_PATH . '/services/*.php') as $service) {
    call_user_func(function() use ($app) {
        include func_get_arg(0);
    }, $service);
}
