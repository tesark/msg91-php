<?php
namespace Sender;

use Sender\Deliver;
use Sender\SmsClass;
use Sender\MobileNumber;
use Sender\ParameterException;

/**
* this class for testing MSG91 Promotional SMS
*/

class PromotionalSms
{
    public function __construct()
    {
    }

    /**
    *  Send promotional SMS MSG91 Service
    * @param  $mobileNumber  string 954845**54
    * @param  $data          array
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendPromotional($mobileNumber, $data)
    {
        $sendData = array(

            'authkey'     => "170867ARdROqjKklk599a87a1",
            'route'       => 1,
        );
        $buildedProSmsData = SmsClass::buildSmsDataArray($mobileNumber, $data, $sendData);
        if ((sizeof($data)+3) == sizeof($buildedProSmsData)) {
            $uri      = "sendhttp.php";
            $response = Deliver::sendOtpGet($uri, $buildedProSmsData);
            var_dump($response);
            return $response;
        } else {
            throw ParameterException::missinglogic("Check parameters, something wrong");
        }
    }

    /**
    *  Send Bulk promotional SMS MSG91 Service
    *
    * @param  $data    string
    *
    * @return
    *
    * @throws error missing parameters or return empty
    */
    public function sendBulkSms($data)
    {
        if (is_array($data)) {
            $arrayLength = sizeof($data);
            if (isset($arrayLength) && $arrayLength == 1) {
                $currentArray = $data[0];
                $xmlDoc       = SmsClass::buildXmlData($currentArray);
                header("Content-Type: text/xml");
                //make the output pretty
                $xmlDoc->formatOutput = true;
                $xmlData  = $xmlDoc->saveXML();
                $uri      = "postsms.php";
                $response = Deliver::sendSmsPost($uri, $xmlData);
                var_dump($response);
                return $response;
            } else {
                for ($i=0; $i<$arrayLength; $i++) {
                    $response     = [];
                    $currentArray = $data[$i];
                    $xmlDoc       = SmsClass::buildXmlData($currentArray);
                    header("Content-Type: text/plain");
                    //make the output pretty
                    $xmlDoc->formatOutput = true;
                    $xmlData  = $xmlDoc->saveXML();
                    $uri      = "postsms.php";
                    $res = array_push($response, Deliver::sendSmsPost($uri, $xmlData));// doubt for response pending
                }
                var_dump($response);
                return $response;
            }
        } else {
            throw ParameterException::missinglogic("Check parameter is must be array.");
        }
    }
}
