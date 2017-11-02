<?php
use \src\models\CategoriesModel;


$container = $app->getContainer();

$container['CategoriesModel'] = function ($container) {
    $config=$container['settings'];
    $pass="";
    if(ENTORNO === 'development') 
       $pass=getenv("DB_PASS_DEV"); 
       else $pass=getenv("DB_PASS_PRO");
    $options=array(
        'dblib' => $config['dblibmodels'],
        'host'  => $config['db']['host'],
        'dbname'=> $config['db']['dbname'],
        'user'  => $config['db']['user'],
        'pass'  => $pass
    );
    return new CategoriesModel($options);
};

