<?php

// Business Rule : an order has at least one line

class Order
{
  /** @var array<OrderLine> */
  private array $lines;

  /** @param array<OrderLine> $lines */
  public function __construct(
    array $lines, 
  ) {
    $this->setLines($lines);
  }

  /** @param array<OrderLine> $lines */
  private function setLines(array $lines): void {
    if (0 === count($lines)) {
      throw new \InvalidArgumentException('An order needs at least one line!!');
    }
    $this->lines = $lines;
  }

  /** @var array<OrderLine> */
  public function getLines(): array {
    return $this->lines;
  }
}

class OrderLine {
  //...
}

// --------------------------------------

$order = new Order([]); // The business rule is guaranted (The model is the guardian of the invariants)

echo "Wonderful, your order is ready to be processed!";
