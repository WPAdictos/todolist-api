<?php
namespace src\controllers;
use src\controllers\BaseController;


final class CategoryController extends BaseController{



    public function index($request, $response, $args)
    {
        $categories = $this->container->get('CategoriesModel');
        return $response->withJson($categories->getAll(), 200);
    }

    public function show($request, $response, $args)
    {
        $categories = $this->container->get('CategoriesModel');
        if($data=$categories->findById((int)$args['id'])) {
            return $response->withJson($data, 200);
         }else{
            return $response->withJson(array('error'=>'Categoria no encontrada'), 404);
         }  
    }

    public function create($request, $response, $args)
    {
        $inputVars= $request->getParsedBody();
        
         if( !isset($inputVars['categoryname']) or empty($inputVars['categoryname']))
           return $response->withJson(array('error'=>'Parametros vacios o incorrectos - categoryname'),400);
 
              
        $categories= $this->container->get('CategoriesModel');
         $values=array(
                "categoryname" => htmlspecialchars($inputVars['categoryname'])
         );
        
         if ($result=$categories->insert($values)){
             $data['operacion'] = 'Insercion OK';
             $data['idcategory'] = $result;
             return $response->withJson($data,201);
     
         }else{
             $data['error'] = 'Se ha producido un error en la insercion.';
             return $response->withJson($data,400);
         }
    }

    public function update($request, $response, $args)
    {
        $inputVars= $request->getParsedBody();
        $values=array();
        if(isset($inputVars['categoryname']) and !empty($inputVars['categoryname']))
            $values['categoryname'] = htmlspecialchars($inputVars['categoryname']) ;
                
        if(empty($values)){
            return $response->withJson(array('error'=>'Debe de enviar los campos a modificar.'), 400); 
        }else{
            $categories= $this->container->get('CategoriesModel');
            if( $categories->update($values,(int) $args['id'])){
                return $response->withJson(array('operacion'=>'Registro actualizado correctamente'), 200);
            }else{
                return $response->withJson(array('error'=>'Se ha producido un error en la actualizacion'), 400);
            }   
        }
    }

    public function delete($request, $response, $args)
    {
        $categories= $this->container->get('CategoriesModel');
        if($categories->delete((int) $args['id'])) {
            return $response->withJson(array('operacion'=>'Registro borrado correctamente'), 200);
         }else{
            return $response->withJson(array('error'=>'Se ha producido un error en el borrado.'), 400);
         }         
    }

}