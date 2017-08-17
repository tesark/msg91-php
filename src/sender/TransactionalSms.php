<?php
namespace sender;

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

            'authkey'     => "123456",
            'route'       => 4,
        );
        //this condition are check  this parameter are their added to sendData array
        for ($i = 0; $i<sizeof($data); $i++) {
            if (isset($mobileNumber)) {
                if (is_int($mobileNumber)) {
                    $sendData += ['mobile' => $mobileNumber];
                } elseif (is_string($mobileNumber)) {
                    $sendData += ['mobile' => $mobileNumber];
                }
            }
            if (array_key_exists("message", $data) && is_string($data["message"])) {
                $sendData += ['message' => $data["message"]];
            }
            if (array_key_exists("sender", $data)) {
                $sendData += ['sender' => $data["sender"]];
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
            return $sendData;
        } else {
            return false;
        }
    }
}
