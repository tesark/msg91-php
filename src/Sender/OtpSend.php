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
    public  $otp;
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
        $otpAuthKey = null;
        $checkAuth = Validation::isAuthKey($this->otpAuth);
        if (!$checkAuth) {
            // Get Envirionment variable and config file values
            $config      = new ConfigClass();
            $container   = $config->getDefaults();
            $common      = $container['common'];
            $otpAuthKey  = $common['otpAuthKey'];
        }
        $data['authkey'] = $checkAuth ? $this->otpAuth : $otpAuthKey;
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
    {   $verifyAuth = $this->otpAuth;
        $otp        = new OtpClass();
        $verifyOtpResponse = $otp->otpApiCategory($mobileNumber, $oneTimePass, $verifyAuth, 1);
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
        $resendAuth = $this->otpAuth;
        $otp        = new OtpClass();
        $resendOtpResponse = $otp->otpApiCategory($mobileNumber, $retrytype, $resendAuth, 0);
        return $resendOtpResponse;
    }
}
