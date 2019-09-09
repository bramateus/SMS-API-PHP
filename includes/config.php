<?php
define( 'MYSQL_HOST', 'localhost' );
define( 'MYSQL_USER', 'root' );
define( 'MYSQL_PASSWORD', '' );
define( 'MYSQL_DB_NAME', 'lps_ccc' );

$sqlconex = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME);
mysqli_set_charset ($sqlconex, 'utf8');