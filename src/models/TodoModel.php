<?php
namespace src\models;
use PDO;

class TodoModel extends BaseModel{

    function getAll($list='basic',$limit,$offset){
        //?list=basic || ?list=verbose
        //$this->conexion->debug = true;
        $sql= $this->conexion->from('todolist');
        if(isset($limit) and isset($offset)){
            $sql=$sql->limit($limit)->offset($offset);
        }

        if($list === 'basic')
           return $sql->fetchAll();   
         //return $this->conexion->from('todolist')->limit($limit)->offset($offset)->fetchAll();
           else{//verbose
             $columnas=array('todolist.id','todolist.todo', 'todolist.done','categories.categoryname','todolist.created_at', 'accounts.username');
             /*
             return $this->conexion->from('todolist')
                                  ->select(NULL)
                                  ->select($columnas)
                                  ->select('categories.categoryname')
                                  ->select('accounts.username')
                                  ->orderBy('todolist.id')
                                  ->fetchAll();
            */
            return $sql->select(NULL)
                       ->select($columnas)
                       ->select('categories.categoryname')
                       ->select('accounts.username')
                       ->orderBy('todolist.id')
                       ->fetchAll();
           }
    }

    function findById(int $id){
        return $this->conexion->from('todolist', $id)->fetch();
    }

    function insert(array $values){
        return $this->conexion->insertInto('todolist', $values)->execute();
    }

    function update(array $set,int $id){
        return $this->conexion->update('todolist',$set,$id)->execute();
     }
 
     function delete(int $id){
         return $this->conexion->deleteFrom('todolist',$id)->execute();
     }

     function lastUpdated(){
         //Obtiene la ultima modificacion de la tabla para generar la etiqueta ETAG
         //Comprueba el last updated y tb el count(*)
         $count = (string) $this->conexion->from('todolist')->select('COUNT(*) AS total')->fetch()->total;
         $lastupdate = (string) $this->conexion->from('todolist')->select('MAX(updated_at) AS ultimo')->fetch()->ultimo;
         return md5($lastupdate . $count);
 
     }
}