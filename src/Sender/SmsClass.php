<?php
namespace Sender;

use Sender\MobileNumber;
use Sender\Exception\ParameterException;

/**
*
*/
class SmsClass
{
    public static function buildSmsDataArray($mobileNumber, $data, $sendData)
    {
        $buildSmsData = $sendData;
        var_dump($buildSmsData);
        var_dump($data);
        //this condition are check  this parameter are their added to buildSmsData array
        for ($i = 0; $i<sizeof($data); $i++) {
            if (isset($mobileNumber)) {
                if (is_int($mobileNumber)) {
                    $buildSmsData += ['mobiles' => $mobileNumber];
                } elseif (is_string($mobileNumber)) {
                    $result = MobileNumber::isValidNumber($mobileNumber);
                    if ($result['value'] == true) {
                        $buildSmsData += ['mobiles' => $mobileNumber];
                    } else {
                        $message = "this number not the correct:__". $result['mobile'];
                        throw ParameterException::invalidInput("mobiles", "string", $mobileNumber, $message);
                    }
                } else {
                    $message = "interger or string comma seperate values";
                    throw ParameterException::invalidInput("mobiles", "string or integer", $mobileNumber, $message);
                }
            }
            if (array_key_exists("message", $data) && is_string($data["message"])) {
                if (!array_key_exists("unicode", $data)) {
                    if (strlen($data["message"]) <= 160) {
                        $buildSmsData += ['message' => $data["message"]];
                    } else {
                        $message = "allowed below 160 cheracters,but given length:_". strlen($data["message"]);
                        throw ParameterException::invalidInput("message", "string", $data["message"], $message);
                    }
                } elseif (array_key_exists("unicode", $data)) {
                    if (strlen($data["message"]) <= 70) {
                        $buildSmsData += ['message' => $data["message"]];
                    } else {
                        $message = "allowed below 70 cheracter using unicode, but given:__". strlen($data["message"]);
                        throw ParameterException::invalidInput("message", "string", $data["message"], $message);
                    }
                }
            }
            if (array_key_exists("sender", $data)) {
                if (is_string($data['sender'])) {
                    if (strlen($data['sender']) == 6) {
                        $buildSmsData += ['sender' => $data["sender"]];
                    } else {
                        $message = "String length must be 6 characters";
                        throw ParameterException::invalidInput("sender", "string", $data["sender"], $message);
                    }
                } else {
                    throw ParameterException::invalidArrtibuteType("message", "string", $data['sender']);
                }
            }
            if (array_key_exists("country", $data)) {
                if (is_numeric($data["country"])) {
                     $buildSmsData += ['country' => $data["country"]];
                } else {
                    throw ParameterException::invalidArrtibuteType("country", "numeric", $data["country"]);
                }
            }
            if (array_key_exists("flash", $data)) {
                $responseFormat =  array(0,1);
                $value = in_array($data["flash"], $responseFormat)? $data["flash"] : null;
                $buildSmsData += ['flash' => $value];
            }
            if (array_key_exists("unicode", $data)) {
                $responseFormat =  array(0,1);
                $value = in_array(strtolower($data["unicode"]), $responseFormat) ? $data["unicode"] : null;
                $buildSmsData += ['unicode' => $value];
            }
            if (array_key_exists("schtime", $data)) {
                $buildSmsData += ['schtime' => $data["schtime"]];
            }
            if (array_key_exists("afterminutes", $data)) {
                if (is_int($data["afterminutes"])) {
                    $buildSmsData += ['afterminutes' => $data["afterminutes"]];
                } else {
                    throw ParameterException::invalidArrtibuteType("afterminutes", "int", $data["afterminutes"]);
                }
            }
            if (array_key_exists("response", $data)) {
                if (is_string($data["response"])) {
                    $responseFormat =  array('xml','json');
                    $responseVal = strtolower($data["response"]);
                    $value = in_array($responseVal, $responseFormat) ? $responseVal:null;
                    $buildSmsData += ['response' => $value];
                } else {
                    throw ParameterException::invalidArrtibuteType("response", "string", $data["response"]);
                }
            }
            if (array_key_exists("campaign", $data)) {
                if (is_string($data["campaign"])) {
                    $buildSmsData += ['campaign' => $data["campaign"]];
                } else {
                    throw ParameterException::invalidArrtibuteType("campaign", "string", $data["campaign"]);
                }
            }
        }
        return $buildSmsData;
    }
    //build xml format
    public static function buildXmlData($xmlData)
    {
        $currentArray = $xmlData;
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
