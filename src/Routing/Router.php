<?php

namespace App\Routing;

class Router
{

  private array $routes = [];

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

    $controllerInstance = new $controller();
    $controllerInstance->$method();
  }
}