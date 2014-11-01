<?php

namespace AdminModule\Presenters;


class DefaultPresenter extends BasePresenter
{



	public function beforeRender()
	{
		parent::beforeRender();
		$this->template->secondaryMenu = ['default'];
	}


	public function renderDefault()
	{
		$result = $this->getHttpRequest()->getUrl()->host;
		$this->addInfoVar('Host',$result, true, true);

		$result = $this->getHttpRequest()->isSecured();
		$this->addInfoVar('Secured connection',($result? 'true': 'false'), $result);

		$parameters = $this->context->getParameters();
		$result = $parameters['database']['prefix'];
		$this->addInfoVar('Tables prefix',($result == null ? 'null' : $result), ($result != null));

		$totalPages = $this->model->page->findAll()->count();
		$this->addInfoVar('Pages total',$totalPages, ($totalPages != 0));

		$result = $this->model->page->findOrphans()->count();
		$this->addInfoVar('Number of orphan pages', $result, ($result == 1));

		$result = $this->model->page->findAll()
			->where('a.page_level IS NULL')
			->or('a.page_order IS NULL')
			->or('a.page_general_visibility IS NULL')
			->count();
		$this->addInfoVar('Number of unordered pages', $result, ($result == 0));



	}



	private function addInfoVar($label = null, $value = null, $ok = true, $info = false)
	{
		if (!isset($this->template->infoVars))
		{
			$this->template->infoVars = [];
		}
		$this->template->infoVars[] = [
			'label' => $label,
			'value' => $value,
			'type' => (
					$ok ? (
					$info ? 'info' : 'ok'
					) : 'error'
				),
		];
	}
}
