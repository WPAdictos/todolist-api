<?php

use \src\controllers\HomeController;
use \src\controllers\CategoryController;
use \src\controllers\TodoController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/', function (Request $request, Response $response) {
    //Hacemos redireccionamiento a /v1
    $uri = $request->getUri() . 'v1'; 
    return $response->withRedirect( (string)$uri,301); 
});


$app->group('/v1', function(){
    $this->get('', HomeController::class . ':index');

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

