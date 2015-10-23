<?php

define('DIR_WWW', __DIR__ );

// Let bootstrap create Dependency Injection container.
$container = require __DIR__ . '/../app/bootstrap.php';

// Run application.
$container->getByType('Nette\Application\Application')->run();




