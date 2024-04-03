<?php

// NOTE: Business Rule : a buyback MUST have at least one item

class Buyback
{
  /** @var array<Item> */
  private array $items = [];

  /** @param array<Item> $items */
  public function setItems(array $items): void {
    if (0 === count($items)) {
      throw new \InvalidArgumentException('A buyback needs at least one item!!');
    }
    $this->items = $items;
  }

  /** @return array<Item> */
  public function getItems(): array {
    return $this->items;
  }
}

class Item {
  //...
}

// --------------------------------------

$order = new Buyback(); // FIXME: The business rule is still broken
$order->setItems([]);   // NOTE: BUT the model starts to prevent us from performing impossible mutation

echo "Wonderful, your order is ready to be processed!";
