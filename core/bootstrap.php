<?php
require __DIR__. '/define.php';



$way = 	__DIR__. '/lib/Nette/loader.php';
if (!is_file( $way ))
	{
	die('nette not found');
	}	
require $way;

$way = 	__DIR__. '/lib/dibi/dibi.php';
if (!is_file( $way ))
	{
	die('dibi not found');
	}	
require $way;


echo localhost;

$configurator = new Nette\Configurator;

//$configurator->setDebugMode(true);  // debug mode MUST NOT be enabled on production server
$configurator->enableDebugger(master_dir . '/log');

//$configurator->setTempDirectory(__DIR__ . '/../temp');

/*
$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../vendor/others')
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

return $container;
//  */



