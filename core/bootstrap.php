<?php

require __DIR__ . '/../libs/Nette/loader.php';

$configurator = new Nette\Configurator;

$dirStorage = __DIR__ . '/../_storage';

$dirLog= $dirStorage.'/log';
$dirTemp= $dirStorage.'/temp';

if (!file_exists($dirLog)) mkdir($dirLog, 0777, true);
$configurator->enableDebugger($dirLog);

if (!file_exists($dirTemp)) mkdir($dirTemp, 0777, true);
$configurator->setTempDirectory($dirTemp);

$configurator->addConfig(__DIR__ . '/config/config.neon');

//$configurator->addConfig( __DIR__ . '/../_site/config.neon');
//$configurator->addConfig( __DIR__ . '/../_site/config.local.neon');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__.'/../libs')
	->register();



return $configurator->createContainer();