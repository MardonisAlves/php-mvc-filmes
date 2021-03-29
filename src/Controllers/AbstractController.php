<?php

namespace CatalogoFilmes\Controllers;
use CatalogoFilmes\Core\Request;
use CatalogoFilmes\Utils\DependencyInjector;


abstract class AbstractController
{
	protected $request;
	protected $db;
	protected $config;
	protected $view;
	protected $log;

	public function __construct(DependencyInjector $di ,Request $request) {
		
		$this->request = $request;
		$this->di=$di;

		$this->db = $di->get('PDO');
		$this->view = $di->get('Environment');
		$this->config = $di->get('Utils\Config');
		
		if (isset($_COOKIE['id'])) {
			 $this->customerId = $_COOKIE['id'];
		}
		
	}


	public function setCustomerId(int $customerId) {
		$this->customerId = $customerId;
	}

	protected function render(string $template, array $params): string {
		return $this->view->load($template)->render($params);
	}
}