<?php
namespace sender;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

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
    public static function sendSmsPost($uri, $xml)
    {
        try {
            $value =  substr($xml,0);
            $xmlData = substr($value,0,-1);
            var_dump( $xmlData);
            $headers = ['Content-Type' => 'text/xml; charset=UTF8'];
            $client  = new Client();
            $request = new Request('POST', 'http://api.msg91.com/api/'.$uri, $headers, $xml);          
            $promise = $client->sendAsync($request)->then(function ($response) {
                // $responseArray = [];
                echo "----------------------";
                echo $response->getBody();
                echo $response->getStatusCode();
               
                // $responseArray += ['statusCode' => $response->getStatusCode()];
                // $responseArray += ['reasonPhrase' => $response->getReasonPhrase()];
                // $responseArray += ['body' => json_decode($response->getBody())];
                // $result        = json_encode($responseArray);
                // var_dump($result);
                return $result;
            });
        } catch (Exception $e) {
            echo $e;
        }
        // $promise = $this->client->requestAsync('POST', $uri, ['Content-Type' => 'text/xml; charset=UTF8'], $xml);
        // $result  = $this->callResponse($promise);
        // return $result;
    }
    //Send GET method
    public static function sendOtpGet($uri, $query)
    {
        try {
            $paramStr = "";
            $flag = 1;
            foreach ($query as $key => $value) {
                if ($flag) {
                    $paramStr .= '?'.$key .'='. urlencode(trim($value));
                    $flag = 0;
                } else {
                    $paramStr .=  "&" .  $key .'='. urlencode(trim($value));
                }
            }
            $headers = ['Content-Type' => 'application/json; charset=UTF8'];
            $client  = new Client();
            $request = new Request('GET', 'http://api.msg91.com/api/'.$uri.$paramStr, $headers);
            $promise = $client->sendAsync($request)->then(function ($response) {
                $responseArray = [];
                $responseArray += ['statusCode' => $response->getStatusCode()];
                $responseArray += ['reasonPhrase' => $response->getReasonPhrase()];
                $responseArray += ['body' => json_decode($response->getBody())];
                $result        = json_encode($responseArray);
                var_dump($result);
                return $result;
            });
        } catch (Exception $e) {
            echo $e;
        }
    }
}
