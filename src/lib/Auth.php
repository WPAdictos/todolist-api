<?php
namespace src\lib;
// 

class Auth{

    //Para saber si esta iniciada la sesion
    public function isSignIn(){
       return isset($_SESSION['user']);
    }


}