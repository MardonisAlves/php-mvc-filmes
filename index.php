<?php
// exibir todos os errors
ini_set('display_errors', 1);
ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
use CatalogoFilmes\Core\Router;
use CatalogoFilmes\Core\Request;
use CatalogoFilmes\Core\Config;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use CatalogoFilmes\Utils\DependencyInjector;


require_once __DIR__.'/vendor/autoload.php';

$config = new Config();
$dbConfig = $config->get('db');
$db = new PDO(
	'mysql:host=localhost;dbname=Filmes',
	$dbConfig['user'],
	$dbConfig['password']);


$loader = new FilesystemLoader('./src/views');
$view = new Environment($loader);



$di = new DependencyInjector();
$di->set('PDO', $db);
$di->set('Utils\Config', $config);
$di->set('Environment', $view);



$router = new Router($di);
$response = $router->router(new Request());
echo $response;





















