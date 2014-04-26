<?php

require __DIR__. '/lib/Nette/loader.php';
require	__DIR__. '/lib/dibi/dibi.php';

$configurator = new Nette\Configurator;

$dirStorage = master_dir.'/_storage';
$dirLog= $dirStorage.'/log';
$dirTemp= $dirStorage.'/temp';

if (!file_exists($dirLog)) mkdir($dirLog, 0777, true);
$configurator->enableDebugger($dirLog);

if (!file_exists($dirTemp)) mkdir($dirTemp, 0777, true);
$configurator->setTempDirectory($dirTemp);

$configurator->addConfig(master_dir . '/config/config.neon');
$configurator->addConfig(master_dir . '/config/config.local.neon');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$container = $configurator->createContainer();

