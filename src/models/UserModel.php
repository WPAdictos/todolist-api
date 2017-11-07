<?php
namespace src\models;

class UserModel extends BaseModel{
 
    public function getScope(string $username){
       //$this->conexion->debug = true;
       $columnas=array('accounts_info.scope');
      
       $result=$this->conexion->from('accounts')
                            ->select(NULL)
                            ->select($columnas)
                            ->where('accounts.username',$username)
                            ->rightJoin('accounts_info ON accounts.id = accounts_info.accounts_id')
                            ->fetch();
       return unserialize($result->scope);
    }
    

    public function getAll(){
        $columnas=array('accounts.*','accounts_info.*' );
        
        return $this->conexion->from('accounts')
                              ->select(NULL)
                              ->select($columnas)
                              ->where('accounts.username',$username)
                              ->rightJoin('accounts_info ON accounts.id = accounts_info.accounts_id')
                              ->fetch();
    }

    public function findById(int $id){
        return $this->conexion->from('accounts', $id)->fetch();
    }

    public function findByUsername(string $username){
        return $this->conexion->from('accounts')->where('username', $username)->fetch();
    }

    public function insert(array $values){
        return $this->conexion->insertInto('accounts', $values)->execute();
    }

    public function update(array $set,int $id){

    }

    public function delete(int $id){

    }

}