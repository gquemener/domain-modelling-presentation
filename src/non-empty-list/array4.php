<?php

// Business Rule : an order has at least one line

/**
 * @template T
 */
readonly class NonEmptyList implements IteratorAggregate { // This is a value object (immutable data structure representing a value)
  /** @var array<T> */
  private readonly array $tail;

  /**
   * @param T $head
   * @param array<T> $tail
   */
  public function __construct(
    public mixed $head,
    mixed ...$tail
  ) {
    $this->tail = $tail;
  }

  public function getIterator(): \Traversable
  {
    return new ArrayIterator([$this->head, ...$this->tail]);
  }
}

class Order
{
  /** @param NonEmptyList<OrderLine> $lines */
  private function __construct(
    private NonEmptyList $lines, // this is a concise, executable, documentation of the business rule
  ) {}

  /** @param NonEmptyList<OrderLine> $lines */
  public static function fromLines(NonEmptyList $lines): self
  {
    return new self($lines);
  }

  /** @var NonEmptyList<OrderLine> */
  public function getLines(): NonEmptyList {
    return $this->lines;
  }
}

class OrderLine {
  //...
}

// --------------------------------------

// The business rule is guaranted (The model is the guardian of the invariants)
$order = Order::fromLines(new NonEmptyList()); // PHPStan will tell you that you cannot do that!
// Side note : Compiled languages will even tell you at compilation time => shorter feedback loop!

foreach ($order->getLines() as $key => $value) {
  printf('Line #%d : ...' . PHP_EOL, $key);
}

echo "Wonderful, your order is ready to be processed!";
