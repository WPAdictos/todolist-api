<?php
namespace src\controllers\admin;
use src\controllers\admin\BaseController;

final class AdminController extends BaseController{

        // Constantes para definir los permisos de accesoa  nivel de acciones /rutas
        const PERM_FULL = 5;
        const PERM_DELETE = 4;
        const PERM_ADD = 3;
        const PERM_EDIT = 2;
        const PERM_SELECT = 1;
        const PERM_NONE = 0;

    public function index($request, $response, $args){
        $categories = $this->container->get('CategoriesModel');
      
        $data['nombre'] = "Sergio";
        $data['edad'] = 24;
        $data['categorias'] = $categories->getAll();
        $data['titulo']= "INDEX";

      return $this->container->view->render($response, 'admin/index.twig',$data);
    }

    public function show($request, $response, $args){
        return "AdminController:show";
    }

    public function create($request, $response, $args){
        return "AdminController:create";
    }


    public function update($request, $response, $args){
        return "AdminControllerr:update";
    }

    public function delete($request, $response, $args){
        return "AdminController:delete";
    }

}