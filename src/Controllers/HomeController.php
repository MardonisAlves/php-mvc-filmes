<?php
namespace CatalogoFilmes\Controllers;

class HomeController extends AbstractController{

    public function index(){
       
        return $this->view->render("home/Home.twig");
    }
}