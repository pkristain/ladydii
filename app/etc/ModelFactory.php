<?php
/**
 * Created by PhpStorm.
 * User: bricamry
 * Date: 17.10.14
 * Time: 22:27
 */

class ModelFactory {

	/**
	 * @var Model\SchemaTableModel
	 */
	public $schema;

	/**
	 * @var Model\PageModel
	 */
	public $page;

	/**
	 * @var Model\SessionModel
	 */
	public $session;


	public function __construct()
	{

	}


	/**
	 * @param \DibiConnection $connection
	 */
	public function initDbModels(\DibiConnection $connection)
	{
		$this->page = new \Model\PageModel($connection);
	}


	/**
	 * @param \Nette\Http\Session $session
	 */
	public function initSessionModels(\Nette\Http\Session $session)
	{
		$this->session = new \Model\SessionModel($session);
	}
} 