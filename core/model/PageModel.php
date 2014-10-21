<?php


namespace Model;


/**
 * Class PageTableModel
 * @package Model
 */
class PageTableModel extends BaseTableModel
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
		]);
		$this->orderDescendants();
	}


	/**
	 * @param int|null $page_id
	 * @param int $order
	 * @param int $level
	 *
	 */
	private function orderDescendants($page_id = null, &$order = 0, $level = 0)
	{
		if (is_null($page_id))
		{
			$descendants = $this->findOrphans($page_id);
		}
		else
		{
			$order++;
			$level++;
			$this->db->update('page',[
				'page_order' => $order,
				'page_level' => $level,
			])
				->where(['page_id' => $page_id])
				->execute()
			;

			$descendants = $this->findDescendants($page_id);

		}

		$descendants = $descendants->fetchPairs(null, 'page_id');


		foreach ($descendants as $item)
		{
			$this->orderDescendants($item, $order, $level);
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