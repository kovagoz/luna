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

    // Dispatch
    if (strstr($result['target'], '://') !== false) {
        header('Location: ' . $result['target']);
        exit();
    } else if (substr($result['target'], -5) == '.html') {
        $response->setContent($app['view']->render(
            $result['target'],
            $result['params']
        ));
    } else {
        $request->query->add($result['params']);
        $request->attributes->set('target', $result['target']);

        $response->setContent(
            call_user_func(function() use ($app) {
                return include sprintf(
                    '%s/controllers/%s.php',
                    APP_PATH,
                    $app['request']->attributes->get('target')
                );  
            })  
        );
    }
} catch (DomainException $e) {
    $response->setStatusCode(404);
    $response->setContent('Page not found.');
}

$app['response']->send();
