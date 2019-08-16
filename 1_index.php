<p>Дан массив с числами. Проверьте, что в этом массиве есть число 5. Если есть - выведите 'да', а если нет - выведите 'нет'.</p>
<?php
$arr = [1, 2, 3, 4, 5];
$flag = false;

foreach ($arr as $item) {
    if ($item == 5) {
        $flag = true;
        break;
    }
}
if ($flag === true){
    echo 'да';
} else {
    echo 'нет';
}
?>
<br>
<?php
$arr = [1, 2, 3, 4, 5];
function hasNum($arr) {
    foreach ($arr as $item) {
        if ($item == 5) {
            return 'да';
        }
    }
    return 'нет';
}
echo hasNum($arr);
?>
<p>Дано число, например 31. Проверьте, что это число не делится ни на одно другое число кроме себя самого и единицы. То есть в нашем случае нужно проверить, что число 31 не делится на все числа от 2 до 30. Если число не делится - выведите 'нет', а если делится - выведите 'да'.</p>
<?php
$num = 31;
$numX = 2;
$flag = false;

while ($numX < $num) {
    $res = $num%$numX;
    if ($res == 0) {
        $flag = true;
        break;
    }
    $numX++;
}
if ($flag == true) {
    echo 'да';
} else {
    echo 'нет';
}
?>
<p>Дан массив с числами. Проверьте, есть ли в нем два одинаковых числа подряд. Если есть - выведите 'да', а если нет - выведите 'нет'.</p>
<?php
$arr = [1, 4, 7, 2, 2, 3];
$flag = false;
for ($i = 0; $i < count($arr)-1; $i++) {
    if ($arr[$i] == $arr[$i + 1]) {
        $flag = true;
        break;
    }
}
if ($flag = true) {
    echo 'да';
} else {
    echo 'нет';
}
?>

