<?php

namespace FrontModule\Presenters;


class DefaultPresenter extends BasePresenter
{
	

	public function renderDefault()
	{
		/* DEBUG */ \Tracy\Dumper::dump($this->getDb()); /* DEBUG */
	}
}
