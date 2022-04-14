<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Shop\AbstractProduct;
use App\Shop\ProductCircle;
use App\Shop\ProductRect;

$productRect = new ProductRect("Plaque inox brossé", 24.4, 100, 150);

var_dump($productRect);

$productCircle = new ProductCircle("Plaque inox brossé ronde", 25.4, 200);

var_dump($productCircle);

var_dump($productRect->getSurface());
var_dump($productCircle->getSurface());


/**
 * Undocumented function
 *
 * @param AbstractProduct[] $product
 * @return void
 */
function listProducts (array $products)
{
  foreach ($products as $product) {
    $product->display();
  }
}

function displayProduct (AbstractProduct $product)
{
  echo $product->getName() . " - " . $product->getSurface() . "<br />";
}

listProducts([$productRect, $productCircle]);