<?php
use \Slim\Middleware\HttpBasicAuthentication\PdoAuthenticator;
use \Slim\Middleware\JwtAuthentication;


$container = $app->getContainer();

/*
Fuerza a entrar por https, configurable en el config.php
*/
if ($container['settings']['force_https'] === 'true'){
        $app->add(function ($request,   $response, $next) {
            if ($request->getUri()->getScheme() !== 'https') {
                $uri = $request->getUri()->withScheme("https")->withPort(null);  
                return $response->withRedirect( (string)$uri );
            } else {
                return $next($request, $response);
            }
        });
}

//Proveedor de http cache
$app->add(new \Slim\HttpCache\Cache('public', 86400));

// Gestion autenticacion para obtener el token
$container["HttpBasicAuthentication"] = function ($container) {
    $pdo=$container['pdo']; 
    return new \Slim\Middleware\HttpBasicAuthentication([
        "path" => ["/v1/token"],
        "realm" => "Protected",
        "secure" => true,
        "relaxed" => ["localhost"],
        "authenticator" => new PdoAuthenticator([
            "pdo" => $pdo,
            "table" => "accounts",
            "user" => "username",
            "hash" => "hashed"
        ]),
        "error" => function ($request, $response, $arguments) {
            return $response->withJson(array('error'=>'Credenciales incorrectas'), 403);
        }
        
    ]);
};
$app->add("HttpBasicAuthentication");

$container["JwtAuthentication"] = function ($container) {
    return new JwtAuthentication([
        "path" => "/v1/test",
        "passthrough" => ["/v1/token"],
        "secret" => getenv("JWT_SECRET"),
        //"logger" => $container["logger"],
        "attribute" => false,
        "relaxed" => ["localhost"],
        "error" => function ($request, $response, $arguments) {
            return $response->withJson(array('error'=>'No tiene autorizacion'), 401);
            //return new UnauthorizedResponse($arguments["message"], 401);
        },
        "callback" => function ($request, $response, $arguments) use ($container) {
            $container["token"]->save($arguments["decoded"]);
        }
    ]);
};
$app->add("JwtAuthentication");