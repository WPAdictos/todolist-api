<?php
namespace src\controllers;



class HomeController extends BaseController{

    public function index($request, $response, $args)
    {
        return $response->withJson(array('status'=>'API funcionando...'), 200);
    }

}