<?php
namespace Sender\Otp;

use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for send OTP
 *
 * @package    Sender\OtpSend
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class OtpSend extends OtpClass
{
   /**
     * This function for send OTP
     *
     * @param array $dataArray
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return string Msg91 Json response
     */
    public function sendOtp($dataArray, $data)
    {
        $this->inputData    = $dataArray;
        $this->sendData     = $data;
        if ($this->hasInputData() && $this->hasSendData()) {
            if ($this->checkAuthKey() && $this->checkMobile()) {
                $data = $this->sendData;
                //add sender on the Array
                $data = $this->addSender($data);
                //add otp_expiry on the array
                $data = $this->addOtpExpiry($data);
                //add otp_length on the array
                $data = $this->addOtpLength($data);
                $checkOtp = array_key_exists('otp', $this->inputData);
                $checkMsg = array_key_exists('message', $this->inputData);
                if ($checkOtp && $checkMsg) {
                    //add message on array
                    $data = $this->addMessage($data);
                    //add otp on the array
                    $data = $this->addOtp($data);
                }
                if (($checkOtp && !$checkMsg) || (!$checkOtp && $checkMsg)) {
                    throw ParameterException::missinglogic("When using otp or message, unable to use seperately");
                }
            }
            $uri = "sendotp.php";
            $delivery = new Deliver();
            $response = $delivery->sendOtpGet($uri, $data);
            return $response;
        } else {
            $message = "The wrong parameter found";
            throw ParameterException::missinglogic($message);
        }
    }
}