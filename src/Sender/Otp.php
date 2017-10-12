<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
use Sender\Otp\OtpSend;
use Sender\Otp\OtpVerifyAndResend;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class provide OTP APIs
 *
 * @package    Sender\Otp
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class Otp
{
    /**
     * @var null|string $otpAuth
     */
    protected $otpAuth;
    /**
     * @var null|int $otp
     */
    public $otp;
    public function __construct($authkey = null)
    {
        $this->otpAuth = $authkey;
    }
    /**
     * This function for get Authkey from config file
     *
     *
     */
    public function getAuthkey($otpAuthKey)
    {
        if (!$otpAuthKey) {
            // Get Envirionment variable and config file values
            $config      = new ConfigClass();
            $container   = $config->getDefaults();
            $common      = $container['common'];
            $otpAuthKey  = $common['otpAuthKey'];
        }
        return $otpAuthKey;
    }
    /**
     * Send OTP using MSG91 Service, you want to send OTP using this "sendOtp method"
     *
     * @param int|string $mobileNumber
     * @param array $dataArray
     *
     * @return string MSG91 response
     */
    public function sendOtp($mobileNumber, $dataArray)
    {
        $data      = [];
        $checkAuth = Validation::isAuthKey($this->otpAuth);
        $otpAuthKey = $this->getAuthkey($checkAuth);
        $data['authkey'] = $checkAuth ? $this->otpAuth : $otpAuthKey;
        $data['mobile']  = $mobileNumber;
        $otp             = new OtpSend();
        $response        = $otp->sendOtp($dataArray, $data);
        return $response;
    }
    /**
     * Verify OTP using MSG91 Service, you want to Verify OTP using this "verifyOtp method"
     *
     * @param int $mobileNumber
     * @param int $dataArray
     *
     * @return string MSG91 response
     */
    public function verifyOtp($mobileNumber, $oneTimePass)
    {
        $checkAuth = Validation::isAuthKey($this->otpAuth);
        $otpAuthKey = $this->getAuthkey($checkAuth);
        $verifyAuth = $checkAuth ? $this->otpAuth : $otpAuthKey;
        $otp        = new OtpVerifyAndResend();
        $verifyOtpResponse = $otp->otpApiCategory($mobileNumber, $oneTimePass, $verifyAuth, 1);
        return $verifyOtpResponse;
    }
    /**
     * Resend OTP using MSG91 Service, you want to Resend OTP using this "verifyOtp method"
     *
     * @param int $mobileNumber
     * @param string $retrytype
     *
     * @return string MSG91 response
     */
    public function resendOtp($mobileNumber, $retrytype = null)
    {
        $checkAuth = Validation::isAuthKey($this->otpAuth);
        $otpAuthKey = $this->getAuthkey($checkAuth);
        $resendAuth = $checkAuth ? $this->otpAuth : $otpAuthKey;
        $otp        = new OtpVerifyAndResend();
        $resendOtpResponse = $otp->otpApiCategory($mobileNumber, $retrytype, $resendAuth, 0);
        return $resendOtpResponse;
    }
}
