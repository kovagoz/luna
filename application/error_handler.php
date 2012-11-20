<?php

register_shutdown_function(function() {
    $error = error_get_last();
    if (!ini_get('display_errors')
        && in_array($error['type'], array(E_ERROR, E_PARSE))
    ) {
        readfile(__DIR__ . '/views/error/500.html');
    }
});
