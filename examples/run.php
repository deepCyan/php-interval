<?php
require '../vendor/autoload.php';

use Yunqing\Interval\Interval;
use Yunqing\Interval\IntervalCalculate;

$interval1 = new Interval();
$interval1->setData(1, 8);
$interval2 = new Interval();
$interval2->setData(2, 9);

$calculate = new IntervalCalculate();
$checkIntersects = $calculate->checkIntersects($interval1, $interval2);
assert($checkIntersects, true);

$checkIntersects = $calculate->checkIntersects($interval2, $interval1);
assert($checkIntersects, true);

$getIntersects = $calculate->getIntersects($interval1, $interval2);
$getIntersects = $calculate->getIntersects($interval2, $interval1);
// var_dump($getIntersects->toArray());

$union = $calculate->getUnion($interval1, $interval2);
var_dump($union->toArray());

$interval1 = new Interval();
$interval1->setData(1, 8);
$interval2 = new Interval();
$interval2->setData(10, 20);
$checkIntersects = $calculate->checkIntersects($interval1, $interval2);
assert($checkIntersects === false);