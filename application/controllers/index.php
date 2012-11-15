<?php

return $app['view']->render('index.html', array(
    'name' => $app['request']->get('name')
));
