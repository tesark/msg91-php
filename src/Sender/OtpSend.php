<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class provide OTP APIs
 *
 * @package    Sender\OtpSend
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class OtpSend
{
    /**
     * @var null|string $otpAuth
     */
    private $otpAuth;
    public function __construct($authkey = null)
    {
        $this->otpAuth = $authkey;
    }
    /**
     * Send OTP using MSG91 Service, you want to send OTP using this "sendOtp method"
     *
     * @param  int|string $mobileNumber
     * @param  array      $dataArray
     *
     * @return string MSG91 response
     */
    public function sendOtp($mobileNumber, $dataArray)
    {
        $data      = [];
        $checkAuth = Validation::checkAuthKey($this->otpAuth);
        if (!$checkAuth) {
            // Get Envirionment variable and config file values
            $config          = new ConfigClass();
            $container       = $config->getDefaults();
        }
        $data['authkey'] = $checkAuth ? $this->otpAuth : $container['common']['otpAuthKey'];
        $data['mobile']  = $mobileNumber;
        $otp             = new OtpClass();
        $response        = $otp->sendOtp($dataArray, $data);
        return $response;
    }
    /**
     * Verify OTP using MSG91 Service, you want to Verify OTP using this "verifyOtp method"
     *
     * @param  int $mobileNumber
     * @param  int $dataArray
     *
     * @return string MSG91 response
     */
    public function verifyOtp($mobileNumber, $oneTimePass)
    {   $otpAuthKey = $this->otpAuth;
        $verifyOtp  = new OtpClass();
        $verifyOtpResponse = $verifyOtp->otpApiCategory($mobileNumber, $oneTimePass, $otpAuthKey, 1);
        return $verifyOtpResponse;
    }
    /**
     * Resend OTP using MSG91 Service, you want to Resend OTP using this "verifyOtp method"
     *
     * @param  int $mobileNumber
     * @param  string $retrytype
     *
     * @return string MSG91 response
     */
    public function resendOtp($mobileNumber, $retrytype = null)
    {
        $otpAuthKey = $this->otpAuth;
        $resendOtp  = new OtpClass();
        $verifyOtpResponse = $verifyOtp->otpApiCategory($mobileNumber, $retrytype, $otpAuthKey, 0);
        return $verifyOtpResponse;
    }
}
