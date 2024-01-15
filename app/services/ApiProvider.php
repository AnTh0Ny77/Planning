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


    public function getPlanning($token){
        $config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->prod;
		$env_uri = $config->api->env_prod;
		$client = new \GuzzleHttp\Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false) , 'http_errors' => false]);
		try {
			$response = $client->get(
				$env_uri . '/planning' , 
				['headers' => self::makeHeaders($token) ]
				
			);
		} catch (GuzzleHttp\Exception\ClientException $exeption) {
			$response = $exeption->getResponse();
			exit();
		}
		return $response->getBody()->read(12047878);
    }

	public function getPlanningUser($token , $id_user){
        $config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->prod;
		$env_uri = $config->api->env_prod;
		$client = new \GuzzleHttp\Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false) , 'http_errors' => false]);
		try {
			$response = $client->get(
				$env_uri . '/planning?user='.$id_user , 
				['headers' => self::makeHeaders($token) ]	
			);
		} catch (GuzzleHttp\Exception\ClientException $exeption) {
			$response = $exeption->getResponse();
			exit();
		}
		return $response->getBody()->read(12047878);
    }

	public function postAbsence($body , $token){
        $config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->prod;
		$env_uri = $config->api->env_prod;
		$client = new \GuzzleHttp\Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false) , 'http_errors' => false]);
		try {
			$response = $client->post(
				$env_uri . '/planning' , ['json' => $body  , 'headers' => self::makeHeaders($token) ]
				
			);
		} catch (GuzzleHttp\Exception\ClientException $exeption) {
			$response = $exeption->getResponse();
			exit();
		}
		
		return $response->getBody()->read(12047878);
    }

	public  function login($username, $password){

		$config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->prod;
		$env_uri = $config->api->env_prod;
		$client = new \GuzzleHttp\Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false) , 'http_errors' => false]);
		
		try {
			$response = $client->post($env_uri. '/login',  ['json' => ['user__mail' => $username, 'user__password' => $password]]);
			
		} catch (ClientException $exeption){
			$response = $exeption->getResponse();
		}
		
		$response = [
				'code' => $response->getStatusCode(),
				'data' => (array) json_decode($response->getBody()->read(16384), TRUE)
		];

		return $response;
	}

	public  function refresh($refreshToken){
		$config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->prod;
		$env_uri = $config->api->env_prod;
		$client = new Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false) , 'http_errors' => false]);

		try {
			$response = $client->post($env_uri .'/refresh',  ['json' => ['refresh_token' => $refreshToken]]);
		} catch (ClientException $exeption){
			$response = $exeption->getResponse();
		}
		return  $response =  [
			'code' => $response->getStatusCode(),
			'token' => (array) json_decode($response->getBody()->read(16384), TRUE)
		];
	}

	public function getUser($token){
		
		$config = json_decode(file_get_contents(__DIR__ . '/config.json'));
		$base_uri = $config->api->prod;
		$env_uri = $config->api->env_prod;
		$client = new \GuzzleHttp\Client(['base_uri' => $base_uri, 'curl' => array(CURLOPT_SSL_VERIFYPEER => false)]);
		
		try {
			$response = $client->get($env_uri. '/user' , ['headers' => self::makeHeaders($token) ] );
		} catch (ClientException $exeption){
			$response = $exeption->getResponse();
		}

		$response =  [
			'code' => $response->getStatusCode(),
			'data' => (array) json_decode($response->getBody()->read(16384), TRUE)
		];
		return $response;
	}



}