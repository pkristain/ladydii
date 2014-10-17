<?php

namespace Presenters;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter
{
	/**
	 * @var \DibiConnection Databse Connection
	 */
	private $connection;


	/**
	 * @var \ModelFactory Model Factory
	 */
	public $model;


	/**
	 * @return \DibiConnection
	 */
	public function getConnection()
	{
		return $this->connection;
	}


	/**
	 * @param \DibiConnection $connection
	 */
	function __construct(\DibiConnection $connection)
	{
		parent::__construct();
		$this->connection = $connection;

//		$this->context->;
		$this->model = new \ModelFactory($this->connection);


	}


}
