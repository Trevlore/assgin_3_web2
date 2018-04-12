<?php
$ip = getenv('IP');
$port = '3306';

define('DBHOST', '');
define('DBNAME', 'travel');
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');
define('DBCONNECTION','mysql:dbname=travel;charset=utf8mb4;');

spl_autoload_register(function ($class) {
 $file = 'lib/' . $class . '.class.php';
 if (file_exists($file))
 include $file;
});

$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION,DBUSER, DBPASS));

// Build connection, and pass it to other classes.


/*
****Source Lab 17*********** - Trevor

error_reporting(E_ALL);
ini_set('display_errors','1');


$ip = getenv('IP');
$port = '3306';


define('DBCONNECTION', "mysql:host=$ip;port=$port;dbname=book;charset=utf8mb4;");
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');


spl_autoload_register(function ($class) {
 $file = 'lib/' . $class . '.class.php';
 if (file_exists($file))
 include $file;
});


$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION,
 DBUSER, DBPASS));


*/

?>