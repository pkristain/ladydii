<?php

namespace Model;


/**
 * Class SessionModel
 * @package Model
 */
class SessionModel extends \Nette\Object
{

	/**
	 * @var \Nette\Http\Session
	 */
	private $session;


	/**
	 * @param \Nette\Http\Session $session
	 */
	function __construct(\Nette\Http\Session $session)
	{
		$this->session = $session;
	}


} 