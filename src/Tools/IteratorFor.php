<?php
/**
 * @author selcukmart
 * 14.02.2022
 * 17:00
 */

namespace Selcukmart\NumberOfConnectedGroupsY42\Tools;



class IteratorFor implements \Iterator
{
    private int
        $current = 0;


    public function __construct(private readonly int $total_count)
    {
    }

    /**
     * @inheritDoc
     */
    public function current(): int
    {
        return $this->current;
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->current++;
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->current;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->key() < $this->total_count;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->current = 0;
    }
}