<?php 
namespace App\services;
require_once  '././vendor/autoload.php';
use \GuzzleHttp\Client;
use \GuzzleHttp\ClientException;


class ApiProvider {

	public static function makeHeaders($token){
		$headers = ['Authorization' => 'Bearer ' .$token, 'Accept' => 'application/json'];
		return $headers;
	}


    public  function getPlanning(){
        $config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->host;
		$env_uri = $config->api->env_uri;
		$client = new \GuzzleHttp\Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false)]);
		try {
			$response = $client->get(
				$env_uri . 'apiPlanning'
				
			);
		} catch (GuzzleHttp\Exception\ClientException $exeption) {
			$response = $exeption->getResponse();
			exit();
		}
		return $response->getBody()->read(12047878);
    }   

}