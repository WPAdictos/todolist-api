<?php
namespace src\middlewares;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/*
Ejemplo de Middleware de clase, se llama en /v1/mw routes.php linea 39

*/
class TestMW{
   
   protected $container;

   public function __construct(ContainerInterface $container){
      $this->container=$container;
   }

   public function __invoke(Request $request, Response $response,$next){
    $response->getBody()->write('BEFORE' . '<br>');
    $response = $next($request, $response);
    $response->getBody()->write('<br>'.'AFTER');

    return $response;
      
   }

}