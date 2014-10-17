<?php
/**
 * Created by PhpStorm.
 * User: bricamry
 * Date: 17.10.14
 * Time: 22:19
 */

namespace Model;


class BaseModel extends \Nette\Object
{

	/**
	 * @var \DibiConnection Databse Connection
	 */
	protected $db;


	function __construct($connection)
	{
		$this->db = $connection;
	}
} 