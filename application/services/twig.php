<?php

$app['view'] = $app->share(function() {
    $loader = new Twig_Loader_Filesystem(APP_ROOT . '/views');
    return new Twig_Environment($loader);
});
