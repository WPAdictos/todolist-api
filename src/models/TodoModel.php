<?php
namespace src\models;

class TodoModel extends BaseModel{

    function getAll($list='basic'){
        //?list=basic || ?list=verbose
        //$this->conexion->debug = true;
        if($list === 'basic')
           return $this->conexion->from('todolist')->fetchAll();
           else{//verbose
             $columnas=array('todolist.id','todolist.todo', 'todolist.done','categories.categoryname','todolist.created', 'accounts.username');
             return $this->conexion->from('todolist')
                                  ->select(NULL)
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
}