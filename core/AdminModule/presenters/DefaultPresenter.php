<?php

namespace AdminModule\Presenters;


class DefaultPresenter extends BasePresenter
{
	

	public function renderDefault()
	{
		$this->model->page->orderPages();
		$pages = $this->model->page->findAll()->fetchAll();
		foreach ($pages as $page)
		{
			foreach ($page as $col)
			{
				echo $col . ' - ';
			}
		echo '<br>';
		}

		//		/* DEBUG */ \Tracy\Dumper::dump($this->model->page->findAll()->fetchAll()); /* DEBUG */
	}
}
