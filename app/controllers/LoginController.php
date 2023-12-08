<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use App\services\ApiProvider;
session_start();

class LoginController {

    public static function Main(){
        header('location: home');
        die();
        if (!empty($_POST['email'])) {
            $apiProvider = new ApiProvider();
            $user = $apiProvider->login('test@test.fr' , 'test');
            $alert = null ;
            if ($user['code'] != 200) {
				$alert = 'identifiants invalides';
			}else{
                $refresh = $apiProvider->refresh($user['data']['refresh_token']);
                if ( $refresh['code'] > 200) {header('location: login');die();}
               
                $_SESSION['userPlanning']['token'] = $refresh['token']['token'];
                $user =  $apiProvider->getUser($_SESSION['userPlanning']['token']);
               
                $_SESSION['userPlanning'] = $user['data']['data'];
                header('location: home');
                die();
            }
        }

        $templatesProvider = new TemplatesProvider();
        return $templatesProvider->provideTemplate()->render('login.html.twig' , [
            'alert' => $alert
        ]);
    }
}