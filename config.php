	<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// HTTP
define('HTTP_SERVER', 'https://footlounge.in/');
$documentRoot = $_SERVER['DOCUMENT_ROOT'].'/';
define('DOCUMENT_ROOT', $documentRoot); 

// HTTPS
define('HTTPS_SERVER', 'https://footlounge.in/');

$documentRoot = $_SERVER['DOCUMENT_ROOT'].'/';

// DIR
define('DIR_APPLICATION', $documentRoot. 'catalog/');
define('DIR_SYSTEM', $documentRoot. 'system/');
define('DIR_DATABASE', $documentRoot. 'system/database/');
define('DIR_LANGUAGE', $documentRoot. 'catalog/language/');
define('DIR_TEMPLATE', $documentRoot. 'catalog/view/theme/');
define('DIR_CONFIG', $documentRoot. 'system/config/');
define('DIR_IMAGE', $documentRoot. 'image/');
define('DIR_CACHE', $documentRoot. 'system/cache/');
define('DIR_DOWNLOAD', $documentRoot. 'download/');
define('DIR_LOGS', $documentRoot. 'system/logs/');
// DB

define('CurrentHost','https://footlounge.in'); 
define('mailchimp_APIkey','b2d475cf2e336960cd8faa96d8209b3f-us12');  

define('DB_DRIVER', 'mysqliz');
define('DB_HOSTNAME', 'aa8kg1npvdowa0.cvwrkeif9dtm.ap-south-1.rds.amazonaws.com');
define('DB_USERNAME', 'fladmin');
define('DB_PASSWORD', 'Welcome!23'); 
define('DB_DATABASE', 'ebdb');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');  
?>  