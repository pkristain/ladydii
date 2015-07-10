<?php

namespace AdminModule\Presenters;


class BasePresenter extends \Presenters\BasePresenter
{
	public $primaryMenu = [
		'Default:default',
		'Page:default',
	];


	public function startup()
	{
		parent::startup();
		$this->template->adminData = $this->template->basePath.'/admin_data/';

	}


	public function beforeRender()
	{
		parent::beforeRender();

		$this->template->primaryMenu = $this->primaryMenu;
	}
}
