<?php
//Configuracion Modo Production


//Configuracion SLIM
$config['displayErrorDetails'] = false;
$config['addContentLengthHeader'] = false;
//$config['routerCacheFile'] = 'cache/routes.cache.php;

//Configuracion Database Modelos
$config['dblibmodels']= 'fluentpdo';              //fluentpdo || pdo
$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['dbname'] = "todolist";

$config['force_https']='true';