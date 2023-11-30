<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use DateTime;

class FormsController {

    public static function Main(){

        $user = null;
        if (!empty($_POST['select-absence'])) {
            # code...
        }
       
        $templatesProvider = new TemplatesProvider();
        return $templatesProvider->provideTemplate()->render('forms.html.twig');
    }

    public static function handleForms($select , $user){

        switch ($select) {
            case 'CP':
                $dateDepart = new DateTime($_POST['cpDate']);
                if (!empty($_POST['depart8']) && $_POST['depart8'] == '12' ) {
                    $dateDepart->modify('+13 hours');
                }else {$dateDepart->modify('+8 hours'); }
                $body = [
                    'to__out' => $dateDepart->format('Y-m-d H:i:s'), 
                    'to__in' => $_POST['cpDateR'] , 
                    'to__motif' => $select , 
                    'to__info' => $_POST['motif'] , 
                    'to__abs_user' => $user['user__id'] , 
                    'to__abs_etat' => 'DEM' , 
                    'to__abs_dt' => '',

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