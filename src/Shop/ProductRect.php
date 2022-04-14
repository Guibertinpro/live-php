<?php

namespace App\Shop;

class ProductRect extends AbstractProduct {
  private int $width;
  private int $height;

  public function __construct(
    string $name,
    float $price,
    int $width,
    int $height,
    ?string $description = null
  ) {
    if ($description === null) {
      parent::__construct($name, $price);
    } else {
      parent::__construct($name, $price, $description);
    }

    $this->width = $width;
    $this->height = $height;
  }

  public function getSurface(): float
  {
    return $this->width * $this->height;
  }

  /**
   * Get the value of width
   */ 
  public function getWidth()
  {
    return $this->width;
  }

  /**
   * Set the value of width
   *
   * @return  self
   */ 
  public function setWidth($width)
  {
    $this->width = $width;

    return $this;
  }

  /**
   * Get the value of height
   */ 
  public function getHeight()
  {
    return $this->height;
  }

  /**
   * Set the value of height
   *
   * @return  self
   */ 
  public function setHeight($height)
  {
    $this->height = $height;

    return $this;
  }
}

