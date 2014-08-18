<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbdaba = 'borsa';

$dblink = mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());

$db = mysql_select_db($dbdaba, $dblink) or die(mysql_error());

mysql_query("SET CHARACTER SET cp1251")
?>