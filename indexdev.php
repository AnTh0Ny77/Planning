<?php
require "vendor/autoload.php";
use App\controllers\PlanningController;
use App\controllers\LoginController;
use App\controllers\FormsController;
use App\controllers\RecapController;
//////////// GET PARAMS /////////////
$request = $_SERVER['REQUEST_URI'];
$get_request = explode('?' ,$request, 2);
if (isset($get_request[1])) {$get_data = '?' . $get_request[1];} else { $get_data = ""; }
$get_request = explode('?' ,$request, 2);
if (isset($get_request[1])) {  $get_data = '?' . $get_request[1]; } else {$get_data = "";}
$REQUEST = $get_request[0] . $get_data ; 
////////////// ROUTES //////////////
switch ($REQUEST) {
    case '/Planning/':
       echo  PlanningController::Main();
    break;

    case '/Planning/home':
        echo  PlanningController::Main();
     break;

    case '/Planning/login'.$get_data:
        echo  LoginController::Main();
     break;

    case '/Planning/forms':
        echo  FormsController::Main();
     break;

    
    default:
        PlanningController::Main();
    break;
}
/////////////////////////////////////