<?php

require __DIR__ .'/../bootstrap.php';

use  Tester\Assert;



$treeModel = new \Model\TreeModel(__DIR__.'/source/tree.neon');


$treeArray = array(
	array(404 => null),
	'a000' => array(
		'true' => null,
		'aa00' => array('aaa0' => array('aaaa' => null), 'aaa1' => null, 'fuck' => null),
		'ab00' => null,
		'fdfrdfds' => array('ac00' => null),
	),
	'ffff' => null,
);
Assert::same($treeArray, $treeModel->getTreeArray());

Assert::same(9, count($treeModel->getAllKeys()));

$getAllKeys = array(
	'0000' => 0,
	'0404' => 1,
	'a000' => 0,
	'aa00' => 1,
	'aaa0' => 2,
	'aaaa' => 3,
	'aaa1' => 2,
	'ab00' => 1,
	'ffff' => 0,
);
Assert::same($getAllKeys, $treeModel->getAllKeys());

