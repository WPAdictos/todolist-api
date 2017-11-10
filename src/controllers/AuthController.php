<?php
namespace src\controllers;
use src\controllers\BaseController;
use Firebase\JWT\JWT;
use Tuupola\Base62;
use DateTime;


final class AuthController extends BaseController{

    public function getSignUp($request, $response, $args){

        return $this->container->view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response, $args){
        // Validar con Respect Validation
        // https://www.youtube.com/watch?v=5VuBJ2yaXpk&list=PLfdtiltiRHWGc_yY90XRdq6mRww042aEC&index=11
        $users = $this->container->get('UserModel');
        $inputVars= $request->getParsedBody();
        $values['username']=$inputVars['email'];
        $values['hashed']=password_hash($inputVars['password'], PASSWORD_DEFAULT);

        if ($result=$users->insert($values)){
            echo "Insertado:";
            die();
    
        }else{
            echo "Error";
            die();
        }
    }

    public function getSignIn($request, $response, $args){
        
         return $this->container->view->render($response, 'auth/signin.twig');
    }

    public function postSignIn($request, $response, $args){

        $inputVars= $request->getParsedBody();
        
        $auth=$this->attempt($inputVars['email'],$inputVars['password']);
 
        if($auth){
            
            return $response->withRedirect($this->container->router->pathFor('admin.home'));
        }else{
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }
              
    }

    private function attempt($username,$password){
        $usermodel = $this->container->get('UserModel');
        $user= $usermodel->findByUsername($username);
        if(!$user) return false;

        if(password_verify($password,$user->hashed)){
            //Generams el token y vamos a enviarlo a cookie
            $now = new DateTime();
            $future = new DateTime("now +1 year");
            //$server = $request->getServerParams();
            
            $jti = (new Base62)->encode(random_bytes(16));
    
            //recuperamos el scope del usuario autenticado
    
            $scope=$usermodel->getScope( $user->username );
    
            $payload = [
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "jti" => $jti,
                "sub" => $user->username ,
                "scope" => $scope
            ];
            
     
            $secret = getenv("JWT_SECRET");
            $token = JWT::encode($payload, $secret, "HS256");

             setcookie("token", $token, time()+3600,'/');
             //$_SESSION['user']= $user;
             return true;
        }else{
            return false;
        }
    }

}