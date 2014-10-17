<?php
/**
 * Created by PhpStorm.
 * User: bricamry
 * Date: 18.10.14
 * Time: 0:00
 */

namespace Model;


class PageModel extends BaseModel
{
	public function showPages($id)
	{
		return $this->db->select('a.*')
		->from('page a,page b')
		->where('b.page_id = a.page_parent')
		->and('a.page_id = %i', $id)
		->fetchPairs('page_id', 'page_parent');
	}
} 