<?php
namespace src\controllers;
use src\controllers\BaseController;
use Exception;

final class TodoController extends BaseController{

    public function index($request, $response, $args)
    {     
        //Parametros 
        //?list=basic || ?list=verbose
        //?limit=N
        //?offset=N
       try{       
        $tipo=htmlspecialchars($request->getQueryParam('list',$default = 'basic'));
        $limit=(int)$request->getQueryParam('limit');
        $offset=(int)$request->getQueryParam('offset');

        $todolist = $this->container->get('TodoModel');
        $response=$this->container->get('cache')->withEtag($response, $todolist->lastUpdated());
        $response = $this->container->get('cache')->withExpires( $response, time() + 3600); 
        return  $response->withJson($todolist->getAll($tipo,$limit,$offset), 200);
       }catch (Exception $e){
          $this->container->get('errorlog')->error($e->getMessage());
          return $response->withJson(array('error'=>'Ha ocurrido un error consulte al administrador'), 500);
       }
    }

    public function show($request, $response, $args)
    {
        try{    
            $todolist = $this->container->get('TodoModel');
            if($data=$todolist->findById((int) $args['id'])) {
                return $response->withJson($data, 200);
            }else{
                return $response->withJson(array('error'=>'Tarea no encontrada'), 404);
            }  
        }catch (Exception $e){
            $this->container->get('errorlog')->error($e->getMessage());
            return $response->withJson(array('error'=>'Ha ocurrido un error consulte al administrador'), 500);
         }
    }

    public function create($request, $response, $args)
    {
       try{
        $inputVars= $request->getParsedBody();
        
        if( !isset($inputVars['categories_id']) or empty($inputVars['categories_id']))
           return $response->withJson(array('error'=>'Parametros vacios o incorrectos - categories_id'),400);
        if( !isset($inputVars['accounts_id']) or empty($inputVars['accounts_id']))
           return $response->withJson(array('error'=>'Parametros vacios o incorrectos - accounts_id'),400);
        if( !isset($inputVars['todo']) or empty($inputVars['todo']))
           return $response->withJson(array('error'=>'Parametros vacios o incorrectos - todo'),400);
        if( !isset($inputVars['done']) or empty($inputVars['done']))
           return $response->withJson(array('error'=>'Parametros vacios o incorrectos - done'),400);
              
        $todolist = $this->container->get('TodoModel');
         $values=array(
                "categories_id" => (int) $inputVars['categories_id'],
                "accounts_id" => (int) $inputVars['accounts_id'],
                "todo" => htmlspecialchars($inputVars['todo']),
                "done" => (filter_var($inputVars['done'], FILTER_VALIDATE_BOOLEAN)) ? 1 : 0
         );
         
        
         if ($result=$todolist->insert($values)){
             $data['operacion'] = 'Insercion OK';
             $data['idtodo'] = $result;
             return $response->withJson($data,201);
     
         }else{
             $data['error'] = 'Se ha producido un error en la insercion.';
             return $response->withJson($data,400);
         }
       }catch (Exception $e){
            $this->container->get('errorlog')->error($e->getMessage());
            return $response->withJson(array('error'=>'Ha ocurrido un error consulte al administrador'), 500);
         }
       
    }

    public function update($request, $response, $args)
    {
       try{
        $inputVars= $request->getParsedBody();
        $values=array();
        if(isset($inputVars['categories_id']) and !empty($inputVars['categories_id']))
            $values['categories_id'] = (int) $inputVars['categories_id'] ;
        if(isset($inputVars['accounts_id']) and !empty($inputVars['accounts_id']))
            $values['accounts_id'] = (int) $inputVars['accounts_id'] ;
        if(isset($inputVars['todo']) and !empty($inputVars['todo']))
            $values['todo'] = htmlspecialchars($inputVars['todo']) ;
        if(isset($inputVars['done']) and !empty($inputVars['done']))
            $values['done'] = (filter_var($inputVars['done'], FILTER_VALIDATE_BOOLEAN)) ? 1 : 0 ;
                
        if(empty($values)){
            return $response->withJson(array('error'=>'Debe de enviar los campos a modificar.'), 400); 
        }else{
            $todolist = $this->container->get('TodoModel');
            if(  $todolist->update($values,(int) $args['id'])){
                return $response->withJson(array('operacion'=>'Registro actualizado correctamente'), 200);
            }else{
                return $response->withJson(array('error'=>'Se ha producido un error en la actualizacion'), 400);
            }   
        }
       }catch (Exception $e){
        $this->container->get('errorlog')->error($e->getMessage());
        return $response->withJson(array('error'=>'Ha ocurrido un error consulte al administrador'), 500);
       }
    }

    public function delete($request, $response, $args)
    {
       try{
        $todolist = $this->container->get('TodoModel');
        if($todolist->delete((int) $args['id'])) {
            return $response->withJson(array('operacion'=>'Registro borrado correctamente'), 200);
         }else{
            return $response->withJson(array('error'=>'Se ha producido un error en el borrado.'), 400);
         }   
       }catch (Exception $e){
          $this->container->get('errorlog')->error($e->getMessage());
          return $response->withJson(array('error'=>'Ha ocurrido un error consulte al administrador'), 500);
         }   
    }
}