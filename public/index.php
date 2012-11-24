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

    // Process routing target
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

        // Run controller
        $content = call_user_func(function() use ($app) {
            return include sprintf(
                '%s/controllers/%s.php',
                APP_ROOT,
                $app['request']->attributes->get('target')
            );  
        });

        // Set response by content type
        switch (true) {
            case is_array($content);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(json_encode($content));
                break;

            default:
                $response->setContent($content);
                break;
        }
    }
} catch (DomainException $e) {
    $response->setStatusCode(404);
    $response->setContent('Page not found.');
}

$app['response']->send();
