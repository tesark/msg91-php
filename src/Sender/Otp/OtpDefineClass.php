<?php
namespace Sender\Otp;

use Sender\Deliver;
use Sender\Validation;
use Sender\Otp\OtpSend;
use Sender\MobileNumber;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for build OTP
 *
 * @package    Sender\OtpClass
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class OtpDefineClass
{
    /**
     * @var array $inputData
     */
    protected $inputData = null;
    /**
     * @var array $sendData
     */
    protected $sendData = null;
    /**
     * @var string $message
     */
    protected $message = null;
    /**
     * @var string $sender
     */
    protected $sender = null;
    /**
     * @var int $otp
     */
    protected $otp = null;
    /**
     * @var int $otpExpiry
     */
    protected $otpExpiry = null;
    /**
     * @var int $otpLength
     */
    protected $otpLength = null;
    /**
     * @var string $authkey
     */
    protected $authkey = null;
    /**
     * @var int $mobile
     */
    protected $mobile = null;
    /**
     * @var string $retrytype
     */
    protected $retrytype = null;
    /**
     * Check the data empty
     * @return bool
     */
    protected function hasInputData()
    {
        return isset($this->inputData);
    }
    /**
     * Check the sendData empty
     * @return bool
     */
    protected function hasSendData()
    {
        return isset($this->sendData);
    }
    /**
     * Check key present in array or not
     * @param string $key
     * @param array  $array
     *
     * @return bool
     */
    protected function isKeyExists($key, $array)
    {
        return array_key_exists($key, $array);
    }
    /**
     * set message
     * @return bool
     */
    protected function setMessage()
    {
        $this->message = $this->inputData['message'];
        return true;
    }
    /*
     * get message
     */
    protected function getMessage()
    {
        return $this->message;
    }
    /**
     * set sender
     * @return bool
     */
    protected function setSender()
    {
        $this->sender = $this->inputData['sender'];
        return true;
    }
    /*
     * get sender
     */
    protected function getSender()
    {
        return $this->sender;
    }
    /**
     * set otp
     * @return bool
     */
    protected function setOtp()
    {
        $this->otp = $this->inputData['otp'];
        return true;
    }
    /*
     * get otp
     */
    protected function getOtp()
    {
        return $this->otp;
    }
    /**
     * set otp
     * @return bool
     */
    protected function setOneTimePass()
    {
        $this->otp = $this->sendData['otp'];
        return true;
    }
    /*
     * get setonetime
     */
    protected function getOneTimePass()
    {
        return $this->otp;
    }
    /**
     * set otp_expiry
     * @return bool
     */
    protected function setOtpExpiry()
    {
        $this->otpExpiry = $this->inputData['otp_expiry'];
        return true;
    }
    /*
     * get otp_expiry
     */
    protected function getOtpExpiry()
    {
        return $this->otpExpiry;
    }
    /**
     * set otp_length
     * @return bool
     */
    protected function setOtpLength()
    {
        $this->otpLength = $this->inputData['otp_length'];
        return true;
    }
    /*
     * get otp_length
     */
    protected function getOtpLength()
    {
        return $this->otpLength;
    }
    /**
     * set authkey
     * @return bool
     */
    protected function setAuthkey()
    {
        $this->authkey = $this->sendData['authkey'];
        return true;
    }
    /*
     * get authkey
     */
    protected function getAuthkey()
    {
        return $this->authkey;
    }
    /**
     * set mobile
     * @return bool
     */
    protected function setmobile()
    {
        $this->mobile = $this->sendData['mobile'];
        return true;
    }
    /*
     * get mobile
     */
    protected function getmobile()
    {
        return $this->mobile;
    }
    /**
     * set retrytype
     * @return bool
     */
    protected function setRetryType()
    {
        $this->retrytype = $this->sendData['retrytype'];
        return true;
    }
    /*
     * get retrytype
     */
    protected function getRetryType()
    {
        return $this->retrytype;
    }
    /**
     * Check integer value
     * @return bool
     */
    protected function isInterger($value)
    {
        $result = Validation::isInteger($value);
        return $result;
    }
    /**
     * Check string value
     * @param string $value
     * @return bool
     */
    protected function isString($value)
    {
        $result = Validation::isString($value);
        return $result;
    }
}
