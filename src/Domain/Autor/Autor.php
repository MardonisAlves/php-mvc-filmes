<?php
namespace CatalogoFilmes\Domain\Autor;

use CatalogoFilmes\Domain\Customer;
use CatalogoFilmes\Domain\Person;


class Autor extends Person implements Customer
{
	public function getType() : string {
		return 'Autor';
	}
}