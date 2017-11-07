<?php
namespace src\middlewares;
use Psr\Container\ContainerInterface;
/*
Middleware para controlar autenticacion

*/
class AuthMiddleware{
   
   protected $container;

   public function __construct(ContainerInterface $container){
      $this->container=$container;
   }

   public function __invoke($request, $response,$next){

      if(!isset($_SESSION['user'])){
        return $response->withRedirect($this->container->router->pathFor('auth.signin'));
      } 

      return $next($request,$response);
   }

}