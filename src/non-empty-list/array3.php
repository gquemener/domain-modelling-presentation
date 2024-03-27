<?php

// NOTE: Business Rule : a buyback MUST have at least one item

class Buyback
{
  /** @var array<Item> */
  private array $items;

  /** @param array<Item> $items */
  public function __construct(
    array $items, 
  ) {
    $this->setItems($items);
  }

  /** @param array<Item> $items */
  private function setItems(array $items): void {
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

$order = new Buyback([]); // NOTE: The business rule is guaranted (The model is the guardian of the invariants)
                          // HOWEVER the documentation of this rule is hidden inside the implementation of method

echo "Wonderful, your order is ready to be processed!";
