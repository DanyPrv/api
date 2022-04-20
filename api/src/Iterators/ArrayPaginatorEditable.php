<?php

declare(strict_types=1);

namespace App\Iterators;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use ArrayIterator;
use EmptyIterator;
use IteratorAggregate;
use LimitIterator;
use Traversable;

final class ArrayPaginatorEditable implements IteratorAggregate, PaginatorInterface
{
    private LimitIterator | EmptyIterator $iterator;

    private int $totalItems;

    public function __construct(
        array $results,
        private int $firstResult,
        private int $maxResults,
        ?int $totalItems = null
    ) {
        if ($maxResults > 0) {
            $this->iterator = new LimitIterator(new ArrayIterator($results), $firstResult, $maxResults);
        } else {
            $this->iterator = new EmptyIterator();
        }
        $this->totalItems = $totalItems ?? count($results);
    }

    public function getCurrentPage(): float
    {
        if (0 >= $this->maxResults) {
            return 1.;
        }

        return floor($this->firstResult / $this->maxResults) + 1.;
    }

    public function getLastPage(): float
    {
        if (0 >= $this->maxResults) {
            return 1.;
        }

        return ceil($this->totalItems / $this->maxResults);
    }

    public function getItemsPerPage(): float
    {
        return (float) $this->maxResults;
    }

    public function getTotalItems(): float
    {
        return (float) $this->totalItems;
    }

    public function setTotalItems(int $totalItems): self
    {
        $this->totalItems = $totalItems;

        return $this;
    }

    public function count(): int
    {
        return iterator_count($this->iterator);
    }

    public function getIterator(): Traversable
    {
        return $this->iterator;
    }
}
