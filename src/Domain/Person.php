<?php

namespace CatalogoFilmes\Domain;

use CatalogoFilmes\Utils\Unique;
use DateTime;

class Person
{
	use Unique;

	protected $type;
	protected $nome;
	protected $sobrenome;
	protected $datanascimento;

	public function __construct(string $type ,int $id, string $nome, string $sobrenome , string  $datanascimento)
	{

		$this->nome = $nome;
		$this->sobrenome = $sobrenome;
		$this->datanascimento=$datanascimento;
		$this->type=$type;
		$this->setId($id);
	}


	public function getNome(): string
	{
		return $this->nome;
	}
	public function getSobrenome(): string
	{
		return $this->sobrenome;
	}
	public function getDtNascimento(): string
	{
		return $this->datanascimento;
	}

	public function getType(): string
	{
		return $this->type;
	}
}
