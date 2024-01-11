<?php
namespace App\controllers;
require_once  '././vendor/autoload.php';
use App\services\TemplatesProvider;
use App\services\ApiProvider;
use App\services\MailerServices;
use DateTime;
session_start();


class LogoutController {

    public static function Main(){

        session_start();
        session_unset();
        session_destroy();

       
        header('location: login');
        die();
    }

}