<?php
require "vendor/autoload.php";
use App\controllers\PlanningController;
use App\controllers\LoginController;
use App\controllers\FormsController;
use App\controllers\LogoutController;
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
    case '/':
       echo  PlanningController::Main();
    break;

    case '/home':
        echo  PlanningController::Main();
     break;

    case '/login'.$get_data:
        echo  LoginController::Main();
     break;

    case '/forms':
        echo  FormsController::Main();
     break;

    case '/logout':
        echo  LogoutController::Main();
     break;
        
    default:
        PlanningController::Main();
    break;
}
/////////////////////////////////////