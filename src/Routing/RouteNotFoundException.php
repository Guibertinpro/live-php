<?php

namespace App\Routing;

use Exception;

class RouteNotFoundException extends Exception
{
  public function __construct()
  {
    $this->message  = "Impossible de trouver la route";
  }
}