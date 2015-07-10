<?php

namespace AdminModule\Presenters;


class PagePresenter extends BasePresenter
{



	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->secondaryMenu = ['default'];
	}

	public function renderDefault()
	{
		$this->model->page->orderPages();
		$pageTree = $this->model->page->findAll()
			->orderBy('a.page_order ASC')
		;

		$this->template->pageTree = $pageTree;
	}
}
