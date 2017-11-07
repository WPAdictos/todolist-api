<?php
namespace src\lib;
// 

class Token{

   private $decoded;
   private $scope;

   public function save($decoded)
   {
       $this->decoded = $decoded;
       $this->scope=$decoded->scope;
   }

   //Determina si tiene permiso en el area pasada por parametro
   public function hasScope(array $scopecheck)
   { 
       foreach($this->scope as $area => $scope){
	      if($area === $scopecheck['area']){
            return $scope >= $scopecheck['scope'];
          }
        }
        return false;
   }
}