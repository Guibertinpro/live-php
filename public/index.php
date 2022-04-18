<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\IndexController;
use App\Controller\UserController;
use App\Routing\RouteNotFoundException;
use App\Routing\Router;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/../.env');

$paths = ['src/Entity'];
$isDevMode = true;

$dbParams = [
  'driver'   => $_ENV['DB_DRIVER'],
  'host'     => $_ENV['DB_HOST'],
  'port'     => $_ENV['DB_PORT'],
  'user'     => $_ENV['DB_USER'],
  'password' => $_ENV['DB_PASSWORD'],
  'dbname'   => $_ENV['DB_NAME'],
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);

if (php_sapi_name() === 'cli') {
  return;
}

$router = new Router();

// Enregistrer mes routes avec les controllers associés
$router->addRoute(
  'user_create',
  '/live-php/public/user/create',
  'GET',
  UserController::class,
  'create'
);
$router->addRoute(
  'homepage',
  '/live-php/public/',
  'GET',
  IndexController::class,
  'home'
);
$router->addRoute(
  'user_create',
  '/live-php/public/contact',
  'GET',
  IndexController::class,
  'contact'
);

// Transmettre au router la request URI pour détermine la route à exécuter
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

try{
  $router->execute($requestUri, $requestMethod);
} catch(RouteNotFoundException $e) {
  http_response_code(404);
  echo "<p>Page non trouvée</p>";
  echo "<p>" . $e->getMessage() . "</p>";
}