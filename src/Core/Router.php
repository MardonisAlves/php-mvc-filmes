<?php

namespace CatalogoFilmes\Core;

use CatalogoFilmes\Controllers\ErrorController;
use CatalogoFilmes\Controllers\HomeController;
use CatalogoFilmes\Utils\DependencyInjector;

class Router
{

	private $routeMap;
	private static $regexPatters = [
		'number' => '\d+',
		'string' => '\w'
	];

	public function __construct(DependencyInjector $di)
	{
		$this->di = $di;

		$json = file_get_contents(__DIR__ . './../config/routes.json');
		$this->routeMap = json_decode($json, true);
	}



	public function router(Request $request): string
	{

		foreach ($this->routeMap as $route => $info) {
			$regexRoute = $this->getRegexRoute($route, $info);
			$path = $request->getPath();
			if (preg_match("@^/$regexRoute$@", $path)) {

				return $this->executeController($route, $path, $info, $request);
			}
		}

		$errorController = new ErrorController($this->di, $request);
		return $errorController->notFound();
	}





	private function getRegexRoute(string $route, array $info): string
	{

		if (isset($info['params'])) {
			foreach ($info['params'] as $name => $type) {
				$route = str_replace(':' . $name, self::$regexPatters[$type], $route);
			}
		}

		return $route;
	}



	private function extractParams(string $route, string $path): array
	{

		$params = [];
		$pathParts = explode('/', $path);
		$routeParts = explode('/', $route);
		
		foreach ($routeParts as $key => $routePart) {

			if (strpos($routePart, ':') === 0) {
				$name = substr($routePart, 1);
				$params[$name] = $pathParts[$key + 1];
			}
		}
		return $params;
	}


	private function executeController(string $route, string $path, array $info, Request $request): string
	{
		$controllerName = '\CatalogoFilmes\Controllers\\' . $info['controller'] . 'Controller';

		$controller = new $controllerName($this->di, $request);

		if (isset($info['login']) && $info['login']) {

			if ($request->getCookies()->has('user')) {
				$customerId = $request->getCookies()->get('user');
				$controller->setCustomerId($customerId);
			} else {
				$errorController = new CustomerController($this->di, $request);


				return $errorController->login();
			}
		}
		$params = $this->extractParams($route, $path);

		return call_user_func_array([$controller, $info['method']], $params);
	}
}
