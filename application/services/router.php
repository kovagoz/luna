<?php

/**
 * URL router
 *
 * Build routing table from YAML configuration read from config/router.yml.
 * If a rule's target contains "://", we parse it as URL and do a 301 redirect.
 */

use Symfony\Component\Yaml\Parser;

$app['router'] = $app->share(function() {
    $file = file_get_contents(APP_PATH . '/configs/router.yml');
    if ($file === false) {
        throw new Exception('Route config not found.');
    }
    $yaml   = new Parser();
    $routes = $yaml->parse($file);
    $router = new AltoRouter();
    foreach ($routes as $name => $route) {
        $method = implode('|', (array) $route['method']);
        $router->map($method, $route['map'], $route['target'], $name);
    }
    return $router;
});
