<?php

namespace Yunqing\Interval;

use Yunqing\Interval\Exception\IntervalException;

class Interval
{
    private int $start = 0;

    private int $end = 0;

    // 1 开 0 闭
    private int $left = 0;

    // 1 开 0 闭
    private int $right = 0;

    public function setData(int $start, int $end)
    {
        if ($end <= $start) {
            throw new IntervalException('End Cant More Than Start');
        }
        $this->start = $start;
        $this->end = $end;
    }

    public function setLeftOpen(): self
    {
        $this->left = 1;
        return $this;
    }

    public function setLeftClose(): self
    {
        $this->left = 0;
        return $this;
    }

    public function setRightOpen(): self
    {
        $this->right = 1;
        return $this;
    }

    public function setRightClose(): self
    {
        $this->right = 1;
        return $this;
    }

    public function checkLeftOpen(): bool
    {
        return $this->left == 1;
    }

    public function checkRightOpen(): bool
    {
        return $this->right == 1;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getEnd(): int
    {
        return $this->end;
    }

    public function getData(): array
    {
        if ($this->start == 0 && $this->end == 0) {
            return [];
        }
        $intervalData = range($this->start, $this->end);
        if ($this->checkLeftOpen()) {
            array_unshift($intervalData);
        }
        if ($this->checkRightOpen()) {
            array_pop($intervalData);
        }
        return $intervalData;
    }

    public function toArray(): array
    {
        return $this->getData();
    }
}