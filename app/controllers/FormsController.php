<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use App\services\ApiProvider;
use DateTime;
session_start();

class FormsController {

    public static function Main(){

        /////////////////////////////STATEMENTS//////////////////////////////
        $apiProvider = new ApiProvider();

        /////////////////////////////GUARD////////////////////////////////////
        if (empty($_SESSION['userPlanning']))header('location: login');
        
        $refresh = $apiProvider->refresh($_SESSION['userPlanning']['data']['refresh_token']);
        if ( $refresh['code'] > 200) {header('location: login');die();}  
        $_SESSION['userPlanning']['token'] = $refresh['token']['token'];
        $user =  $apiProvider->getUser($_SESSION['userPlanning']['token']);
        $_SESSION['userPlanning'] = $user['data'];

        /////////////////////////////POST////////////////////////////////////
        if (!empty($_POST['select-absence'])) {
           
        }
       
        ////////////////////////////TEMPLATE/////////////////////////////////
        $templatesProvider = new TemplatesProvider();
        return $templatesProvider->provideTemplate()->render('forms.html.twig' , ['user' => $_SESSION['userPlanning']]);
    }


    ///////////////////////////////FUNCTIONS///////////////////////////////////
    public static function handleForms($select , $user){

        switch ($select) {
            case 'CP':
                $dateDepart = new DateTime($_POST['cpDate']);
                if (!empty($_POST['depart8']) && $_POST['depart8'] == '12' ) {
                    $dateDepart->modify('+13 hours');
                }else {$dateDepart->modify('+8 hours'); }
                $dateRetour = new DateTime($_POST['cpDateR']);
                if (!empty($_POST['depart8R']) && $_POST['depart8R'] == '12' ) {
                    $dateRetour->modify('+13 hours');
                }else {$dateRetour->modify('+8 hours'); }
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => $user['user__id'] , 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                break;
            case 'NP':
                # code...
                break;
            case 'MLD':
                # code...
                break;
            case 'INT':
                # code...
                break;
            case 'REC':
                # code...
                break;
            case 'TEL':
                # code...
                break;
            
        }

    }

    
}