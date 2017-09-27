<?php
namespace Sender\Sms;

use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for Send Normal SMS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class SmsNormal extends SmsBuildClass
{
    /**
     * This function Category to send SMS
     * @param  int|string $mobileNumber
     * @param  array $data
     * @param  int $category
     * @param  string $authKey
     *
     * @return string
     */
    public function smsCategory($data, $category, $authKey)
    {
        $transAuthKey = null;
        $promoAuthKey = null;
        $checkAuth = Validation::isAuthKey($authKey);
        if (!$checkAuth) {
            // Get Envirionment variable and config file values
            $config          = new ConfigClass();
            $container       = $config->getDefaults();
            $commonValue     = $container['common'];
            $transAuthKey    = $commonValue['transAuthKey'];
            $promoAuthKey    = $commonValue['promoAuthKey'];
        }
        if ($category === 1) {
            //transactional SMS content
            $sendData = array(
                'authkey'     => $checkAuth ? $authKey : $transAuthKey,
                'route'       => 4,
            );
        } else {
            $sendData = array(
                'authkey'     => $checkAuth ? $authKey : $promoAuthKey,
                'route'       => 1,
            );
        }
        $output = $this->sendSms($data, $sendData);
        return $output;
    }
    /**
     * This function for call All possible parameter added to send array
     * @param string|int $mobileNumber
     * @param array $data
     * @param array $sendData
     *
     * @throws ParameterException missing parameters or type error
     * @return string
     */
    protected function sendSms($data, $sendData)
    {
        $this->inputData   = $data;
        $this->sendSmsData = $sendData;
        //this condition are check and parameters are added to buildSmsData array
        if ($this->hasMobileNumber() && $this->hasData() && $this->hasSendData()) {
            $buildSmsData = $sendData;
            $buildSmsData = $this->addAllParameters($buildSmsData);
            $response = $this->send($data, $buildSmsData);
            return $response;
        } else {
            $message = "parameters Missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * This function Used for Added available Parameter on Array
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function addAllParameters($buildSmsData)
    {
        $buildSmsData = $this->addMobile($buildSmsData, 1);
        $buildSmsData = $this->addMessage($buildSmsData, 1); // no 1 for using GET method
        $buildSmsData = $this->addSender($buildSmsData, 1);
        $buildSmsData = $this->addCountry($buildSmsData, 1);
        $buildSmsData = $this->addFlash($buildSmsData, 1);
        $buildSmsData = $this->addUnicode($buildSmsData, 1);
        $buildSmsData = $this->addSchtime($buildSmsData, 1);
        $buildSmsData = $this->addAfterMinutes($buildSmsData, 1);
        $buildSmsData = $this->addResponse($buildSmsData, 1);
        $buildSmsData = $this->addCampaign($buildSmsData, 1);
        return $buildSmsData;
    }
    /**
     * This function use SMS data to Deliver Class
     * @param array $data
     * @param array $buildSmsData
     *
     * @throws ParameterException missing parameters or type error
     * @return string
     */
    protected function send($data, $buildSmsData)
    {
        $inputDataLen = Validation::getSize($data);
        $buildDataLen = Validation::getSize($buildSmsData);
        if ($inputDataLen+2 == $buildDataLen) {
            $uri      = "sendhttp.php";
            $delivery = new Deliver();
            $response = $delivery->sendOtpGet($uri, $buildSmsData);
            return $response;
        } else {
            throw ParameterException::missinglogic("Check Input parameters, something wrong");
        }
    }
}
