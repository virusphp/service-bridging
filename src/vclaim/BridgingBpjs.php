<?php

namespace Vclaim\Bridging;

use Vclaim\Bridging\GenerateBpjs;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Vclaim\Bridging\Bpjs;

class BridgingBpjs 
{
    use Bpjs;

	protected $client;

	public function __construct()
	{
		$this->client = new Client([
			'verify' => true,
			'cookie' => true,
		]);
	}

	public function getRequest($endpoint)
    {
        try {
            $url = $this->setServiceApi() . $endpoint;
            $response = $this->client->get($url, ['headers' => $this->setHeader()]);
            // return $response->getBody()->getContents();
            $result = GenerateBpjs::responseBpjsV2($response->getBody()->getContents(), $this->setKey());
            return $result;
        } catch (RequestException $e) {
            $result = $e->getRequest();
            if ($e->hasResponse()) {
                $result = $e->getResponse();
            }
        } 
    }

	public function postRequest($endpoint, $data)
    {
        $data = file_get_contents("php://input");
        try {
            $url = $this->setServiceApi() . $endpoint;
            $response = $this->client->post($url, ['headers' => $this->setHeaders(), 'body' => $data]);
			$result = GenerateBpjs::responseBpjsV2($response->getBody()->getContents(),$this->setKey());
            return $result;
        } catch (RequestException $e) {
            $result =$e->getRequest();
            if ($e->hasResponse()) {
                $result = $e->getResponse();
            }
        } 
    }

    public function putRequest($endpoint, $data)
    {
        $data = file_get_contents("php://input");
        try {
            $url = $this->setServiceApi() . $endpoint;
            $response = $this->client->put($url, ['headers' => $this->setHeaders(), 'body' => $data]);
<<<<<<< HEAD
			$result = GenerateBpjs::responseBpjsV2($response->getBody()->getContents(),$this->setKey());
=======
			$result = GenerateBpjs::responseBpjsV2($response->getBody()->getContents(), $this->key);
            return $result;
        } catch (RequestException $e) {
            $result =$e->getRequest();
            if ($e->hasResponse()) {
                $result = $e->getResponse();
            }
        } 
    }

     public function deleteRequest($endpoint, $data)
    {
        $data = file_get_contents("php://input");
        try {
            $url = $this->setServiceApi() . $endpoint;
            $response = $this->client->delete($url, ['headers' => $this->setHeaders(), 'body' => $data]);
            $result = GenerateBpjs::responseBpjsV2($response->getBody()->getContents(), $this->key);
>>>>>>> 7fbd6c926c3612b9352d47e4aa45b03c700bdd79
            return $result;
        } catch (RequestException $e) {
            $result =$e->getRequest();
            if ($e->hasResponse()) {
                $result = $e->getResponse();
            }
        } 
    }
}