<?php

namespace AdminModule\Presenters;


class BasePresenter extends \Presenters\BasePresenter
{

	public function startup()
	{
		parent::startup();
		$this->template->adminData = $this->template->basePath.'/admin_data/';
	}
}
