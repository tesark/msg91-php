<?php
namespace Sender;

use Sender\Log\Log;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;

/**
* This Class for send data using GET and POST method
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class Deliver
{
    protected $client;
    protected $logger;
    public function __construct()
    {
        $this->logger = new Log("Req & Res");
    }
    /*
    *Send POST method
    *
    *
    */
    public function sendSmsPost($uri, $xml)
    {
        try {
            $value   =  substr($xml, 0);
            $xmlData =  substr($value, 0, -1);
            $this->logger->info("Request:", $xml, $uri);
            var_dump($xmlData);
            $headers = ['Content-Type' => 'text/xml; charset=UTF8'];
            $client  = new Client();
            $request = new Request('POST', 'http://api.msg91.com/api/'.$uri, $headers, $xml);
            $promise = $client->sendAsync($request)->then(function ($response) {
                $this->logger->info("Response:", $response->getStatusCode(), $response->getBody());
                // $responseArray = [];
                echo $response->getBody();
                echo $response->getStatusCode();
                // $responseArray += ['statusCode' => $response->getStatusCode()];
                // $responseArray += ['reasonPhrase' => $response->getReasonPhrase()];
                // $responseArray += ['body' => json_decode($response->getBody())];
                // $result        = json_encode($responseArray);
                var_dump($result);
                return $result;
            });
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
    /*
    *Send GET method
    *
    *
    */
    public function sendOtpGet($uri, $query)
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
            $this->logger->info("Request:", $query, $uri);
            $headers = ['Content-Type' => 'application/json; charset=UTF8'];
            $client  = new Client();
            $request = new Request('GET', 'http://api.msg91.com/api/'.$uri.$paramStr, $headers);
            $promise = $client->sendAsync($request)->then(function ($response) {
                $responseArray = [];
                $responseArray += ['statusCode' => $response->getStatusCode()];
                $responseArray += ['reasonPhrase' => $response->getReasonPhrase()];
                $responseArray += ['body' => json_decode($response->getBody())];
                $result        =  json_encode($responseArray);
                $this->logger->info("Response:", $responseArray);
                var_dump($result);
                return $result;
            });
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
}
