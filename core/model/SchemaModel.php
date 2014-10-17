<?php
/**
 * Created by PhpStorm.
 * User: bricamry
 * Date: 17.10.14
 * Time: 22:36
 */

namespace Model;


class SchemaModel extends BaseModel
{
		public function getTables()
		{
			return $this->db->query('show tables')->fetchPairs();
		}
} 