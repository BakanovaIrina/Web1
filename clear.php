<?php
session_start();
if (isset($_SESSION['data'])) {
    $_SESSION['data'] = array();
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
