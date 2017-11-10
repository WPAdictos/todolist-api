<?php
namespace src\controllers;
use src\controllers\BaseController;
use Firebase\JWT\JWT;
use Tuupola\Base62;
use DateTime;


final class HomeController extends BaseController{
    // Constantes para definir los permisos de accesoa  nivel de acciones /rutas
    const PERM_FULL = 5;
    const PERM_DELETE = 4;
    const PERM_ADD = 3;
    const PERM_EDIT = 2;
    const PERM_SELECT = 1;
    const PERM_NONE = 0;

    public function index($request, $response, $args)
    {
        print_r($_COOKIE);
        die();
        return $response->withJson(array('status'=>'API funcionando...'), 200);
    }

    public function  test ($request, $response, $args){
        
        if($this->hasScope(array('area'=>'todo','scope'=>self::PERM_SELECT))){
            return "HomeController::test";
        }else{
            return $response->withJson(array('error'=>'No tiene autorizacion'), 401);
        }        
    }
    
    public function token ($request, $response, $args){
        $now = new DateTime();
        $future = new DateTime("now +1 year");
        $server = $request->getServerParams();
        
        $jti = (new Base62)->encode(random_bytes(16));

        //recuperamos el scope del usuario autenticado
        $user= $this->container->get('UserModel');
        $scope=$user->getScope( $server["PHP_AUTH_USER"]);

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => $server["PHP_AUTH_USER"],
            "scope" => $scope
        ];
        
 
        $secret = getenv("JWT_SECRET");
        $token = JWT::encode($payload, $secret, "HS256");
        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();
        $data["status"] ="Ok";

    
        return $response->withJson($data, 201);
    }

    public function mw ($request, $response, $args){

        return "HomeController::mw";
    }
}