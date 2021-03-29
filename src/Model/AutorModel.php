<?php

namespace CatalogoFilmes\Model;

use CatalogoFilmes\Domain\Autor\Autor;
use CatalogoFilmes\Exceptions\DbException;
use PDO;

class AutorModel extends AbstractModel
{

	//const CLASSNAME ='\CatalogoFilmes\Domain\Autor\Autor';

	public function __construct($db)
	{
		$this->db = $db;
		parent::__construct($db);
	}

	public function addAutor(Autor $autor)
	{
		$query = <<<SQL
		INSERT INTO Customer (id,nome, sobrenome, datanascimento , type)
		VALUES(:id ,:nome, :sobrenome, :datanascimento, :type)
		SQL;
		$sth = $this->db->prepare($query);
		$sth->bindValue('nome', $autor->getNome());
		$sth->bindValue('sobrenome', $autor->getSobrenome());
		$sth->bindValue('datanascimento', $autor->getDtNascimento());
		$sth->bindValue('type' , $autor->getType());
		$sth->bindValue('id', $autor->getId());
		$sth->execute();

		if (!$sth->execute()) {
			throw new DbException($sth->errorInfo()[2]);
			}
		
	}

	public function getAutores(){
		$query = 'SELECT * FROM Customer';
		$sth = $this->db->prepare($query);
		$sth->execute();
		
		return $autores = $sth->fetchAll();
		
		
	}
}
