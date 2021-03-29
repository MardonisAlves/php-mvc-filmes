<?php

namespace CatalogoFilmes\Core;
use CatalogoFilmes\Core\FilteredMap;

class Request 
{
	const GET = 'GET';
	const POST = 'POST';

	private $domain;
	private $path;
	private $method;

	private $params;
	private $cookies ;
	
	function __construct()
	{
		$this->domain=$_SERVER['HTTP_HOST'];
		$this->path= explode('?',  $_SERVER['REQUEST_URI'])[0];
		$this->method = $_SERVER['REQUEST_METHOD'];

		$this->params = new FilteredMap(array_merge($_POST , $_GET));
		$this->cookies = new FilteredMap($_COOKIE);
	}

	// get url
	public function getUrl() : string {
		return $this->domain . $this->path;
	}
	// get domain
	public function getDomain(): string {
		return $this->domain;
	}
	// get path
	public function getPath() : string {
		return $this->path;
	}
	// get Method
	public function getMethod() : string {
		return $this->method;
	}
	// verificar se o methodo é  post
	public function isPost() : bool {
		return $this->method === self::POST;
	}
	// verificar se o method é GET
	public function isGET() : bool {
		return $this->method === self::GET;
	}

	// Filters get Params

	public function getParams(): FilteredMap {
		return $this->params;
	}
	public function getCookies(): FilteredMap {
		return $this->cookies;
	}
}