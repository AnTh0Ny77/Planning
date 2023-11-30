<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use App\services\ApiProvider;
session_start();

class PlanningController {

    public static function Main(){
        $apiProvider = new ApiProvider();
        $templatesProvider = new TemplatesProvider();

        ////////////////////////////GUARD////////////////////////////////////
        if (empty($_SESSION['userPlanning']))header('location: login');

        $refresh = $apiProvider->refresh($_SESSION['userPlanning']['data']['refresh_token']);
        if ( $refresh['code'] > 200) {header('location: login');die();}  
        $_SESSION['userPlanning']['token'] = $refresh['token']['token'];
        $user =  $apiProvider->getUser($_SESSION['userPlanning']['token']);
        $_SESSION['userPlanning'] = $user['data'];
        ////////////////////////////////////////////////////////////////////

      
        $planning = json_decode($apiProvider->getPlanning(),true);
        $planning = $planning['data'];
        
        return $templatesProvider->provideTemplate()->render('planning.html.twig' , [
            'planning' => json_encode($planning)
        ]);
    }
}