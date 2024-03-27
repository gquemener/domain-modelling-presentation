<?php

// Business Rule : an order has at least one line

class Order
{
  /** @var array<OrderLine> */
  private array $lines = [];

  /** @param array<OrderLine> $lines */
  public function setLines(array $lines): void {
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
//
$order = new Order(); // PROBLEM: The business rule is still broken
$order->setLines([new OrderLine]); // BUT the model starts to prevent us from performing impossible mutation

echo "Wonderful, your order is ready to be processed!";
