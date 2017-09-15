<?php
namespace Sender;

use Sender\SmsClass;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

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
    private $promoAuthKey;
    public function __construct($authkey = null)
    {
       $this->promoAuthKey = $authkey;
    }
    /**
    *  Send promotional SMS MSG91 Service
    * @param  $mobileNumber  string 954845**54
    * @param  $data array
    *
    * @return $response
    *
    * @throws error missing parameters or return empty
    */
    public static function sendPromotional($mobileNumber, $data)
    {
        $checkAuth = Validation::checkAuthKey($this->promoAuthKey);
        if (!$checkAuth) {
           // Get Envirionment variable and config file values
           $config          = new ConfigClass();
           $container       = $config->getDefaults(); 
        }
        $sendData = array(
            'authkey'     => $checkAuth ? $this->promoAuthKey : $container['common']['otpAuthKey'],
            'route'       => 1,
        );
        $sms = new SmsClass();
        $response = $sms->sendSms($mobileNumber, $data, $sendData);
        return $response;
    }

    /**
    *  Send Bulk promotional SMS MSG91 Service
    *
    * @param $data string
    *
    * @return $response
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
            } else {
                for ($i=0; $i<$arrayLength; $i++) {
                    $currentArray = $data[$i];
                    $sms          = new SmsClass();
                    $response     = $sms->sendXmlSms($currentArray);
                }
            }
            return $response;
        } else {
            throw ParameterException::missinglogic("Check parameter is must be array.");
        }
    }
}
