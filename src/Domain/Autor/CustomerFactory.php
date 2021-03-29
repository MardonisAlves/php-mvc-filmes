<?php 

namespace CatalogoFilmes\Domain\Autor;
/*
* Customer e uma interface
**/
use CatalogoFilmes\Domain\Customer;



class CustomerFactory{
	
	public static function factory(
		string $type, 
		int $id , 
		string  $nome , 
		string $sobrenome, 
		string $datanascimento): Customer {

		$classname = __NAMESPACE__ . '\\' . ucfirst($type);
		if (!class_exists($classname)) {
		throw new \InvalidArgumentException('Wrong type.');
		}
		return new $classname($type,$id, $nome, $sobrenome ,$datanascimento);

	}
	
}