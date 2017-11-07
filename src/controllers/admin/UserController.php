<?php
namespace src\controllers\admin;
use src\controllers\admin\BaseController;

class UserController extends BaseController{

        // Constantes para definir los permisos de accesoa  nivel de acciones /rutas
        const PERM_FULL = 5;
        const PERM_DELETE = 4;
        const PERM_ADD = 3;
        const PERM_EDIT = 2;
        const PERM_SELECT = 1;
        const PERM_NONE = 0;

    public function index($request, $response, $args){
       //Ejemplo de redireccionamiento accediendo al container y con rutas con nombre
       //return $response->withRedirect( $this->container->router->pathFor('raizv1'));
      
      return "UserController:index";
    }

    public function show($request, $response, $args){
        return "UserController:show";
    }

    public function create($request, $response, $args){
        return "UserController:create";
    }


    public function update($request, $response, $args){
        return "UserController:update";
    }

    public function delete($request, $response, $args){
        return "UserController:delete";
    }

}