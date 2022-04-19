<?php

namespace App\Routing;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use ReflectionMethod;
use Twig\Environment;

class Router
{

  private array $routes = [];
  private array $services = [];

  public function __construct(
    EntityManager $entityManager,
    Environment $twig,
    UserRepository $userRepository
    )
  {
    $this->services[EntityManager::class] = $entityManager;
    $this->services[Environment::class] = $twig;
    $this->services[UserRepository::class] = $userRepository;
  }

  /**
   * Add a route into a router internal array
   *
   * @param string $name
   * @param string $url
   * @param string $httpMethod
   * @param string $controller Controller's class FQCM
   * @param string $method
   * @return void
   */
  public function addRoute(string $name, string $url, string $httpMethod, string $controller, string $method)
  {
    $this->routes[] = [
      'name' => $name,
      'url' => $url,
      'http_method' => $httpMethod,
      'controller' => $controller,
      'method' => $method
    ];
  }

  public function getRoute(string $uri, string $httpMethod): ?array
  {
    foreach($this->routes as $route) {
      if($route['url'] === $uri && $route['http_method'] === $httpMethod) {
        return $route;
      }
    }

    return null;
  }

  /**
   * Execute router on specified URI and HTTP METHOD
   *
   * @param string $requestUri
   * @param string $requestMethod
   * @return void
   * @throws RouteNotFoundException // If route is not found
   */
  public function execute(string $requestUri, string $requestMethod)
  {
    $route = $this->getRoute($requestUri, $requestMethod);

    if ($route === null) {
      throw new RouteNotFoundException();
    }

    $controller = $route['controller'];
    $method = $route['method'];
    $params = $this->getMethodParams($controller, $method);
    
    $controllerInstance = new $controller();
    call_user_func_array(
      [$controllerInstance, $method],
      $params
    );
  }
  
  /**
   * Resolve and bluid method parameters
   *
   * @param string $controller Controller's FQCM
   * @param string $method
   * @return array Empty if controller doesn't have any paramaters
   */
  private function getMethodParams(string $controller, string $method): array
  {
    $methodInfos = new ReflectionMethod($controller . '::' . $method);
    $methodParameters = $methodInfos->getParameters();
    $params = [];
  
    foreach($methodParameters as $param) {
      $paramName = $param->getName();
      $paramType = $param->getType()->getName();
  
      if(array_key_exists($paramType, $this->services)) {
        $params[$paramName] = $this->services[$paramType];
      }
    }
    
    return $params;
  }
}