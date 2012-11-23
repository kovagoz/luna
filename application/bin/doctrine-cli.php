<?php

use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Helper\HelperSet;

require __DIR__ . '/../bootstrap.php';

$helperSet = new HelperSet(array(
    'em' => new EntityManagerHelper($app['em'])
));

ConsoleRunner::run($helperSet);
