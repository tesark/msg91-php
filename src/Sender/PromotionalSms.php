<?php
namespace Sender;

use Sender\Sms\SmsBulk;
use Sender\Sms\SmsNormal;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class provide Promotional SMS APIs
 *
 * @package    Sender\PromotionalSms
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
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
    public function sendPromotional($mobileNumber, $data)
    {
        $sms = new SmsNormal();
        $promoAuthKey = $this->promoAuthKey;
        $data['mobile'] = $mobileNumber;
        $response = $sms->smsCategory($data, 0, $promoAuthKey);
        return $response;
    }

    /**
     * Send Bulk promotional SMS MSG91 Service
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return string
     */
    public function sendBulkSms($data)
    {
        if (is_array($data)) {
            $response = null;
            $arrayLength = sizeof($data);
            if (isset($arrayLength) && $arrayLength == 1) {
                $currentArray = $data[0];
                $sms          = new SmsBulk();
                $response     = $sms->buildAndSendXmlSms($currentArray);
            } else {
                for ($i = 0; $i < $arrayLength; $i++) {
                    $currentArray = $data[$i];
                    $sms          = new SmsBulk();
                    $response     = $sms->buildAndSendXmlSms($currentArray);
                }
            }
            return $response;
        } else {
            throw ParameterException::missinglogic("Check parameter is must be array.");
        }
    }
}
