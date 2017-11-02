<?php

/*
Instrucciones:
- Descargar proyecto
- Ejecutar composer install
- Ajustar parametros de base de datos en fichero config.php (development), usuario contraseña. Tambien  en fichero phinx.yml
- Ejecutar las migraciones con este comando: vendor/bin/phinx migrate -e development
  (Para hacer rollback o marcha atras) vendor/bin/phinx rollback -e development
- Cargar las seeds con este comando:  vendor/bin/phinx seed:run -s Sprint1Seeder

*/

define("ENTORNO","development");   //development || production
define('BASE_PATH', __DIR__.'/..');

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/src/config/'.ENTORNO.'/config.php';

$dotenv = new Dotenv\Dotenv(BASE_PATH);
$dotenv->load();

$app = new \Slim\App(["settings" => $config]);
//Container-----------------------------------------------------------------------------
require BASE_PATH .'/src/container/container.php';
//Middlewares---------------------------------------------------------------------------
//require BASE_PATH .'/src/middlewares/Middlewares.php';

//Rutas---------------------------------------------------------------------------------
require BASE_PATH .'/src/routes/routes.php';

$app->run();