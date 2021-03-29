<?php
namespace CatalogoFilmes\Utils;


trait Unique {
	
	protected $id;

	public function setId(int $id) 
	{
		$this->id = $id;
	}

	public function getId(): int {
		return $this->id;
	}

}