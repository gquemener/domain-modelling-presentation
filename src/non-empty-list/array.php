<?php

// Business Rule : a buyback MUST have at least one product

class Buyback
{
  /** @var array<Product> */
  private array $products = [];

  /** @param array<Product> $products */
  public function setLines(array $products): void {
    $this->products = $products;
  }

  /** @return array<Product> */
  public function getLines(): array {
    return $this->products;
  }
}

class Product {
  //...
}

// --------------------------------------

$buyback = new Buyback(); 

// PROBLEM: Even though the business rule is broken, we were able to instanciate a buyback

$buyback->setLines([new Product]);

// PROBLEM: Even though the business rule is broken, we were able to mutate a buyback

if (0 === count($buyback->getLines())) { // This is called defensive programming, and is a dangerous pattern (as it can easily be forgotten, or be unnecessarily performed)
  throw new \RuntimeException('A buyback needs at least one line!!');
}

echo "📦 Wonderful, your buyback is ready to be processed!";
