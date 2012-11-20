<?php

// .:: FRONT CONTROLLER ::.

require __DIR__ . '/../application/bootstrap.php';

// Get HTTP objects
$request  = $app['request'];
$response = $app['response'];
 
try {
    // URL routing
    $result = $app['router']->match(
        $request->getPathInfo(),
        $request->getMethod()
    );
    if ($result === false) {
        throw new DomainException();
    }  
    $request->query->add($result['params']);
    $request->attributes->set('target', $result['target']);

    // Dispatch
    $response->setContent(
        call_user_func(function() use ($app) {
            return include sprintf(
                '%s/controllers/%s.php',
                APP_PATH,
                $app['request']->attributes->get('target')
            );  
        })  
    );
} catch (DomainException $e) {
    $response->setStatusCode(404);
    $response->setContent('Page not found.');
} catch (Exception $e) {
    $response->setStatusCode(500);
    $response->setContent('Internal server error.');
}

$app['response']->send();
