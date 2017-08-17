<?php
namespace sender;

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

            'authkey'     => "123456",
            'route'       => 1,
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
        $dataArray = [];
        for ($i =0; $i< sizeof($data); $i++) {
            $bulkData = [
               'AUTHKEY' => '1234567890'
            ];
            $arraySet = $data[$i];

            if (isset($arraySet["sender"]) && is_string($arraySet['sender'])) {
                $bulkData += ['SENDER'=>$arraySet["sender"]];
            }
            if (isset($arraySet["scheduleDateTime"])) {
                $bulkData += ['SCHEDULE DATE TIME'=>$arraySet["scheduleDateTime"]];
            }
            if (isset($arraySet["flash"])) {
                $bulkData += ['FLASH'=> $arraySet["flash"]];
            }
            if (isset($arraySet["unicode"])) {
                $bulkData += ['UNICODE'=> $arraySet["unicode"]];
            }
            if (isset($arraySet["campaign"]) && is_string($arraySet['campaign'])) {
                $bulkData += ['CAMPAIGN'=> $arraySet["campaign"]];
            }
            if (isset($arraySet["countryCode"])) {
                $bulkData += ['COUNTRY'=> $arraySet["countryCode"]];
            }
            if (isset($arraySet["route"])) {
                $bulkData += ['ROUTE'=> $arraySet["route"]];
            }
            //mobile number Comma seperated string to Array
            if (isset($arraySet['message']) && is_string($arraySet['message'])) {
                $attributes = [];
                $attributes += ['TEXT'=> $arraySet["message"]];
                $content = [
                    '_attributes' => $attributes
                ];
                if (isset($arraySet["mobileNumbers"]) && is_int($arraySet['mobileNumbers'])) {
                    $content += ['ADDRESS'=>['_attributes'=> ['TO' => $arraySet["mobileNumbers"]]]];
                }
                $bulkData += ['SMS'=> $content];
            }
            array_push($dataArray, $bulkData);
        }
        for ($j=0; $j<sizeof($dataArray); $j++) {
            $result[]= ArrayToXml::convert($dataArray[$j], 'MESSAGE', false);
        }
        return $result;
    }
}
