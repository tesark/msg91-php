<?php
namespace sender;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception;
/**
* 
*/
class ClassName extends AnotherClass
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    //Send POST method 
    public function sendPost($url, $headers, $body) {
        
        $promise = $this->client->requestAsync('POST', $uri, ['Content-Type' => 'text/xml; charset=UTF8'], $xml);        
        return  $promise;
    }

    //Send GET method 
    public function sendGet($url){
       
       try {
            
            $request = $this->client->get($url,$query);            
            // Send the request and get the response
            $promise = $request->send();            
            $result  = $this->callResponse($promise);
            return $result; 

        } catch (Exception $e) {

            $this->logger->error($e);           
        }   

    }
    
    //Response Function
    protected function callResponse() {

        $promise->then(
            function (ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
            }
        );

    }


	
}
