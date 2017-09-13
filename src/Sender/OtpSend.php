<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
use Sender\Config\Config as ConfigClass;
use Sender\Exception\ParameterException;

/**
* This Class provide OTP APIs
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license
*/

class OtpSend
{   
    private $otpAuth;
    public function __construct($authkey = null)
    {
       $this->otpAuth = $authkey;
    }

    /**
    *  Send OTP using MSG91 Service, you want to send OTP using this "sendOtp method"
    *
    * @param  $mobileNumber Numeric
    * @param  $dataArray    Array
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    //Method for send OTP
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
    *  Verify OTP using MSG91 Service, you want to Verify OTP using this "verifyOtp method"
    *
    * @param  $mobileNumber int
    * @param  $dataArray    int
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function verifyOtp($mobileNumber, $oneTimePass)
    {
        $checkAuth = '';
        $data      = [];
        $checkAuth = Validation::checkAuthKey($this->otpAuth);
        if (!$checkAuth) {
           // Get Envirionment variable and config file values
           $config          = new ConfigClass();
           $container       = $config->getDefaults(); 
        }
        $data         += ['authkey' => $checkAuth ? $this->otpAuth : $container['common']['otpAuthKey']];
        $data         += ['mobile' => $mobileNumber];
        $otp           = new OtpClass();
        $response      = $otp->verifyOtp($oneTimePass, $data);
        return $response;
    }
    /**
    *  Resend OTP using MSG91 Service, you want to Resend OTP using this "verifyOtp method"
    *
    * @param  $mobileNumber int
    * @param  $retrytype    String
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function resendOtp($mobileNumber, $retrytype = null)
    {
        $checkAuth = '';
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
        $response        = $otp->retryOtp($retrytype, $data);
        return $response;
    }
}
