<?php

namespace FrontModule\Presenters;


class DefaultPresenter extends BasePresenter
{


	public function renderDefault()
	{
		$tables = $this->model->schema->getTables();
		/* DEBUG */ \Tracy\Dumper::dump($tables); /* DEBUG */

	}
}
