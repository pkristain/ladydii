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
	 * @var \WebLoader\Nette\LoaderFactory
	 * @inject
	 */
	public $webLoader;


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
	public function __construct(\DibiConnection $connection)
	{
		parent::__construct();
		$this->connection = $connection;


	}


	public function startup()
	{
		parent::startup();

		$this->setModels();
	}


	private function setModels()
	{
		$this->model = new \ModelFactory();
		$this->model->initDbModels($this->connection);
		$this->model->initSessionModels($this->session);
	}

	/** @return CssLoader */
	protected function createComponentCss()
	{
		return $this->webLoader->createCssLoader('admin');
	}


	/** @return JavaScriptLoader */
	protected function createComponentJs()
	{
		return $this->webLoader->createJavaScriptLoader('admin');
	}

}
