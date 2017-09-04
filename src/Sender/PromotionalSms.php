<?php
namespace Sender;

use Sender\SmsClass;
use Sender\ParameterException;

/**
* This Class provide Promotional SMS APIs
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license    
*/

class PromotionalSms
{
    public function __construct()
    {
    }

    /**
    *  Send promotional SMS MSG91 Service
    * @param  $mobileNumber  string 954845**54
    * @param  $data array
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public static function sendPromotional($mobileNumber, $data)
    {
        $sendData = array(
            'authkey'     => "170867ARdROqjKklk599a87a1",
            'route'       => 1,
        );
        $sms = new SmsClass();
        $promotionalOuput = $sms->sendSms($mobileNumber, $data, $sendData);
        return $promotionalOuput;
    }

    /**
    *  Send Bulk promotional SMS MSG91 Service
    *
    * @param $data string
    *
    * @return
    *
    * @throws error missing parameters or return empty
    */
    public static function sendBulkSms($data)
    {
        if (is_array($data)) {
            $arrayLength = sizeof($data);
            if (isset($arrayLength) && $arrayLength == 1) {
                $currentArray = $data[0];
                $sms          = new SmsClass();
                $response     = $sms->sendXmlSms($currentArray);
                var_dump($response);
                return $response;
            } else {
                for ($i=0; $i<$arrayLength; $i++) {
                    $response     = [];
                    $currentArray = $data[$i];
                    $sms          = new SmsClass();
                    $response     = $sms->sendXmlSms($currentArray);
                }
                var_dump($response);
                return $response;
            }
        } else {
            throw ParameterException::missinglogic("Check parameter is must be array.");
        }
    }
}
