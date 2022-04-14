<?php

namespace App\Shop;

class ProductCircle extends AbstractProduct {
  private int $diameter;

  public function __construct(
    string $name,
    float $price,
    int $diameter,
    ?string $description = null
  ) {
    if ($description === null) {
      parent::__construct($name, $price);
    } else {
      parent::__construct($name, $price, $description);
    }

    $this->diameter = $diameter;
  }

  public function getSurface(): float
  {
    return M_PI * (($this->diameter/2) ** 2);
  }
  
  /**
   * Get the value of diameter
   */ 
  public function getDiameter(): int
  {
    return $this->diameter;
  }

  /**
   * Set the value of diameter
   *
   * @return  self
   */ 
  public function setDiameter(int $diameter): self
  {
    $this->diameter = $diameter;

    return $this;
  }
}

