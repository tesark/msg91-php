<?php
namespace Sender;

use Sender\SmsClass;
use Sender\Config\MyConfig;
use Sender\ParameterException;

/**
* This Class provide Promotional SMS APIs
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class PromotionalSms extends MyConfig
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
        // Get Envirionment variable and config file values
        $Config    = new MyConfig();
        $container = $Config->getDefaults();
        var_dump($container['common']['promoAuthKey']);
        var_dump($container['promotionalSms']);
        $sendData = array(
            'authkey'     => $container['common']['promoAuthKey'],
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
