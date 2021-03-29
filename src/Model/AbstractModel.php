<?php

namespace CatalogoFilmes\Model;

use PDO;

abstract class AbstractModel{
	
	private $db;

	public function __construct(PDO $db){
		$this->db =$db;
	}
}
