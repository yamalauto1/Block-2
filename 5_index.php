<p>Сделайте функцию isNumberInRange, которая параметром принимает число и проверяет, что оно больше нуля и меньше 10. Если это так - пусть функция возвращает true, если не так - false.</p>
<?php
function isNumberInRange($num)
{
    if ($num > 0 and $num < 10) {
        return 'true';
    } else {
        return 'false';
    }
}
echo isNumberInRange(-1);
?>
<p>Дан массив с числами. Запишите в новый массив только те числа, которые больше нуля и меньше 10-ти. Для этого используйте вспомогательную функцию isNumberInRange из предыдущей задачи.</p>
<?php
$arr = [3, 7, 12, -2, 66, 0, -4, 9];
$arrNew = [];
function isNumberInRangeNew($num) {
    if ($num > 0 and $num<10) {
        return true;
    } else {
        return false;
    }
}
for ($i = 0;$i < count($arr);$i++) {
    if (isNumberInRangeNew($arr[$i])) {
        $arrNew[ ] = $arr[$i];
    }
}
var_dump($arrNew);
?>
<p>Сделайте функцию getDigitsSum (digit - это цифра), которая параметром принимает целое число и возвращает сумму его цифр.</p>
<?php
function getDigitsSum ($num)
{
    return array_sum (str_split($num, 1));
}
echo getDigitsSum(3456);
?>
<p>Найдите все года от 1 до 2019, сумма цифр которых равна 13. Для этого используйте вспомогательную функцию getDigitsSum из предыдущей задачи.</p>
<?php
function getDigitsSumNew ($num)
{
    return array_sum (str_split($num, 1));
}

for ($i = 1;$i < 2019;$i++) {
    if (getDigitsSumNew ($i) == 13) {
        echo $i.' , ';
    }
}
?>
<p>Сделайте функцию isEven() (even - это четный), которая параметром принимает целое число и проверяет: четное оно или нет. Если четное - пусть функция возвращает true, если нечетное - false.</p>
<?php
function isEven($num)
{
    return $num%2 == 0;
}
echo isEven(20);
?>
<p>Дан массив с целыми числами. Создайте из него новый массив, где останутся лежать только четные из этих чисел. Для этого используйте вспомогательную функцию isEven из предыдущей задачи.</p>
<?php
function isEvenNew($num)
{
    return $num % 2 == 0;
}
$arr = [4, 1, 8, -5, 21, -2, 7, 6];
$arrNew = [];
for ($i = 0; $i < count($arr); $i++)
    if ($arr[$i] == isEvenNew($arr[$i])) {
        $arrNew[] = $arr[$i];
    }
var_dump($arrNew);
?>
<p>Сделайте функцию getDivisors, которая параметром принимает число и возвращает массив его делителей (чисел, на которое делится данное число).</p>
<?php
function getDivisors($num)
{
    $arr = [];
    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $arr [] = $i;
        }
    }
    return $arr;
}
var_dump(getDivisors(21));
?>
<p>Сделайте функцию getCommonDivisors, которая параметром принимает 2 числа, а возвращает массив их общих делителей. Для этого используйте вспомогательную функцию getDivisors из предыдущей задачи.</p>
<?php
function getDivisorsNew($num)
{
    $arr = [];
    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $arr [] = $i;
        }
    }
    return $arr;
}

function getCommonDivisors($num1, $num2)
{
    return array_intersect(getDivisorsNew($num1), getDivisorsNew($num2));
}

var_dump(getCommonDivisors(14, 8));
?>