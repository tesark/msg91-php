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
    }
    //Send POST method 
    public function sendPost($uri, $body)
    {
        // $promise = $this->client->requestAsync('POST', $uri, ['Content-Type' => 'text/xml; charset=UTF8'], $xml);
        // $result  = $this->callResponse($promise);
        // return $result;
    }
    //Send GET method 
    public function sendOtpGet($uri, $query)
    {
       try {
            
            $paramStr = ""; 
            $flag = 1;         
            foreach ($query as $key => $value) 
            { 
                if ($flag) 
                { 
                    $paramStr .= '?'.$key .'='. urlencode(trim($value)); 
                    $flag = 0; 
                } 
                else 
                { 
                    $paramStr .=  "&" .  $key .'='. urlencode(trim($value)); 
                } 
            }   
            $headers = ['Content-Type' => 'application/json; charset=UTF8'];
            $client  = new Client();
            $request = new Request('GET', 'http://api.msg91.com/api/'.$uri.$paramStr,  $headers);
            $promise = $client->sendAsync($request)->then(function ($response) {                
                $statusCode   = $response->getStatusCode();
                $body         = $response->getBody();
                $reasonPhrase = $response->getReasonPhrase();
                $result       = json_encode( array('statusCode' => $statusCode, 'reasonPhrase' => $reasonPhrase, 'body' =>  (string) $body));
                return $result;
            });
            $promise->wait(); 

        } catch (Exception $e) {

            echo $e;
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
