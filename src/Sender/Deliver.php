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
    /**
    *Send POST method
    * @param uri string
    * @param xml XMl string
    *
    * @return msg91 response json
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
            $response = $client->send($request);
            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
            $this->logger->error("Exception:", $e->getResponse(), $e->getRequest());
        }
    }
    /**
    *Send GET method
    * @param uri   string
    * @param query array
    *
    * @return msg91 response json
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
            $response = $client->send($request);
            // $this->addLogFile("response", $ResponseData);     //issue unable to log Response
            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
            $this->logger->error("Exception:", $e->getResponse(), $e->getRequest());
        }
    }
}
