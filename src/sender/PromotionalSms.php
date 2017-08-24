<?php
namespace sender;

use sender\Deliver;
use sender\MobileNumber;
use AntiMattr\Xml\XmlBuilder;
use Spatie\ArrayToXml\ArrayToXml;

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
    public function sendPromotional($mobileNumber, array $data)
    {
        $sendData = array(

            'authkey'     => "170867ARdROqjKklk599a87a1",
            'route'       => 1,
        );
        //this condition are check  this parameter are their added to sendData array
        for ($i = 0; $i<sizeof($data); $i++) {
            if (isset($mobileNumber)) {
                if (is_int($mobileNumber)) {
                    $sendData += ['mobiles' => $mobileNumber];
                } elseif (is_string($mobileNumber)) {
                    $result = MobileNumber::isValidNumber($mobileNumber);
                    if ($result['value'] == true) {
                        $sendData += ['mobiles' => $mobileNumber];
                    } else {
                        return $result['mobile'];
                    }
                }
            }
            if (array_key_exists("message", $data) && is_string($data["message"])) {
                if (!array_key_exists("unicode", $data) && strlen($data["message"]) <= 160) {
                    $sendData += ['message' => $data["message"]];
                }
                if (array_key_exists("unicode", $data) && strlen($data["message"]) <= 70) {
                    $sendData += ['message' => $data["message"]];
                }
            }
            if (array_key_exists("sender", $data)) {
                if (is_string($data['sender'])) {
                    if (strlen($data['sender']) == 6) {
                        $sendData += ['sender' => $data["sender"]];
                    }
                }
            }
            if (array_key_exists("country", $data)) {
                $sendData += ['country' => $data["country"]];
            }
            if (array_key_exists("flash", $data)) {
                $responseFormat =  array(0,1);
                $value = in_array($data["flash"], $responseFormat)? $data["flash"] : null;
                $sendData += ['flash' => $value];
            }
            if (array_key_exists("unicode", $data)) {
                $responseFormat =  array(0,1);
                $value = in_array(strtolower($data["unicode"]), $responseFormat) ? $data["unicode"] : null;
                $sendData += ['unicode' => $value];
            }
            if (array_key_exists("schtime", $data)) {
                $sendData += ['schtime' => $data["schtime"]];
            }
            if (array_key_exists("afterminutes", $data) && is_int($data["afterminutes"])) {
                $sendData += ['afterminutes' => $data["afterminutes"]];
            }
            if (array_key_exists("response", $data) && is_string($data["response"])) {
                $responseFormat =  array('xml','json');
                $value = in_array(strtolower($data["response"]), $responseFormat) ? strtolower($data["response"]):null;
                $sendData += ['response' => $value];
            }
            if (array_key_exists("campaign", $data) && is_string($data["campaign"])) {
                $sendData += ['campaign' => $data["campaign"]];
            }
        }
        if ((sizeof($data)+3) == sizeof($sendData)) {
             $uri      = "sendhttp.php";
             $response = Deliver::sendOtpGet($uri, $sendData);
        } else {
            return false;
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
        //create the xml document
        $xmlDoc = new \DOMDocument();
        //create the root element
        $root = $xmlDoc->appendChild($xmlDoc->createElement("MESSAGE"));
        $arrayLength = sizeof($data);
        if ($arrayLength == 1) {
            $currentArray = $data[0];
            //check Auth
            if (array_key_exists('authkey', $currentArray) && is_string($currentArray['authkey'])) {
                //create a element
                $authTag = $root->appendChild($xmlDoc->createElement("authkey", $currentArray['authkey']));
            }
            //Check Sender
            if (array_key_exists("sender", $currentArray)) {
                if (is_string($currentArray['sender'])) {
                    if (strlen($currentArray['sender']) == 6) {
                        //create a element
                        $senderTag = $root->appendChild($xmlDoc->createElement("sender", $currentArray['sender']));
                    }
                }
            }
            if (array_key_exists("schtime", $currentArray)) {
                //create a element
                $senderTag = $root->appendChild($xmlDoc->createElement("scheduledatetime", $currentArray['schtime']));
            }
            if (array_key_exists("campaign", $currentArray) && is_string($currentArray["campaign"])) {
                //create a element
                $campaignTag = $root->appendChild($xmlDoc->createElement("campaign", $currentArray['campaign']));
            }
            if (array_key_exists("country", $currentArray)) {
                //create a element
                $countryTag = $root->appendChild($xmlDoc->createElement("country", $currentArray['country']));
            }
            if (array_key_exists("flash", $currentArray)) {
                $responseFormat =  array(0,1);
                $value = in_array($currentArray["flash"], $responseFormat)? $currentArray["flash"] : 0;
                $flashTag = $root->appendChild($xmlDoc->createElement("flash", $value));
            }
            if (array_key_exists("unicode", $currentArray)) {
                $responseFormat =  array(0,1);
                $value = in_array(strtolower($currentArray["unicode"]), $responseFormat) ? $currentArray["unicode"] : 0;
                $unicodeTag = $root->appendChild($xmlDoc->createElement("unicode", $value));
            }
            if (array_key_exists('content', $currentArray)) {
                $bulkSms      = $currentArray['content'];
                $lenOfBulkSms = sizeof($bulkSms);
                for ($j=0; $j< $lenOfBulkSms; $j++) {
                    $bulkCurrentArray =  $bulkSms[$j];
                    $smsTag = $root->appendChild($xmlDoc->createElement("sms"));
                    //check message legth
                    if (array_key_exists("message", $bulkCurrentArray) && is_string($bulkCurrentArray["message"])) {
                        if (!array_key_exists("unicode", $currentArray) && strlen($bulkCurrentArray["message"]) <= 160) {
                            $childAttr = $xmlDoc->createAttribute("text");
                            $childText = $xmlDoc->createTextNode($bulkCurrentArray['message']);
                            $smsTag->appendChild($childAttr)->appendChild($childText);
                        }
                        if (array_key_exists("unicode", $currentArray) && strlen($bulkCurrentArray["message"]) <= 70) {
                            $child = $xmlDoc->createTextNode($bulkCurrentArray['message']);
                            $smsTag->appendChild($xmlDoc->createAttribute("text"))->appendChild($child);
                        }
                    }
                    //check mobile contents
                    if (is_string($bulkCurrentArray['mobile'])) {
                        $mobileArray = MobileNumber::isValidNumber($bulkCurrentArray['mobile']);
                        $mobiles     = $mobileArray['Mobiles'];
                        for ($k=0; $k<sizeof($mobileArray); $k++) {
                            $addressTag = $smsTag->appendChild($xmlDoc->createElement("address"));
                            $childAttr = $xmlDoc->createAttribute("to");
                            $childText = $xmlDoc->createTextNode($mobiles[$k]);
                            $addressTag->appendChild($childAttr)->appendChild($childText);
                        }
                    }
                }
            }
            header("Content-Type: text/plain");
            //make the output pretty
            $xmlDoc->formatOutput = true;
            $xml     = $xmlDoc->saveXML();
            var_dump($xml);
            $uri      = "postsms.php";
            $response = Deliver::sendSmsPost($uri, $xml);
            return $response;
        }
    }
}
