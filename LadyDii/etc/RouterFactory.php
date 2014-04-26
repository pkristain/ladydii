<?php


use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;


/**
 * Class RouterFactory
 * @package App
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();


		$router[] = new Route('admin', array(
				'module' => 'Admin',
				'presenter' => 'Default',
				'action' => 'default',
				'path' => NULL
			)
		);
		
		
		$router[] = new Route('<path .+>', array(
				'module' => 'Front',
				'presenter' => 'Default',
				'action' => 'default',
				'path' => NULL
			)
		);
		
		
		return $router;
	}

}
