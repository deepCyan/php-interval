<?php

namespace Yunqing\Interval;

use Yunqing\Interval\Exception\IntervalException;

class IntervalCalculate
{
    /**
     * 检查 1 是否包含 2
     * @param Interval $interval1
     * @param Interval $interval2
     * @return bool
     */
    public function checkContains(Interval $interval1, Interval $interval2): bool
    {
        return $interval1->getStart() <= $interval2->getStart()
            && $interval1->getEnd() >= $interval2->getEnd();
    }

    /**
     * 检查两个区间是否存在交集
     * @param Interval $interval1
     * @param Interval $interval2
     * @return bool
     */
    public function checkIntersects(Interval $interval1, Interval $interval2): bool
    {
        // ex:
        // [5, 8] [2, 7] --> 5, 7
        // [2, 7] [5, 8]
        $check1 = $interval1->getStart() < $interval2->getEnd() && $interval1->getEnd() > $interval2->getStart();
        $check2 = $interval2->getStart() < $interval1->getEnd() && $interval2->getEnd() > $interval1->getStart();

        return $check1 || $check2;
    }

    /**
     * 获取两个区间的交集
     * @param Interval $interval1
     * @param Interval $interval2
     * @return Interval
     * @throws IntervalException
     */
    public function getIntersects(Interval $interval1, Interval $interval2): Interval
    {
        if (! $this->checkIntersects($interval1, $interval2)) {
            throw new IntervalException('Not Has Intersects');
        }
        // [2, 9] [1, 8]
        // [1, 8] [2, 9]
        $interval = new Interval();
        $start = max($interval1->getStart(), $interval2->getStart());
        $end = min($interval1->getEnd(), $interval2->getEnd());
        $interval->setData($start, $end);
        // start / right 是哪个？
        if ($interval1->getStart() == $start && $interval1->checkLeftOpen()) {
            $interval->setLeftOpen();
        }
        if ($interval2->getStart() == $start && $interval2->checkLeftOpen()) {
            $interval->setLeftOpen();
        }
        if ($interval1->getEnd() == $end && $interval1->checkRightOpen()) {
            $interval->setRightOpen();
        }
        if ($interval2->getEnd() == $end && $interval2->checkRightOpen()) {
            $interval2->setRightOpen();
        }
        return $interval;
    }

    /**
     * 获取两个区间的并集
     * @param Interval $interval1
     * @param Interval $interval2
     * @return Interval
     */
    public function getUnion(Interval $interval1, Interval $interval2): Interval
    {
        $interval = new Interval();
        $start = $interval1->getStart();
        $chooseLeft = 1;
        $chooseRight = 1;
        if ($interval1->getStart() > $interval2->getStart()) {
            $start = $interval2->getStart();
            $chooseLeft = 2;
        }
        $end = $interval1->getEnd();
        if ($interval1->getEnd() < $interval2->getEnd()) {
            $end = $interval2->getEnd();
            $chooseRight = 2;
        }
        $interval->setData($start, $end);
        if ($chooseLeft == 1 && $interval1->checkLeftOpen()) {
            $interval->setLeftOpen();
        }
        if ($chooseLeft == 2 && $interval2->checkLeftOpen()) {
            $interval->setLeftOpen();
        }
        if ($chooseRight == 1 && $interval1->checkRightOpen()) {
            $interval->setRightOpen();
        }
        if ($chooseRight == 2 && $interval2->checkRightOpen()) {
            $interval->setRightOpen();
        }
        return $interval;
    }
}