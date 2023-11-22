<?php
namespace App\services;
require_once  '././vendor/autoload.php';

class TemplatesProvider {

    public function provideTemplate(){
       
		$loader = new \Twig\Loader\FilesystemLoader('././public/templates/');
       	$twig = new \Twig\Environment($loader, [
           'debug' => true,
           'cache' => false,
       	]);
       	$twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
	}

}