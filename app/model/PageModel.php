<?php


namespace Model;


/**
 * Class PageTableModel
 * @package Model
 */
class PageModel extends BaseTableModel
{


	/**
	 * @param \DibiConnection $connection
	 */
	function __construct(\DibiConnection $connection)
	{
		parent::__construct($connection, 'page', 'page_id');
	}


	/**
	 * @return \DibiFluent
	 */
	public function findAll()
	{
		return parent::findAll()->orderBy(
			'a.page_order ASC ,',
			'a.page_created DESC ,',
			'a.page_id ASC'
		);
	}


	/**
	 * Orders pages
	 */
	public function orderPages()
	{
		$this->db->update('page',[
			'page_order' => null,
			'page_level' => null,
			'page_general_visibility' => null,
		]);
		$this->orderDescendants();
	}


	/**
	 * @param int|null $page_id
	 * @param int $order
	 * @param int $level
	 *
	 */
	private function orderDescendants($page_id = null, &$order = 0, $general_visibility = true, $level = 0)
	{
		if (is_null($page_id))
		{
			$descendants = $this->findOrphans($page_id);
		}
		else
		{
			$order++;

			$this->db->update('page',[
				'page_order' => $order,
				'page_level' => $level,
				'page_general_visibility' => $general_visibility,

			])
				->where(['page_id' => $page_id])
				->execute()
			;
			$level++;
			$descendants = $this->findDirectDescendants($page_id);
		}

		$descendants = $descendants->fetchAll();

		foreach ($descendants as $item)
		{
			if(!$general_visibility or !$item->page_visibility)
			{
				$setVisibility = false;
			}
			else
			{
				$setVisibility = true;
			}
			$this->orderDescendants($item->page_id, $order, $setVisibility, $level);
		}
	}


	/**
	 * @param int $id
	 *
	 * @return \DibiFluent
	 */
	function findDirectDescendants($id)
	{
		return $this->findAll()
			->where('a.page_parent = %i', $id);
	}


	/**
	 * @return \DibiFluent
	 */
	public function findOrphans()
	{
		return $this->findAll()
			->where('a.page_parent IS NULL');
	}






} 