<?php

namespace CatalogoFilmes\Controllers;

use CatalogoFilmes\Exceptions\NotFoundException;
use CatalogoFilmes\Model\AutorModel;
use CatalogoFilmes\Domain\Autor\Autor;
use CatalogoFilmes\Domain\Customer;


class AutorController extends AbstractController
{

  public function newautor()
  {

    return $this->view->render("newautor/newautor.twig");
  }

  public function salvar()
  {

    $params = $this->request->getParams();
    $nome = $params->getString('nome');
    $sobrenome = $params->getString('sobrenome');
    $datanascimento = $params->getString('datanascimento');


    $autor = new Autor('autor' ,0, $nome, $sobrenome, $datanascimento);
    $AutorModel = new AutorModel($this->db);
    $AutorModel->addAutor($autor);


    /* select o ultimo id da table Autor com um metodo *
    $query = $sql = "SELECT MAX(id) as id FROM tabela";


    // aqui vamos criar um novo filme
    /*
      id_autor
      nome

    */
    // chamar o metodo listar autor
    return $this->view->render("newautor/listautor.twig");
  }
}
