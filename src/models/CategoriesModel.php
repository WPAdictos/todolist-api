<?php
namespace src\models;

class CategoriesModel extends BaseModel{

    
     
    function getAll(){
        return $this->conexion->from('categories')->fetchAll();
    }

    function findById( int $id){
        return $this->conexion->from('categories', $id)->fetch();
    }

    function insert(array $values){
        return $this->conexion->insertInto('categories', $values)->execute();
    }

    function update(array $set,int $id){
        return $this->conexion->update('categories',$set,$id)->execute();
     }
 
     function delete(int $id){
         return $this->conexion->deleteFrom('categories',$id)->execute();
     }

}