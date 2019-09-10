<p>По заходу на страницу выведите сколько дней осталось до нового года.</p>
<?php
$hn = date('L');
if ($hn == 1) $year = 366; else $year = 365;
$day = date('z');
$left = $year - $day;
echo '<h3>' . 'До Нового года осталось ' . $left . ' дней!' . '</h3>';
?>
<p>Дан инпут и кнопка. В этот инпут вводится год. По нажатию на кнопку выведите на экран, високосный он или нет.</p>
<?php
error_reporting(E_ALL);
if (!empty($_REQUEST['name'])) {
    $yearL = $_REQUEST['name'];
    if (($yearL % 4 == 0 and $yearL % 100 != 0) || ($yearL % 4 == 0 and $yearL % 400 == 0))
        echo '<h3>Год ' . $yearL . ' високосный</h3>';
    else echo '<h3>Год ' . $yearL . ' не високосный</h3>';
}
?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="GET">
        <input type="text" name="name" placeholder="Введите год"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан инпут и кнопка. В этот инпут вводится дата в формате '01.12.1990'. По нажатию на кнопку выведите на экран день недели, соответствующий этой дате, например, 'воскресенье'.</p>
<?php
error_reporting(E_ALL);
$day = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
if (!empty($_REQUEST['name'])) {
    $arr = explode('.', $_REQUEST['name']);
    $week_day = date('w', mktime(0, 0, 0, $arr[1], $arr[0], $arr[2]));
    echo '<h3>' . $day[$week_day] . '</h3>';
}
?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="GET">
        <input type="text" name="name" placeholder="день.месяц.год"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>По заходу на страницу выведите текущую дату в формате '12 мая 2015 года, воскресенье'.</p>
<?php
error_reporting(E_ALL);
$day_week=['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'];
$month=[1=>'января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
?>
<form action="" method="GET">
    <?php echo '<h3>'.date('j').' '.$month[date('n')].' '.date('Y').' года, '.$day_week[date('w')].'</h3>'; ?>
</form>
<p>Дан инпут и кнопка. В этот инпут вводится дата рождения в формате '01.12.1990'. По нажатию на кнопку выведите на экран сколько дней осталось до дня рождения пользователя.</p>
<?php
error_reporting(E_ALL);
if (!empty($_REQUEST['name'])) {
    $month = date('n');
    $day = date('j');
    $arr = explode('.', $_REQUEST['name']);
    $date1 = date('z', mktime(0, 0, 0, $arr[1], $arr[0], $arr[2]));
    $date2 = date('z');
    $date3 = date('L');
    if ($date3 == 1) $year = 366; else $year = 365;
    if ($month == $arr[1] and $year == $arr[0]) echo '<h3>' . 'Сегодня у вас день рождения!' . '</h3>';
    if ($month == $arr[1] and $year < $arr[0]) echo '<h3>' . 'До дня рождения осталось ' . ($arr[0] - $year) . ' дней' . '</h3>';
    if ($month < $arr[1]) echo '<h3>' . 'До дня рождения осталось ' . ($date1 - $date2) . ' дней' . '</h3>';
    if (($month > $arr[1]) || ($month == $arr[1] and $year > $arr[0])) echo '<h3>' . 'До дня рождения осталось ' . ($year + ($date1 - $date2)) . ' дней' . '</h3>';
}
?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="день.месяц.год"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>По заходу на страницу выведите сколько дней осталось до ближайшей масленницы (последнее воскресенье весны).</p>
<?php
error_reporting(E_ALL);
$dateNow = date('z');
$month = date('n');
$yearNow = date('Y');

$year1 = date('L');
if ($year1 == 1) {
    $dayYear1 = 366;
    $day1 = 29;
} else {
    $dayYear1 = 365;
    $day1 = 28;
}

$year2 = date('L', mktime(0, 0, 0, 0, 0, date('Y') + 1));
if ($year2 == 1) $day2 = 29; else $day2 = 28;

$lastDay1 = dayFebrary($yearNow, $day2);
$lastDay2 = dayFebrary($yearNow + 1, $day1);

if ($month > 2) {
    $str = dayFuture($dayYear1, $dateNow, $lastDay2);
}

if ($month == 2) {
    if ($lastDay1 == $dateNow) $str = 'Сегодня масленица!';
    if ($lastDay1 > $dateNow) $str = 'До ближайшей масленицы осталось ' . ($lastDay1 - $dateNow) . ' дней.';
    if ($lastDay1 < $dateNow) $str = dayFuture($dayYear1, $dateNow, $lastDay2);
}

if ($month == 1) {
    $lastDay = 31 - $dateNow + $lastDay1;
    $str = 'До ближайшей масленицы осталось ' . $lastDay . ' дней.';
}

function dayFuture($d1, $d2, $d3)
{
    $lastDay3 = $d1 - $d2;
    $lastDay = $lastDay3 + 31 + $d3;
    return 'До ближайшей масленицы осталось ' . $lastDay . ' дней.';
}

function dayFebrary($year, $num)
{
    for ($i = $num; $i > 15; $i--) {
        if (date('w', mktime(0, 0, 0, 02, $i, $year)) == 0) break;
    }
    return $i;
}

?>

<form action="" method="POST">
    <h3><?php echo $str; ?></h3>
</form>
<p>Дан инпут и кнопка. В этот инпут вводится дата рождения в формате '31.12'. По нажатию на кнопку выведите знак зодиака пользователя.</p>
<?php
$zodiac = ['1' => ['21.31.01', '1.18.02', 'водолей'],
    '2' => ['19.29.02', '1.20.03', 'рыба'],
    '3' => ['21.31.03', '1.19.04', 'овен'],
    '4' => ['20.30.04', '1.20.05', 'телец'],
    '5' => ['21.31.05', '1.20.06', 'близнецы'],
    '6' => ['21.30.06', '1.22.07', 'рак'],
    '7' => ['23.31.07', '1.22.08', 'лев'],
    '8' => ['23.31.08', '1.22.09', 'дева'],
    '9' => ['23.30.09', '1.22.10', 'весы'],
    '10' => ['23.10-31.10', '1.21.11', 'скорпион'],
    '11' => ['22.30.11', '1.21.12', 'стрелец'],
    '12' => ['22.31.12', '1.20.01', 'козерог']];
if (!empty($_REQUEST['name'])) {
    echo '<h3>Ваш знак - ' . signZodiac($_REQUEST['name'], $zodiac) . '</h3>';
}
function signZodiac($d, $arr)
{
    $b = explode('.', $d);
    $day = $b[0];
    $month = $b[1];

    for ($i = 1; $i <= 12; $i++) {
        for ($j = 0; $j <= 1; $j++) {
            $arr1 = explode('.', $arr[$i][$j]);
            if ($arr1[2] == $month) {
                if ($day >= $arr1[0] and $day <= $arr1[1]) return $arr[$i][2];
            }
        }
    }
    return false;
}

?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="день.месяц"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан массив праздников. По заходу на страницу, если сегодня праздник, то поздравьте пользователя с этим праздником.</p>
<?php
$array = ['1' => ['1.01', 'c Новым годом'],
    '2' => ['23.02', 'с 23 февраля'],
    '3' => ['8.03', 'с 8 марта'],
    '4' => ['1.04', 'с днем смеха'],
    '5' => ['1.05', 'с днем мира и труда'],
    '6' => ['9.05', 'с днем победы'],
    '7' => ['1.06', 'с днем защиты детей']];
function feast($d, $m, $arr)
{
    $count = count($arr);
    for ($i = 1; $i <= $count; $i++) {
        $arr2 = explode('.', $arr[$i][0]);
        if ($arr2[1] == $m and $arr2[0] == $d) {
            return $arr[$i][1];
        }
    }
    return false;
}

?>
<form action="" method="POST">
    <?php
    $str = feast(date('n'), date('m'), $array);

    if ($str !== false) echo '<h3>'.'Уважаемый посетитель, поздравляем вас ' . $str . '!'.'</h3>';
    else
        echo '<h3>'.'Сегодня праздников нет.'.'</h3>';
    ?>
</form>
<p>Сделайте скрипт-гороскоп. Внутри него хранится массив гороскопов на несколько дней вперед для каждого знака зодиака. По заходу на страницу спросите у пользователя дату рождения, определите его знак зодиака и выведите предсказание для этого знака зодиака на текущий день.</p>
<?php
$dayOfWeek = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
$zodiac = ['1' => ['21.31.01', '1.18.02', 'водолей'],
    '2' => ['19.29.02', '1.20.03', 'рыбы'],
    '3' => ['21.31.03', '1.19.04', 'овен'],
    '4' => ['20.30.04', '1.20.05', 'телец'],
    '5' => ['21.31.05', '1.20.06', 'близнецы'],
    '6' => ['21.30.06', '1.22.07', 'рак'],
    '7' => ['23.31.07', '1.22.08', 'лев'],
    '8' => ['23.31.08', '1.22.09', 'дева'],
    '9' => ['23.30.09', '1.22.10', 'весы'],
    '10' => ['23.10-31.10', '1.21.11', 'скорпион'],
    '11' => ['22.30.11', '1.21.12', 'стрелец'],
    '12' => ['22.31.12', '1.20.01', 'козерог']];
$array = ['1' => ['среда',
    'водолей', 'текст 1',
    'рыбы', 'текст 2',
    'овен', 'текст 3',
    'телец', 'текст 4',
    'близнецы', 'текст 5',
    'рак', 'текст 6',
    'лев', 'текст 7',
    'дева', 'текст 8',
    'весы', 'текст 9',
    'скорпион', '10',
    'стрелец', 'текст 11',
    'козерог', 'текст 12']];
if (!empty($_REQUEST['name'])) {
    $z = sign($_REQUEST['name'], $zodiac);
    $s = horoscope($z, $array, $dayOfWeek);
    echo '<h3>Ваш знак - ' . $z . '</h3>';
    echo '<h3>' . $s . '</h3>';
}
function horoscope($zn, $mas, $dw)
{
    $count = count($mas);
    $wDay = $dw[date('w')];
    for ($j = 0; $j <= $count; $j++) {
        if ($mas[$j][0] == $wDay) {
            for ($i = 1; $i <= 24; $i += 2) {
                if ($mas[$j][$i] == $zn) return $mas[$j][$i + 1];
            }
        }
    }
    return false;
}

function sign($d, $arr)
{
    $dq = explode('.', $d);
    $day = $dq[0];
    $month = $dq[1];

    for ($i = 1; $i <= 12; $i++) {
        for ($j = 0; $j <= 1; $j++) {
            $arr1 = explode('.', $arr[$i][$j]);
            if ($arr1[2] == $month) {
                if ($day >= $arr1[0] and $day <= $arr1[1]) return $arr[$i][2];
            }
        }
    }
    return false;
}

?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="день.месяц"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан текстареа и кнопка. В текстареа вводится текст. По нажатию на кнопку выведите количество слов в тексте, количество символов в тексте, количество символов за вычетом пробелов.</p>
<?php
if (!empty($_REQUEST['message'])) {
    $text = $_REQUEST['message'];
    $st = strlen(str_replace(' ', '', $text));
    echo 'Исходный текст: ' . '<i>' . $text . '</i>' . '<br>';
    echo 'Количество слов в тексте: ' . str_word_count($text) . '<br>';
    echo 'Количество символов в тексте (включая пробелы): ' . strlen($text) . '<br>';
    echo 'Количество символов в тексте (без пробелов): ' . $st . '<br>';
}

?>
<?php
if (empty($_REQUEST['message'])) {
    ?>
    <form action="" method="POST">
        <textarea name="message"></textarea>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан текстареа и кнопка. В текстареа вводится текст. По нажатию на кнопку нужно посчитать процентное содержание каждого символа в тексте.</p>
<?php
if (!empty($_REQUEST['message'])) {
    $text = $_REQUEST['message'];
    echo 'Исходный текст: ' . '<i>' . $text . '</i>' . '<br>';
    $st = strlen($text);
    for ($i = 0; $i < $st; $i++) {
        $n = 0;
        for ($j = 0; $j < $st; $j++) {
            if ($text[$i] == $text[$j]) $n++;
        }
        if ($i != 0) $str .= $text[$i - 1];
        if (strpos($str, $text[$i]) === false) echo 'Символ: "' . $text[$i] . '" = ' . round(($n * 100 / $st), 1) . ' %<br>';
    }

}

?>
<?php
if (empty($_REQUEST['message'])) {
    ?>
    <form action="" method="POST">
        <textarea name="message"></textarea>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан массив слов, инпут и кнопка. В инпут вводится набор букв. По нажатию на кнопку выведите на экран те слова, которые содержат в себе все введенные буквы.</p>
<?php
$arr = ['day', 'month', 'year', 'hour', 'minute'];
if (!empty($_REQUEST['name'])) {
    $text = $_REQUEST['name'];
    echo 'Введенные буквы: ' . '<i>' . $text . '</i>' . '<br>';
    $st = strlen($text);
    foreach ($arr as $elem) {
        $n = 0;
        for ($i = 0; $i < $st; $i++) {
            if (strpos($elem, $text[$i]) === false) break; else $n++;
        }
        if ($n == $st) echo 'Слово "' . $elem . '" содержит в себе введенные символы' . '<br>';
    }
}

?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Введите буквы"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан текстареа и кнопка. В текстареа через пробел вводятся слова. По нажатию на кнопку выведите слова в таком виде: сначала заголовок 'слова на букву а' и под ним все слова, которые начинаются на 'а', потом заголовок 'слова на букву б' и все слова на 'б' и так далее. Буквы должны идти в алфавитном порядке. Брать следует только те буквы, на которые начинаются наши слова. То есть: если нет слов, к примеру, на букву 'в' - такого заголовка тоже не будет.</p>
<?php
if (!empty($_REQUEST['message'])) {
    $text = explode(' ', $_REQUEST['message']);
    sort($text);
    foreach ($text as $elem) {
        echo '<b>Слова начинающиеся на букву ' . $elem[0] . ':<b><br>';
        echo '<i>' . $elem . '</i><br>';
    }
}

?>
<?php
if (empty($_REQUEST['message'])) {
    ?>
    <form action="" method="POST">
        <textarea name="message"></textarea><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан инпут и кнопка. В этот инпут вводится строка на русском языке. По нажатию на кнопку выведите на экран транслит этой строки.</p>
<?php
if (!empty($_REQUEST['name'])) {
    $text = $_REQUEST['name'];
    echo 'Исходный текст: <b>' . $text . '</b><br><br>';
    echo 'Измененный текст: <b>' . translation($text) . '</b>';
}
function translation($str)
{
    $arr1 = ['а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'ph', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'];
    $arr2 = ['А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'PH', 'Х' => 'KH', 'Ц' => 'TS', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ы' => 'Y', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA'];
    $str = strtr($str, $arr1);
    $str = strtr($str, $arr2);
    return $str;
}

?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Введите слово"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан инпут, 2 радиокнопочки и кнопка. В инпут вводится строка, а с помощью радиокнопочек выбирается - нужно преобразовать эту строку в транслит или из транслита обратно.</p>
<?php
if (!empty($_REQUEST['name'])) {
    $text = $_REQUEST['name'];
    $ch = $_REQUEST['radio'];
    $tr = translation2($text, $ch);
    echo 'Исходный текст: <b>' . $text . '</b><br><br>';
    echo 'Измененный текст: <b>' . $tr . '</b>';
}
function translation2($str, $n)
{
    $arr1 = ['а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'ph', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'];
    $arr2 = ['А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'PH', 'Х' => 'KH', 'Ц' => 'TS', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ы' => 'Y', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA'];
    if ($n == 1) {
        $arr1 = array_flip($arr1);
        $arr2 = array_flip($arr2);
    }
    $str = strtr($str, $arr1);
    $str = strtr($str, $arr2);
    return $str;
}

?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Введите слово"><br><br>
        <input type="radio" checked name="radio" value="0"><label>в Транслит</label><br><br>
        <input type="radio" name="radio" value="1"><label>из Транслита</label><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан массив с вопросами и правильными ответами. Реализуйте тест: выведите на экран все вопросы, под каждым инпут. Пользователь читает вопрос, пишет свой ответ в инпут. Когда вопросы заканчиваются - он жмет на кнопку, страница обновляется и вместо инпутов под вопросами появляется сообщение вида: 'ваш ответ: ... верно!' или 'ваш ответ: ... неверно! Правильный ответ: ...'. Правильно отвеченные вопросы должны гореть зеленым цветом, а неправильно - красным.</p>
<?php
$arr = ['Столица России','Москва',
    'Столица США','Вашингтон',
    'Столица Япония','Токио'];
$cnt = count($arr);
if (!empty($_REQUEST)) {
    for($i = 0; $i < $cnt; $i += 2) {
        $name = 'name'.$i;
        $m = $_REQUEST[$name];
        ?>
        <style>
            .no {
                color: red;
            }
            .yes {
                color: green;
            }
            .ct {
                color: blue;
            }
        </style>
        <?php
        if ($arr[$i+1] != $m)
        { echo '<p class="ct">'.$arr[$i].'</p>';
            if ($m == '') echo '<p class="no">Вы не ответили на вопрос</p>';
            else echo '<p class="no">Ваш ответ: '.$m.' неверно!</p>'; } else {
            echo '<p class="ct">'.$arr[$i].'</p><p class="yes">Ваш ответ: '.$m.' верно!</p>';
        }
    }
}
function returnSt($a)
{
    return '<input type="text" name="name'.$a.'"><br><br>';
}
?>
<?php
if (empty($_REQUEST)) {
    ?>
    <form action="" method="POST">
        <?php
        for($i = 0; $i < $cnt; $i += 2) {
            echo $arr[$i].'<p>'.returnSt($i).'</p>';
        }
        ?>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Модифицируем предыдущую задачу: пусть теперь тест показывает варианты ответов и радиокнопочки. Пользователь должен выбрать один и вариантов.</p>
<?php
$arr = ['Столица России', 'Санкт-Петербург', 'Москва', 'Новосибирск',
    'Столица США', 'Вашингтон', 'Колумбус', 'Денвер',
    'Столица Германии', 'Берлин', 'Гамбург', 'Эссен',
    'Столица Австрии', 'Вена', 'Грац', 'Линц',
    'Столица Кубы', 'Гавана', 'Гуантанамо', 'Тарара'];
$cnt = count($arr);
if (!empty($_REQUEST)) {
    for ($i = 0; $i < $cnt; $i += 4) {
        $name = 'name' . $i;
        $m = $_REQUEST[$name];
        ?>
        <style>
            .no {
                color: red;
            }

            .yes {
                color: green;
            }

            .ct {
                color: blue;
            }
        </style>
        <?php
        if ($arr[$i + 1] != $m) {
            echo '<p class="ct">' . $arr[$i] . '</p>';
            if ($m == '') echo '<p class="no">вы не ответили на вопрос</p>';
            else echo '<p class="no">ваш ответ: ' . $m . ' неверно!</p>';
        } else {
            echo '<p class="ct">' . $arr[$i] . '</p><p class="yes">ваш ответ: ' . $m . ' верно!</p>';
        }
    }
}
function returnSt2($a, $b)
{
    if ($b == 0) return '<input type="radio" checked name="name' . $a;
    else return '<input type="radio" name="name' . $a;
}

?>
<?php
if (empty($_REQUEST)) {
    ?>
    <form action="" method="POST">
        <style>
            label {
                padding-left: 20px;
            }
        </style>
        <?php
        for ($i = 0; $i < $cnt; $i += 4) {
            echo $arr[$i] . '<br><br>';
            $str = str_split(str_shuffle('012'));
            $mas[$str[0]] = $arr[$i + 1];
            $mas[$str[1]] = $arr[$i + 2];
            $mas[$str[2]] = $arr[$i + 3];
            for ($j = 0; $j <= 2; $j++) {
                if ($j == 0) echo returnSt2($i, 0) . '" value="' . $mas[$j] . '"><label>' . $mas[$j] . '</label><br>'; else
                    echo returnSt2($i, 1) . '" value="' . $mas[$j] . '"><label>' . $mas[$j] . '</label><br>';
            }
            echo '<br><br>';
        }
        ?>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Модифицируем предыдущую задачу: пусть теперь на один вопрос может быть несколько правильных ответов. Пользователь должен отметить один или несколько чекбоксов.</p>
<?php
$arr = ['Города России', 'Санкт-Петербург', 'Москва', 'Новосибирск', 'Кемерово', 'Тюмень', 'Краснодар',
    'Города США', 'Вашингтон', 'Колумбус', 'Денвер', 'Гавана', 'Гуантанамо', 'Тарара',
    'Города Германии', 'Берлин', 'Гамбург', 'Эссен', 'Варшава', 'Нюрнберг', 'Эльблонг'];
$cnt = count($arr);
if (!empty($_REQUEST)) {
    for ($i = 0; $i < $cnt; $i += 7) {
        ?>
        <style>
            .no {
                color: red;
            }

            .yes {
                color: green;
            }

            .ct {
                color: blue;
            }
        </style>
        <?php
        echo '<p class="ct">' . $arr[$i] . '</p>';
        for ($j = $i + 1; $j <= $i + 6; $j++) {
            for ($u = $i; $u <= $i + 6; $u++) {
                $name = 'name' . $u;
                if ($j <= ($i + 3) and $arr[$j] == $_REQUEST[$name]) echo '<p class="yes">ваш ответ: ' . $_REQUEST[$name] . ' верный!</p>';
                if ($j > ($i + 3) and $arr[$j] == $_REQUEST[$name]) echo '<p class="no">ваш ответ: ' . $_REQUEST[$name] . ' неверный!</p>';
            }
        }
    }
}
function returnSt3($a)
{
    return '<input type="checkbox" name="name' . $a;
}

?>
<?php
if (empty($_REQUEST)) {
    ?>
    <form action="" method="POST">
        <style>
            label {
                padding-left: 20px;
            }
        </style>
        <b>Какие города входят в состав страны?</b><br><br><br>
        <?php
        for ($i = 0; $i < $cnt; $i += 7) {
            echo $arr[$i] . '<br><br>';
            $str = str_split(str_shuffle('012345'));
            for ($u = 1; $u <= 6; $u++) $mas[$str[$u - 1]] = $arr[$i + $u];
            for ($j = 0; $j <= 5; $j++) {
                echo returnSt3($i + $j) . '" value="' . $mas[$j] . '"><label>' . $mas[$j] . '</label><br>';
            }
            echo '<br><br>';
        }
        ?>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Напишите скрипт, который будет считать факториал числа. Само число вводится в инпут и после нажатия на кнопку пользователь должен увидеть результат.</p>
<?php
if (!empty($_REQUEST['name'])) {
    echo 'факториал числа '.$_REQUEST['name'].' = '.factorial($_REQUEST['name']);
}
function factorial($a)
{
    $result = 1;
    if ($a == 1) return $a; else {
        for($i = 1; $i <= $a; $i++)
            $result *= $i;
        return $result;
    }
}
?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Напишите скрипт, который будет находить корни квадратного уравнения. Для этого сделайте 3 инпута, в которые будут вводиться коэффициенты уравнения.</p>
<?php
if (!empty($_REQUEST['name1'])) {
    $a = $_REQUEST['name1'];
    if(empty($_REQUEST['name2'])) $b = 0; else $b = $_REQUEST['name2'];
    if(empty($_REQUEST['name3'])) $c = 0; else $c = $_REQUEST['name3'];
    $d = $b * $b - 4 * $a * $c;
    if ($d < 0) echo 'Уравнение не имеет корней';
    if ($d == 0) echo 'Уравнение имеет один корень и равен '.((- $b - sqrt($d)) / 2 * $a);
    if ($d > 0) echo 'Уравнение имеет два корня и равен '.((- $b + sqrt($d)) / 2 * $a).' и '.((- $b - sqrt($d)) / 2 * $a);
}
?>
<?php
if (empty($_REQUEST['name1'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name1"><br><br>
        <input type="text" name="name2"><br><br>
        <input type="text" name="name3"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Даны 3 инпута. В них вводятся числа. Проверьте, что эти числа являются тройкой Пифагора: квадрат самого большого числа должен быть равен сумме квадратов двух остальных.</p>
<?php
if (!empty($_REQUEST['name1']) and !empty($_REQUEST['name2']) and !empty($_REQUEST['name3'])) {
    $a = $_REQUEST['name1'];
    $b = $_REQUEST['name2'];
    $c = $_REQUEST['name3'];
    if (square($a, $b, $c) == true)
        echo 'числа '.$a.', '.$b.', '.$c.', являются числами Пифагора'; else
        echo 'числа '.$a.', '.$b.', '.$c.', не являются числами Пифагора';
}
function square($a1, $b1, $c1)
{
    if ($a1 > $b1 and $a1 > $c1 and $a1 == sqrt($b1 * $b1 + $c1 * $c1)) return true;
    if ($b1 > $a1 and $b1 > $c1 and $b1 == sqrt($a1 * $a1 + $c1 * $c1)) return true;
    if ($c1 > $a1 and $c1 > $b1 and $c1 == sqrt($b1 * $b1 + $a1 * $a1)) return true;
    return false;
}
?>
<?php
if (empty($_REQUEST['name1']) and empty($_REQUEST['name2']) and empty($_REQUEST['name1'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name1"><br><br>
        <input type="text" name="name2"><br><br>
        <input type="text" name="name3"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан инпут и кнопка. В инпут вводится число. По нажатию на кнопку выведите список делителей этого числа.</p>
<?php
if (!empty($_REQUEST['name'])) {
    $a = $_REQUEST['name'];
    echo 'Делители числа '.$a.':'.'<br><br>';
    del($a);
}
function del($c)
{
    if ($c == 1) { echo 'делитель 1'; return; }
    for($i = 1; $i <= $c; $i++){
        if ($c % $i == 0) echo 'делитель '.$i.'<br>';
    }
}
?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Дан инпут и кнопка. В инпут вводится число. По нажатию на кнопку разложите число на простые множители.</p>
<?php
if (!empty($_REQUEST['name'])) {
    $a = $_REQUEST['name'];
    echo 'Простые множители числа '.$a.':'.'<br><br>';
    if ($a != 1) {
        $arr = multiply($a);
        foreach($arr as $elem) echo $elem.'<br><br>'; }
}
function multiply($c)
{
    for($i = 2; $i <= 9; $i++){
        if ($c % $i == 0) { $mas[] = $i; $c = $c / $i; multiply($c); }
    }
    $mas[] = $c;
    return $mas;
}
?>
<?php
if (empty($_REQUEST['name'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Даны 2 инпута и кнопка. В инпуты вводятся числа. По нажатию на кнопку выведите список общих делителей этих двух чисел.</p>
<?php
if (!empty($_REQUEST['name1']) and !empty($_REQUEST['name2'])) {
    $a = $_REQUEST['name1'];
    $b = $_REQUEST['name2'];
    $arr1 = del2($a);
    $arr2 = del2($b);
    echo 'Общие делители чисел '.$a.' и '.$b.':<br><br>';
    $d = array_intersect($arr1, $arr2);
    foreach($d as $elem)
        echo $elem.'<br><br>';
}
function del2($c)
{
    for($i = 1; $i <= $c; $i++){
        if ($c % $i == 0) $arr[] = $i;
    }
    return $arr;
}
?>
<?php
if (empty($_REQUEST['name1']) and empty($_REQUEST['name2'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name1"><br><br>
        <input type="text" name="name2"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Даны 2 инпута и кнопка. В инпуты вводятся числа. По нажатию на кнопку выведите наибольший общий делитель этих двух чисел.</p>
<?php
if (!empty($_REQUEST['name1']) and !empty($_REQUEST['name2'])) {
    $a = $_REQUEST['name1'];
    $b = $_REQUEST['name2'];
    $arr1 = del3($a);
    $arr2 = del3($b);
    echo 'Общие делители чисел '.$a.' и '.$b.':<br><br>';
    $d = array_intersect($arr1, $arr2);
    echo 'Наибольший делитель равен '.max($d);
}
function del3($c)
{
    for($i = 1; $i <= $c; $i++){
        if ($c % $i == 0) $arr[] = $i;
    }
    return $arr;
}
?>
<?php
if (empty($_REQUEST['name1']) and empty($_REQUEST['name2'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name1"><br><br>
        <input type="text" name="name2"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Даны 2 инпута и кнопка. В инпуты вводятся числа. По нажатию на кнопку выведите наименьшее число, которое делится и на одно, и на второе из введенных чисел.</p>
<?php
if (!empty($_REQUEST['name1']) and !empty($_REQUEST['name2'])) {
    $a = $_REQUEST['name1'];
    $b = $_REQUEST['name2'];
    $arr1 = del4($a);
    $arr2 = del4($b);
    echo 'Общие делители чисел '.$a.' и '.$b.':<br><br>';
    $d = array_intersect($arr1, $arr2);
    echo 'Наименьший делитель равен '.min($d);
}
function del4($c)
{
    for($i = 2; $i <= $c; $i++){
        if ($c % $i == 0) $arr[] = $i;
    }
    return $arr;
}
?>
<?php
if (empty($_REQUEST['name1']) and empty($_REQUEST['name2'])) {
    ?>
    <form action="" method="POST">
        <input type="text" name="name1"><br><br>
        <input type="text" name="name2"><br><br>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>
<p>Даны 3 селекта и кнопка. Первый селект - это дни от 1 до 31, второй селект - это месяцы от января до декабря, а третий - это годы от 1990 до 2025. С помощью этих селектов можно выбрать дату. По нажатию на кнопку выведите на экран день недели, соответствующий этой дате, например, 'воскресенье'.</p>
<?php
$arr = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
if (!empty($_REQUEST['day']) and !empty($_REQUEST['month']) and !empty($_REQUEST['year'])) {
    echo 'Дате ' . $_REQUEST['day'][0] . '.' . $_REQUEST['month'][0] . '.' . $_REQUEST['year'][0] .
        ' соответсвует ' . $arr[date('w', mktime(0, 0, 0, $_REQUEST['month'][0], $_REQUEST['day'][0], $_REQUEST['year'][0]))];
}
function option($z)
{
    return '<option value="' . $z . '">' . $z . '</option>';
}

?>
<?php
if (empty($_REQUEST['day']) || empty($_REQUEST['month']) || empty($_REQUEST['year'])) {
    ?>
    <form action="" method="POST">
        <select name="day[]" multiple>
            <?php for ($i = 1; $i <= 31; $i++) echo option($i); ?>
        </select>
        <select name="month[]" multiple>
            <?php for ($i = 1; $i <= 12; $i++) echo option($i); ?>
        </select>
        <select name="year[]" multiple>
            <?php for ($i = 1990; $i <= 2025; $i++) echo option($i); ?>
        </select>
        <input type="submit" value="Отправить">
    </form>
    <?php
}
?>