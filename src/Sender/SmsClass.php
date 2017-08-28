<?php
namespace Sender;

use Sender\MobileNumber;
use Sender\Exception\InvalidParameterException;

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
                        throw InvalidParameterException::invalidInput("mobiles", "string", $mobileNumber, $message);
                    }
                } else {
                    $message = "interger 1 mobileNumber, string comma seperate mobile values";
                    throw InvalidParameterException::invalidInput("mobiles", "string or integer", $mobileNumber, $message);
                } 
            }
            if (array_key_exists("message", $data) && is_string($data["message"])) {
                if (!array_key_exists("unicode", $data)) {
                    if (strlen($data["message"]) <= 160) {
                        $buildSmsData += ['message' => $data["message"]];
                    } else {
                        $message = "message allowed only below 160 cheracter, but given length:__". strlen($data["message"]);
                        throw InvalidParameterException::invalidInput("message", "string", $data["message"], $message);
                    }
                } elseif (array_key_exists("unicode", $data)) {
                    if(strlen($data["message"]) <= 70) {
                        $buildSmsData += ['message' => $data["message"]];
                    } else {
                        $message = "message allowed only below 70 cheracter because you choose unicode, but given:__". strlen($data["message"]);
                        throw InvalidParameterException::invalidInput("message", "string", $data["message"], $message);
                    }
                }    
            }
            if (array_key_exists("sender", $data)) {
                if (is_string($data['sender'])) {
                    if (strlen($data['sender']) == 6) {
                        $buildSmsData += ['sender' => $data["sender"]];
                    } else {
                        throw InvalidParameterException::invalidInput("sender", "string", $data["sender"], "String length must be 6 characters");
                    }
                } else {
                    throw InvalidParameterException::invalidArrtibuteType("message", "string", $data['sender']);
                }
            }
            if (array_key_exists("country", $data)) {
                if (is_numeric($data["country"])) {
                     $buildSmsData += ['country' => $data["country"]];
                } else {
                    throw InvalidParameterException::invalidArrtibuteType("country", "numeric", $data["country"]);
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
                    throw InvalidParameterException::invalidArrtibuteType("afterminutes", "int", $data["afterminutes"]);
                }
            }
            if (array_key_exists("response", $data)) {
                if (is_string($data["response"])) {
                    $responseFormat =  array('xml','json');
                    $value = in_array(strtolower($data["response"]), $responseFormat) ? strtolower($data["response"]):null;
                    $buildSmsData += ['response' => $value];
                } else {
                    throw InvalidParameterException::invalidArrtibuteType("response", "string", $data["response"]);
                }
            }
            if (array_key_exists("campaign", $data)) {
                if (is_string($data["campaign"])) {
                    $buildSmsData += ['campaign' => $data["campaign"]];
                } else {
                    throw InvalidParameterException::invalidArrtibuteType("campaign", "string", $data["campaign"]);
                }
            }
        }
        return $buildSmsData;
    }
}