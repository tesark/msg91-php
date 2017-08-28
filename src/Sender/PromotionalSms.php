<?php
namespace Sender;

use Sender\Deliver;
use Sender\SmsClass;
use Sender\MobileNumber;

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
             return $response;
        } else {
            throw InvalidParameterException::missinglogic("Check second parameter, correct or wrong");
        }
    }

    /**
    *  Send Bulk promotional SMS MSG91 Service
    * @param  $mobile  string 954845**54
    * @param  $data    string
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendBulkSms($data)
    {
        $arrayLength = sizeof($data);
        if (isset($arrayLength) && $arrayLength == 1) {
            $currentArray = $data[0];
            $xmlDoc       = self::xmlBuild($currentArray);
            header("Content-Type: text/xml");
            //make the output pretty
            $xmlDoc->formatOutput = true;
            $xmlData  = $xmlDoc->saveXML();
            $uri      = "postsms.php";
            $response = Deliver::sendSmsPost($uri, $xmlData);
            return $response;
        } else {
            for ($i=0; $i<$arrayLength; $i++) {
                $response     = [];
                $currentArray = $data[$i];
                $xmlDoc       = self::xmlBuild($currentArray);
                header("Content-Type: text/plain");
                //make the output pretty
                $xmlDoc->formatOutput = true;
                $xmlData  = $xmlDoc->saveXML();
                $uri      = "postsms.php";
                $res = array_push($response, Deliver::sendSmsPost($uri, $xmlData));// doubt for response pending
            }
            return $response;
        }
    }
    // bulid xml formated data
    protected function xmlBuild($currentArray)
    {
        //create the xml document
        $xmlDoc = new \DOMDocument();
        //create the root element
        $root = $xmlDoc->appendChild($xmlDoc->createElement("MESSAGE"));
        //check Auth
        if (array_key_exists('authkey', $currentArray) && is_string($currentArray['authkey'])) {
            //create a element
            $authTag = $root->appendChild($xmlDoc->createElement("AUTHKEY", $currentArray['authkey']));
        }
        //Check Sender
        if (array_key_exists("sender", $currentArray)) {
            if (is_string($currentArray['sender'])) {
                if (strlen($currentArray['sender']) == 6) {
                    //create a element
                    $senderTag = $root->appendChild($xmlDoc->createElement("SENDER", $currentArray['sender']));
                }
            }
        }
        if (array_key_exists("schtime", $currentArray)) {
            //create a element
            $senderTag = $root->appendChild($xmlDoc->createElement("SCHEDULEDATETIME", $currentArray['schtime']));
        }
        if (array_key_exists("campaign", $currentArray) && is_string($currentArray["campaign"])) {
            //create a element
            $campaignTag = $root->appendChild($xmlDoc->createElement("CAMPAIGN", $currentArray['campaign']));
        }
        if (array_key_exists("country", $currentArray)) {
            //create a element
            $countryTag = $root->appendChild($xmlDoc->createElement("COUNTRY", $currentArray['country']));
        }
        if (array_key_exists("flash", $currentArray)) {
            $responseFormat =  array(0,1);
            $value = in_array($currentArray["flash"], $responseFormat)? $currentArray["flash"] : 0;
            $flashTag = $root->appendChild($xmlDoc->createElement("FLASH", $value));
        }
        if (array_key_exists("unicode", $currentArray)) {
            $responseFormat =  array(0,1);
            $value = in_array(strtolower($currentArray["unicode"]), $responseFormat) ? $currentArray["unicode"] : 0;
            $unicodeTag = $root->appendChild($xmlDoc->createElement("UNICODE", $value));
        }
        if (array_key_exists('content', $currentArray)) {
            $bulkSms      = $currentArray['content'];
            $lenOfBulkSms = sizeof($bulkSms);
            for ($j=0; $j< $lenOfBulkSms; $j++) {
                $bulkCurrentArray =  $bulkSms[$j];
                $smsTag = $root->appendChild($xmlDoc->createElement("SMS"));
                //check message legth
                if (array_key_exists("message", $bulkCurrentArray) && is_string($bulkCurrentArray["message"])) {
                    if (!array_key_exists("unicode", $currentArray) && strlen($bulkCurrentArray["message"]) <= 160) {
                        $childAttr = $xmlDoc->createAttribute("TEXT");
                        $childText = $xmlDoc->createTextNode($bulkCurrentArray['message']);
                        $smsTag->appendChild($childAttr)->appendChild($childText);
                    }
                    if (array_key_exists("unicode", $currentArray) && strlen($bulkCurrentArray["message"]) <= 70) {
                        $child = $xmlDoc->createTextNode($bulkCurrentArray['message']);
                        $smsTag->appendChild($xmlDoc->createAttribute("TEXT"))->appendChild($child);
                    }
                }
                //check mobile contents
                if (is_string($bulkCurrentArray['mobile'])) {
                    $mobileArray = MobileNumber::isValidNumber($bulkCurrentArray['mobile']);
                    $mobiles     = $mobileArray['Mobiles'];
                    for ($k=0; $k <sizeof($mobiles); $k++) {
                        $addressTag = $smsTag->appendChild($xmlDoc->createElement("ADDRESS"));
                        $childAttr = $xmlDoc->createAttribute("TO");
                        $childText = $xmlDoc->createTextNode($mobiles[$k]);
                        $addressTag->appendChild($childAttr)->appendChild($childText);
                    }
                }
            }
        }
        return $xmlDoc;
    }
}
