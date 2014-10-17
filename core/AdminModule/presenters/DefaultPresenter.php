<?php

namespace AdminModule\Presenters;


class DefaultPresenter extends BasePresenter
{
	

	public function renderDefault()
	{
	/* DEBUG */ \Tracy\Dumper::dump($this->model->page->showPages(4)); /* DEBUG */








	/* DEBUG */ die('ahoj tady admin'); /* DEBUG */
	}
}
