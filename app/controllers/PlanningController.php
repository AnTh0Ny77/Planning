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
        if ( $refresh['code'] != 200) {header('location: login?alert=reconnexion exigée');die();}  
        $_SESSION['userPlanning']['token'] = $refresh['token']['token'];
        $user =  $apiProvider->getUser( $refresh['token']['token']);
        $_SESSION['userPlanning'] = $user['data'];
        $_SESSION['token'] = $refresh['token']['token'];
        ////////////////////////////////////////////////////////////////////
        
        if (!empty($_POST['abs__id']) ) {      
            $body = [
                'cadre' => $_POST['cadre__id'] , 
                'abs__id' => $_POST['abs__id'] , 
                'motif' => $_POST['motif']
            ];
            $insert = json_decode($apiProvider->postAbsence($body ,$_SESSION['token']),true);  
        }

        $planning = json_decode($apiProvider->getPlanning( $_SESSION['token']),true);
        $planning = $planning['data'];

        return $templatesProvider->provideTemplate()->render('planning.html.twig' , [
            'planning' => json_encode($planning) , 
            'user' => $_SESSION['userPlanning']
        ]);

    }
}