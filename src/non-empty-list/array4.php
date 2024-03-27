<?php

// NOTE: Business Rule : a buyback MUST have at least one item

/**
 * @template T
 * @implements IteratorAggregate<T>
 */
readonly class NonEmptyList implements IteratorAggregate { // NOTE: This is a value object (immutable data structure representing a value)
  /** @var array<T> */
  private array $tail;

  /**
   * @param T $head
   * @param array<T> $tail
   */
  public function __construct(
    private mixed $head,
    mixed ...$tail
  ) {
    $this->tail = $tail;
  }

  public function getIterator(): \Traversable
  {
    return new ArrayIterator([$this->head, ...$this->tail]);
  }
}

class Buyback
{
  /** @param NonEmptyList<Item> $lines */
  private function __construct(
    private NonEmptyList $lines, 
  ) {}

  /** 
   * @param NonEmptyList<Item> $lines 
   * NOTE: this is a concise, executable, written in ubiquitous language, documentation of the business rule:
   * "A buyback can be created for a non empty list of items"
   */
  public static function forItems(NonEmptyList $items): self 
  {
    return new self($items);
  }

  /** @var NonEmptyList<Item> */
  public function getLines(): NonEmptyList {
    return $this->lines;
  }
}

class Item {
  //...
}

// --------------------------------------

// NOTE: The business rule is guaranted (The model is the guardian of the invariants)
$order = Buyback::forItems(new NonEmptyList()); // NOTE: PHPStan will tell you that you cannot do that!

foreach ($order->getLines() as $key => $value) {
  printf('Line #%d : ...' . PHP_EOL, $key);
}

echo "Wonderful, your order is ready to be processed!";
