<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\IndexController;
use App\Controller\UserController;
use App\Repository\UserRepository;
use App\Routing\RouteNotFoundException;
use App\Routing\Router;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// --- ENV VARS
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/../.env');
// --- ENV VARS

// --- DOCTRINE
$paths = ['src/Entity'];
$isDevMode = $_ENV['APP_ENV'] === 'dev';

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
// --- DOCTRINE

// --- TWIG
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader, [
  'debug' => $_ENV['APP_ENV'] === 'dev',
  'cache' => __DIR__ . '/../var/cache/twig'
]);
// --- TWIG

// --- REPOSITORIES
$userRepository = new UserRepository($entityManager);
// --- REPOSITORIES

if (php_sapi_name() === 'cli') {
  return;
}

$router = new Router($entityManager, $twig, $userRepository);

// Enregistrer mes routes avec les controllers associés et leur méthode
$router->addRoute(
  'user_create',
  '/user/create',
  'GET',
  UserController::class,
  'create'
);
$router->addRoute(
  'homepage',
  '/',
  'GET',
  IndexController::class,
  'home'
);
$router->addRoute(
  'user_create',
  '/contact',
  'GET',
  IndexController::class,
  'contact'
);
$router->addRoute(
  'users_list',
  '/users/list',
  'GET',
  UserController::class,
  'list'
);

// Transmettre au router la request URI pour déterminer la route à exécuter
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

try{
  $router->execute($requestUri, $requestMethod);
} catch(RouteNotFoundException $e) {
  http_response_code(404);
  echo "<p>Page non trouvée</p>";
  echo "<p>" . $e->getMessage() . "</p>";
}