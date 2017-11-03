<?php
use \src\models\CategoriesModel;
use \src\models\TodoModel;


$container = $app->getContainer();

//Creacion array opciones de conexion a la base de datos
$config=$container['settings'];
$pass="";
if(ENTORNO === 'development')  $pass=getenv("DB_PASS_DEV"); 
   else $pass=getenv("DB_PASS_PRO");
$options=array(
    'dblib' => $config['dblibmodels'],
    'host'  => $config['db']['host'],
    'dbname'=> $config['db']['dbname'],
    'user'  => $config['db']['user'],
    'pass'  => $pass
);

$container['CategoriesModel'] = function ($container) use($options){
     return new CategoriesModel($options);
};


$container['TodoModel'] = function ($container)  use($options) {
    return new TodoModel($options);
};
