<?php
namespace Sender;

use Sender\SmsClass;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class provide Promotional SMS APIs
 *
 * @package    Sender\PromotionalSms
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class PromotionalSms
{
    /**
     * @var string $promoAuthKey
     */
    protected $promoAuthKey;
    public function __construct($authkey = null)
    {
        $this->promoAuthKey = $authkey;
    }
    /**
     * Send promotional SMS MSG91 Service
     * @param  string $mobileNumber
     * @param  array  $data
     *
     * @return string
     */
    public static function sendPromotional($mobileNumber, $data)
    {
        $sms = new SmsClass();
        $promoAuthKey = $this->promoAuthKey;
        $response = $sms->smsCategory($mobileNumber, $data, 0, $promoAuthKey);
        return $response;
    }

    /**
     * Send Bulk promotional SMS MSG91 Service
     *
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     *
     * @return string
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
                for ($i = 0; $i < $arrayLength; $i++) {
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
