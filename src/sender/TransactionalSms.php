<?php
namespace sender;

use sender\Deliver;
use sender\MobileNumber;

/**
* This class for send MSG91 Transactional SMS
*/

class TransactionalSms
{
    public function __construct()
    {
    }

    /**
    *  Send transactional SMS MSG91 Service
    * @param  $mobileNumber  int OR string
    * @param  $data
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendTransactional($mobileNumber, $data)
    {
        //transactional SMS content
        $sendData = array(

            'authkey'     => "170436A8DCExM8m259969531",
            'route'       => 4,
        );
        //this condition are check  this parameter are their added to sendData array
        for ($i = 0; $i<sizeof($data); $i++) {
            if (isset($mobileNumber)) {
                if (is_int($mobileNumber)) {
                    $sendData += ['mobile' => $mobileNumber];
                } elseif (is_string($mobileNumber)) {

                    $result = MobileNumber::isValidNumber($mobileNumber);
                    if ($result['value'] == true){
                        $sendData += ['mobile' => $mobileNumber];
                    } else {
                        return $result['mobile'];
                    }                    
                }
            }
            if (array_key_exists("message", $data) && is_string($data["message"])) {
                if(!array_key_exists("unicode", $data) && strlen($data["message"]) <= 160 ) {
                    $sendData += ['message' => $data["message"]];
                }

                if(array_key_exists("unicode", $data) && strlen($data["message"]) <= 70) {
                    $sendData += ['message' => $data["message"]];
                }
            }
            if (array_key_exists("sender", $data)) {
                if (is_string($value)) {
                    if (strlen($value) == 6) {
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
            $response = Deliver::sendOtpGet($uri, $data);
            return $response;
        } else {
            return false;
        }
    }
}
