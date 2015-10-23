<?php


namespace Model;


/**
 * Class TreeModel
 * @package Model
 */
class TreeModel extends \Nette\Object
{

	/**
	 *
	 */
	const KEYS_LENGHT = 4;

	/**
	 * @var array|mixed
	 */
	private $treeArray = [];

	/**
	 * @var array
	 */
	private $keys = [];


	/**
	 * @param $treeFilePath
	 */
	function __construct($treeFilePath)
	{
		$file = @file_get_contents($treeFilePath);
		$neon = new \Nette\Neon\Neon();
		$this->treeArray = $neon->decode($file);

		$this->recursive($this->getTreeArray());
	}


	/**
	 * @return array
	 */
	public function getTreeArray()
	{
		return $this->treeArray;
	}


	/**
	 * @return array
	 */
	public function getAllKeys()
	{
		return $this->keys;
	}


	/**
	 * @param $array
	 * @param int $level
	 */
	private function recursive($array, $level = 0)
	{
		if ($array === null) return;

		foreach ($array as $key => $value)
		{
			$validated = $this->validateKey($key);
			if ($validated === false) continue;

			$this->keys[$validated] = $level;
			$this->recursive($value, $level + 1);

		}

	}


	/**
	 * @param mixed žtzh$key
	 *
	 * @return bool|string
	 */
	private function validateKey($key)
	{
		if (!is_string($key) and !is_int($key)) return false;

		$string =  $key;

		if(strlen($string)> self::KEYS_LENGHT) return false;
		elseif (strlen($string) < self::KEYS_LENGHT)
		{
			$string = str_repeat('0',self::KEYS_LENGHT).$string;
			$string = substr($string, -self::KEYS_LENGHT);
		}

		$match = preg_match('/^[[:xdigit:]]{'.self::KEYS_LENGHT.'}$/', $string, $matches);
		if(!$match) return false;


		return  (string) $string;
	}

}