<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;

class LoginController {

    public static function Main(){
       
        $templatesProvider = new TemplatesProvider();
        return $templatesProvider->provideTemplate()->render('login.html.twig');
    }
}