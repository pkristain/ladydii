<?php


use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;


/**
 * Router factory.
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
		
		$router[] = new Route('[<id=0>]', array(
				'module' => 'Front',
				'presenter' => 'Default',
				'action' => 'default',
				
				'id' => array(
					Route::FILTER_IN => function ($id)  {
						 $kuk = $this->db->table(\Dii::table('page_all'))
							->where('page_id', $id)
							->limit(1);
						 if ($kuk->count() == 0) return NULL;
						 $arr = $kuk->fetch()->toArray();
							\Dii::dump($arr);
						 return $arr['page_id'];
						}
					)
			)
		);	

		
		
		return $router;
	}

}
