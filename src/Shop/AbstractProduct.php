<?php

namespace App\Shop;

use App\IDisplayable;

abstract class AbstractProduct implements IDisplayable {

  protected int $id;
  protected string $name;
  protected float $price;
  protected string $description;

  public function __construct(string $name, float $price, string $description = 'lorem ipsum')
  {
    $this->name = $name;
    $this->price = $price;
    $this->description = $description;
  }

  abstract public function getSurface(): float;

  public function display(): void
  {
    echo $this->getName() . " - " . $this->getSurface() . "<br />";
  }

  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name; 
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of price
   */ 
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * Set the value of price
   *
   * @return  self
   */ 
  public function setPrice($price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }
}