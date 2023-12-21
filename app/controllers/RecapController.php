<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use App\services\ApiProvider;
session_start();

class RecapController {

    public static function Main(){
        $apiProvider = new ApiProvider();
        $templatesProvider = new TemplatesProvider();

        ////////////////////////////GUARD////////////////////////////////////
        if (empty($_SESSION['userPlanning']))header('location: login');
        $refresh = $apiProvider->refresh($_SESSION['userPlanning']['data']['refresh_token']);
        if ( $refresh['code'] != 200) {header('location: login?alert=reconnexion exigée');die();}  
        $_SESSION['userPlanning']['token'] = $refresh['token']['token'];
        $user =  $apiProvider->getUser( $refresh['token']['token']);
        $_SESSION['userPlanning'] = $user['data'];
        $_SESSION['token'] = $refresh['token']['token'];
        ////////////////////////////////////////////////////////////////////
        
        $planning = json_decode($apiProvider->getPlanningUser($_SESSION['token'] , $_SESSION['userPlanning']['data']['user__id']),true);

        $planning = $planning['data'];
        
        return $templatesProvider->provideTemplate()->render('recap.html.twig' , [
            'planning' => json_encode($planning)
        ]);

    }
}