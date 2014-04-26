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
	private $db;

	/**
	 * @return \DibiConnection
	 */
	public function getDb()
	{
		return $this->db;
	}

	function __construct(\DibiConnection $connection)
	{
		$this->db = $connection;
	}


}
