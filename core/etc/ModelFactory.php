<?php
/**
 * Created by PhpStorm.
 * User: bricamry
 * Date: 17.10.14
 * Time: 22:27
 */

class ModelFactory {
	/**
	 * @var \DibiConnection Databse Connection
	 */
	private $connection;

	/**
	 * @var Model\SchemaModel
	 */
	public $schema;

	/**
	 * @var Model\PageModel
	 */
	public $page;

	/**
	 * @param \DibiConnection $connection
	 */
	function __construct(\DibiConnection $connection)
	{
		$this->connection = $connection;

		$this->schema = new \Model\SchemaModel($this->connection);
		$this->page = new \Model\PageModel($this->connection);
	}
} 