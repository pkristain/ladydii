<?php

	
 const master_dir = __DIR__;
 
$container = require __DIR__ . '/LadyDii/bootstrap.php';



$container->getService('application')->run();





