<?php
session_start();
date_default_timezone_set('Europe/Moscow');
$start = microtime(true);
$isValid = true;
$xStr = $_REQUEST['x'];
$yStr = $_REQUEST['y'];
$rStr = $_REQUEST['r'];
$x = $xStr;
$y = $yStr;
$r = $rStr;
$out = "";
$now = date("H:i:s");
$response = "";
$maximum = 12;
if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!is_numeric($x) || !is_numeric($y) || !is_numeric($r))
        $isValid = false;

    if (strlen($y) > $maximum || strlen($x) > $maximum || strlen($r) > $maximum)
        $isValid = false;


    if ($x < -2 || $x > 2)
        $isValid = false;
    if ($r < 1 || $r > 3)
        $isValid = false;
    if ($y < -5 || $y > 5)
        $isValid = false;

    if(!$isValid) {
        header("Status: 400 Bad Request", true, 400);
        exit;
    }

    if(($x >= 0) && ($y <= 0) && ($y >= $x - $r) ||
        ($x <= 0) && ($y <= 0) && ($y >= -$r) && ($x >= -$r/2) ||
        ($x <= 0) && ($y >= 0) && ($x*$x + $y*$y <= $r*$r)){
        $out = "<span>Попадание</span>";
    }
    else
    {
        $out = "<span>Промах</span>";
    }

    $calc_time =  microtime(true) - $start;
    $answer = array($xStr, $yStr, $rStr, $out, $now, $calc_time);
    array_push($_SESSION['data'], $answer);
}
?>
<table class="result_table">
    <tr id = "result_table_head">
        <th class="variable">X</th>
        <th class="variable">Y</th>
        <th class="variable">R</th>
        <th>Результат попадания</th>
        <th>Текущее время</th>
        <th>Время работы скрипта</th>
    </tr>
    <?php foreach ($_SESSION['data'] as $word) { ?>
        <tr>
            <td><?php echo $word[0] ?></td>
            <td><?php echo $word[1] ?></td>
            <td><?php echo $word[2] ?></td>
            <td><?php echo $word[3] ?></td>
            <td><?php echo $word[4] ?></td>
            <td><?php echo number_format($word[5], 10, ".", "") ?></td>
        </tr>
    <?php } ?>
</table>