<?php
namespace CatalogoFilmes\Controllers;
use CatalogoFilmes\Model\AutorModel;

class FilmeController extends AbstractController{

    public function newfilme(): string{
       
        $autormodel = new AutorModel($this->db);
        $autores = $autormodel->getAutores();

        $propreties = [
            'autores' => $autores
        ];
      


       return $this->view->render("newfilme/new.twig" , $propreties);

     }
}