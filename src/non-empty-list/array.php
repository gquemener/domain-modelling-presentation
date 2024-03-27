<?php

// NOTE: Business Rule : a buyback MUST have at least one item

class Buyback
{
  /** @var array<Item> */
  private array $items = [];

  /** @param array<Item> $items */
  public function setItems(array $items): void {
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

$buyback = new Buyback(); 

// FIXME: Even though the business rule is broken, we were able to instanciate a buyback

$buyback->setItems([new Item]);

// FIXME: Even though the business rule is broken, we were able to mutate a buyback

$buyback->setItems([]);

// FIXME: we were able to break the business rule ONCE AGAIN!!

if (0 === count($buyback->getItems())) { 
  // NOTE: This is called defensive programming, and is a dangerous pattern
  // as it can easily be forgotten, or be unnecessarily performed.
  throw new \RuntimeException('A buyback needs at least one item!!');
}

echo "📦 Wonderful, your buyback is ready to be processed!";
