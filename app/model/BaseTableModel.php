<?php

namespace Model;


/**
 * Class BaseTableModel
 * @package Model
 */
abstract class BaseTableModel extends \Nette\Object
{

	/**
	 * @var \DibiConnection Databse Connection
	 */
	protected $db;

	/**
	 * @var string
	 */
	protected $prefix;

	/**
	 * @var string
	 */
	public $table;

	/**
	 * @var string
	 */
	public $primaryKey;


	/**
	 * @param \DibiConnection $connection
	 * @param string $table
	 * @param string $primaryKey
	 */
	function __construct(\DibiConnection $connection, $table, $primaryKey)
	{
		$this->db = $connection;
		$this->prefix = $this->db->config['prefix'];
		$this->table = $table;
		$this->primaryKey = $primaryKey;
	}


	/**
	 * @return \DibiFluent
	 */
	public function findAll()
	{
		return $this->db->select('a.*')
		->from($this->getTable(),'a')
		;
	}


	/**
	 * @param array $ids
	 * @param array $data
	 *
	 * @return \DibiResult|int
	 */
	public function update(array $ids, array $data)
	{
		return $this->db->update($this->getTable(), $data)
			->where($this->getPrimaryKey(),'IN %in', $ids)
			->execute()
		;
	}


	/**
	 * @param array $data
	 *
	 * @return \DibiResult|int
	 */
	public function updateAll(array $data)
	{
		return $this->db->update($this->getTable(), $data)
			->execute()
		;
	}


	/**
	 * @param array $data
	 *
	 * @return \DibiResult|int
	 */
	public function insert(array $data)
	{
		return $this->db->insert($this->getTable(), $data)->execute();
	}


	/**
	 * @param array $ids
	 *
	 * @return bool|\DibiResult|int
	 */
	public function delete(array $ids)
	{
		return $this->db->delete($this->getTable())
			->where($this->getPrimaryKey(),'IN %in', $ids)
			->execute()
		;
	}


	/**
	 * @return int
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}


	/**
	 * @param bool|string $table
	 *
	 * @return string
	 * @throws \Exception
	 */
	protected function getTable($table = false)
	{
		if (!$table)
		{
			if (!$this->table)
			{
				throw new \Exception('Default table is not set.');
			}
			$table = $this->table;
		}

		return $this->prefix . $table;
	}


	/**
	 * @return string
	 */
	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}
}