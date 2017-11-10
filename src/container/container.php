<?php
use \src\models\CategoriesModel;
use \src\models\TodoModel;
use \src\models\UserModel;
use \src\lib\Token;
use \src\lib\Auth;

$container = $app->getContainer();

//Creacion array opciones de conexion a la base de datos
$config=$container['settings'];
$pass="";
if (ENTORNO === 'development') {
    $pass=getenv("DB_PASS_DEV");
} else {
    $pass=getenv("DB_PASS_PRO");
}
$options=array(
    'dblib' => $config['dblibmodels'],
    'host'  => $config['db']['host'],
    'dbname'=> $config['db']['dbname'],
    'user'  => $config['db']['user'],
    'pass'  => $pass
);

// Modelos de datos
$container['CategoriesModel'] = function ($container) use ($options) {
     return new CategoriesModel($options);
};


$container['TodoModel'] = function ($container) use ($options) {
    try {
        return new TodoModel($options);
    } catch (Exception $e) {
        throw $e;
    }
};

$container['UserModel'] = function ($container) use ($options) {
    return new UserModel($options);
};

//Proveedor de http-cache
$container['cache'] = function ($container) {
    return new \Slim\HttpCache\CacheProvider();
};

//Cuando se recibe una peticion de un cliente, aqui se guarda su token y permisos
$container['token'] = function ($container) {
    return new Token();
};


//PDO conexion para autenticar usuarios para la obtencion del token
$container['pdo'] = function ($container) use ($options) {
    //$container['logger']->addInfo("DSN=", array('dsn' => DSN));
    try {
        $pdo = new PDO ("mysql:host=" . $options['host'] . ";dbname=" . $options['dbname'], $options['user'], $options['user']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        throw $e;
    }
    return $pdo;
};

$container['auth'] = function ($container) {
    return new Auth();
};

//Sistema de Plantilla TWIG
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(BASE_PATH .'/public/views', [
        'cache' => false
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    
    //añade una variable global a las vistas
    $view->getEnvironment()->addGlobal('auth', [
        'issignin' => $container['auth']->isSignIn()
        
    ]);
    $view->getEnvironment()->addGlobal('saludar', 'Hola Mundo');
    
    return $view;
};

//Gestion de logs
$container['errorlog'] = function ($container) {
    $logger = new \Monolog\Logger('errorlog');
    $file_handler = new \Monolog\Handler\StreamHandler(BASE_PATH ."/logs/error.log");
    $logger->pushHandler($file_handler);
    return $logger;
};
