<?php
namespace sender;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception;

/**
* This Class for send data using GET and POST method
*/

class Deliver
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    //Send POST method 
    public function sendPost($url, $body)
    {
        $promise = $this->client->requestAsync('POST', $url, ['Content-Type' => 'text/xml; charset=UTF8'], $xml);
        $result  = $this->callResponse($promise);
        return $result;
    }
    //Send GET method 
    public function sendGet($url, $query)
    {
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
    protected function callResponse()
    {
        $promise->then(
            function (ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
            }
        );
    }
}
