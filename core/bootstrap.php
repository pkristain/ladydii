<?php

require __DIR__ . '/../libs/autoload.php';

define('DIR_ROOT', __DIR__ . '/../');

define('DIR_CORE', __DIR__ );

define('DIR_STORAGE',DIR_ROOT . '_storage');
define('DIR_LOG', DIR_STORAGE . '/log');
define('DIR_TEMP', DIR_STORAGE . '/log');

$configurator = new Nette\Configurator;

if (!file_exists(DIR_LOG)) mkdir(DIR_LOG, 0777, true);
$configurator->enableDebugger(DIR_LOG);

if (!file_exists(DIR_TEMP)) mkdir(DIR_TEMP, 0777, true);
$configurator->setTempDirectory(DIR_TEMP);

$configurator->addConfig(DIR_CORE . '/config/config.neon');

//$configurator->addConfig( __DIR__ . '/../_site/config.neon');
//$configurator->addConfig( __DIR__ . '/../_site/config.local.neon');

$configurator->createRobotLoader()
	->addDirectory(DIR_CORE)
	->register();



return $configurator->createContainer();

