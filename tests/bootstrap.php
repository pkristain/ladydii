<?php

// The Nette Tester command-line runner can be
// invoked through the command: ../vendor/bin/tester .

if (@!include __DIR__ . '/../libs/autoload.php') {
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

define('DIR_TESTS', __DIR__.'/');





// configure environment
Tester\Environment::setup();
date_default_timezone_set('Europe/Prague');


// create temporary directory
define('TEMP_DIR', __DIR__ . '/tmp/' . getmypid());
@mkdir(dirname(TEMP_DIR)); // @ - directory may already exist
Tester\Helpers::purge(TEMP_DIR);

$robot = new \Nette\Loaders\RobotLoader();
$robot->addDirectory('app/model')
->setCacheStorage(new Nette\Caching\Storages\FileStorage(DIR_TESTS.'tmp'))
->register()
;

function test(\Closure $function)
{
	$function();
}


class Notes
{
	public static $notes = array();

	public static function add($message)
	{
		self::$notes[] = $message;
	}

	public static function fetch()
	{
		$res = self::$notes;
		self::$notes = array();
		return $res;
	}

}
