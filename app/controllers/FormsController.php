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
        $templatesProvider = new TemplatesProvider();
        /////////////////////////////GUARD////////////////////////////////////
        if (empty($_SESSION['userPlanning']))header('location: login');
        $refresh = $apiProvider->refresh($_SESSION['userPlanning']['data']['refresh_token']);
        if ( $refresh['code'] != 200) {header('location: login?alert=reconnexion exigée');die();}  
        $_SESSION['userPlanning']['token'] = $refresh['token']['token'];
        $user =  $apiProvider->getUser( $refresh['token']['token']);
        $_SESSION['userPlanning'] = $user['data'];
        $_SESSION['token'] = $refresh['token']['token'];
        /////////////////////////////POST////////////////////////////////////
        if (!empty($_POST['select-absence'])) {
           $body = self::handleForms($_POST['select-absence']);
           $insert = json_decode($apiProvider->postAbsence($body ,$_SESSION['token']),true);
           header('location: home');
           die();
        }
        ////////////////////////////TEMPLATE/////////////////////////////////
        return $templatesProvider->provideTemplate()->render('forms.html.twig' , ['user' => $_SESSION['userPlanning']]);
    }

    ///////////////////////////////FUNCTIONS///////////////////////////////////
    public static function handleForms($select ){
        switch ($select) {
            case 'CP':
               // Assuming $_POST['cpDate'] and $_POST['cpDateR'] contain valid date strings
                $dateDepart = new DateTime($_POST['cpDate']);
                if (!empty($_POST['depart8']) && $_POST['depart8'] == '12') {
                    $dateDepart->setTime(13, 45, 0);   
                } else {
                    $dateDepart->setTime(8, 0, 0);  
                }
                $dateRetour = new DateTime($_POST['cpDateR']);
                if (!empty($_POST['depart8R']) && $_POST['depart8R'] == '12') {
                    $dateRetour->setTime(13, 45, 0);
                } else {
                    $dateRetour->setTime(8, 0, 0);
                }
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => 11, 
                    'to__user' =>11 ,
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                return $body;
                break;
            case 'NP':
                
                $format = 'Y-m-d H-i';
                $dateDepart = $_POST['npDate'];
                $dateDepart = DateTime::createFromFormat($format, $dateDepart);
                $dateRetour = $_POST['npDateR'];
                $dateRetour = DateTime::createFromFormat($format,  $dateRetour);
                
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => 7, 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                return $body;
                break;
            case 'MLD':
                
                $format = 'Y-m-d H-i';
                $dateDepart = $_POST['malDate'];
                $dateDepart = DateTime::createFromFormat($format, $dateDepart);
                $dateRetour = $_POST['malDateR'];
                $dateRetour = DateTime::createFromFormat($format,  $dateRetour);
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => 7, 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                return $body;
                break;
            case 'INT':
                $format = 'Y-m-d H-i';
                $dateDepart = $_POST['intDate'];
                $dateDepart = DateTime::createFromFormat($format, $dateDepart);
                $dateRetour = $_POST['intDateR'];
                $dateRetour = DateTime::createFromFormat($format,  $dateRetour);
                
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => 7, 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                return $body;
                break;
            case 'RCU':
                $format = 'Y-m-d H-i';
                $dateDepart = $_POST['recDate'];
                $dateDepart = DateTime::createFromFormat($format, $dateDepart);
                $dateRetour = $_POST['recDateR'];
                $dateRetour = DateTime::createFromFormat($format,  $dateRetour);
              
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => 7, 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                return $body;
                break;
            case 'TT':
                
                $dateDepart = new DateTime($_POST['recDate']);
                $dateRetour = new DateTime($_POST['recDateR']);
                // Assuming $_POST['cpDate'] and $_POST['cpDateR'] contain valid date strings
               
                if (!empty($_POST['depart8m']) && $_POST['depart8m'] == '12') {
                    $dateDepart->setTime(13, 45, 0);   
                } else {
                    $dateDepart->setTime(8, 0, 0);  
                }

                if (!empty($_POST['depart8Rm']) && $_POST['depart8Rm'] == '12') {
                    $dateRetour->setTime(13, 45, 0);
                } else {
                    $dateRetour->setTime(8, 0, 0);
                }
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $dateRetour->format('Y-m-d H:i:s') , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => 7, 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => date('Y-m-d H:i:s'),
                ];
                return $body;
                break;
        }

    }

    
}