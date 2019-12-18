<?php

$urlStart = $_SERVER['REQUEST_URI'];
$pos = strpos($urlStart, '/');
$result = substr($urlStart, 0, $pos-10);
//echo $_SERVER['DOCUMENT_ROOT'] . $result . 'config.php';



