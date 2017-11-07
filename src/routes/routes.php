<?php

use \src\controllers\HomeController;
use \src\controllers\CategoryController;
use \src\controllers\TodoController;
use \src\controllers\AuthController;
use \src\controllers\admin\UserController;
use \src\controllers\admin\AdminController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \src\middlewares\TestMW;
use \src\middlewares\AuthMiddleware;

//WEB---------------------------------------------------------------
$app->group('/', function()  use ($container){
    $this->get('', function (Request $request, Response $response) {
        //Hacemos redireccionamiento a /v1
        // Revisar controlador admin/users:index
        //Ejemplo de redireccionamiento accediendo al container y con rutas con nombre
        //return $response->withRedirect( $this->container->router->pathFor('raizv1'));
      
        $uri = $request->getUri() . 'v1'; 
        return $response->withRedirect( (string)$uri,301); 
      
    });
    //Registro y login de usuarios
    $this->get('auth/signup', AuthController::class . ':getSignUp')->setName('auth.signup');
    $this->post('auth/signup', AuthController::class . ':postSignUp');

    $this->get('auth/signin', AuthController::class . ':getSignIn')->setName('auth.signin');
    $this->post('auth/signin', AuthController::class . ':postSignIn');
    
    //URLs zona admin
    $this->group('admin', function()  use ($container){

        $this->get('', AdminController::class . ':index')->setName('admin.home');
            
        $this->group('/users', function ()  use ($container) {
            $this->get('', UserController::class . ':index')->setName('users');
            $this->get('/{id}', UserController::class . ':show');   
            $this->post('', UserController::class . ':create');
            $this->put('/{id}',  UserController::class . ':update');
            $this->delete('/{id}',  UserController::class . ':delete');
        });
    })->add(new AuthMiddleware($container));
});

// API REST------------------------------------------------------------
$app->group('/v1', function()  use ($container){
    $this->get('', HomeController::class . ':index')->setName('raizv1');
    $this->get('/test', HomeController::class . ':test');
    $this->post('/token', HomeController::class . ':token');
    $this->get('/mw', HomeController::class . ':mw')->add(new TestMW($container)); //Test de un MW de clase

    $this->group('/categories', function () {
        $this->get('', CategoryController::class . ':index');
        $this->get('/{id}', CategoryController::class . ':show');   
        $this->post('', CategoryController::class . ':create');
        $this->put('/{id}',  CategoryController::class . ':update');
        $this->delete('/{id}',  CategoryController::class . ':delete');
    });

    $this->group('/todo', function () {
        $this->get('', TodoController::class . ':index');
        $this->get('/{id}', TodoController::class . ':show');   
        $this->post('', TodoController::class . ':create');
        $this->put('/{id}',  TodoController::class . ':update');
        $this->delete('/{id}',  TodoController::class . ':delete');
    });
});

