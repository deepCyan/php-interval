### 处理区间运算的包包

- 使用方法
  ```php
    // 构建区间
    $interval1 = new Interval();
    $interval1->setData(1, 8);
    // 设置开区间(默认创建闭区间)
    $interval1->setLeftOpen();
    $interval1->setRightOpen();
    // 获取集合数组
    $interval1->toArray();
  
    // 检查两个区间有没有交集
    $calculate = new IntervalCalculate();
    $checkIntersects = $calculate->checkIntersects($interval1, $interval2);
    // 获取两个区间的交集
    $getIntersects = $calculate->getIntersects($interval1, $interval2);
    // 获取两个区间的并集
    $union = $calculate->getUnion($interval1, $interval2);
    // 检查集合1是否包含集合2
    $calculate->checkContains($interval1, $interval2);
  ```