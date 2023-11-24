<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;

class FormsController {

    public static function Main(){
       
        $templatesProvider = new TemplatesProvider();
        return $templatesProvider->provideTemplate()->render('forms.html.twig');
    }
}