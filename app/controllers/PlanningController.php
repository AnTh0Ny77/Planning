<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use App\services\ApiProvider;

class PlanningController {

    public static function Main(){

        $apiProvider = new ApiProvider();
        $planning = json_decode($apiProvider->getPlanning() , true);
      
        $planning = $planning['data'];
      
        
        
       
        $templatesProvider = new TemplatesProvider();
        return $templatesProvider->provideTemplate()->render('planning.html.twig' , [
            'planning' => json_encode($planning)
        ]);
    }
}