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

class OtpClass
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
    /**
     * This function add data to array
     * @param string $key
     * @param int|string $value
     * @param array $data
     *
     * @return array
     */
    protected function addArray($key, $value, $data)
    {
        $data[$key] = $value ? $value : null;
        return $data;
    }
    /**
     * This function added int value in array
     * @param string $key
     * @param int|string $value
     * @param array $data
     * @param string $type
     *
     * @return array
     */
    protected function addDataArray($key, $value, $data, $type)
    {
        if ($type === 'int') {
            $test = $this->isInterger($value);
        } else {
            $test = $this->isString($value);
        }
        if ($test) {
            $data = $this->addArray($key, $value, $data);
        } else {
            throw ParameterException::invalidArrtibuteType($key, $type, $value);
        }
        return $data;
    }
    /**
     * This function used for build Retype data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildRetryType($key, $data)
    {
        if ($this->setRetryType()) {
            $value = $this->getRetryType();
            $data  = $this->addDataArray($key, $value, $data, 'string');
        }
        return $data;
    }
    /**
     * This function used for build Retryp data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildOneTimePass($key, $data)
    {
        if ($this->setOneTimePass()) {
            $key = 'otp';
            $value = $this->getOneTimePass();
            $data  = $this->addDataArray($key, $value, $data, 'int');
        }
        return $data;
    }
    /**
     * This function used for build Resend and Verify Otp Atrributes atrributes
     * @param string $key
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array
     */
    protected function buildResendAndVerifyOtpArrtibutes($key, $data)
    {
        if ($this->isKeyExists($key, $data)) {
            switch ($key) {
                case 'retrytype':
                    $data = $this->buildRetryType($key, $data);
                    break;
                case 'oneTime':
                    $data = $this->buildOneTimePass($key, $data);
                    break;
                default:
                    $message = "parameter".$key."Missing";
                    throw ParameterException::missinglogic($message);
                    break;
            }
        }
        return $data;
    }
    /**
     * This function used for build message data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildMessage($key, $data)
    {
        if ($this->setMessage()) {
            $value = $this->getMessage();
            $data  = $this->addDataArray($key, $value, $data, 'string');
        }
        return $data;
    }
    /**
     * This function used for build sender data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildSender($key, $data)
    {
        if ($this->setSender()) {
            $value = $this->getSender();
            if ($this->isString($value)) {
                if (strlen($value) == 6) {
                    $data = $this->addArray($key, $value, $data);
                } else {
                    $message = "String length must be 6 characters";
                    throw ParameterException::invalidInput($key, "string", $value, $message);
                }
            } else {
                throw ParameterException::invalidArrtibuteType($key, "string", $value);
            }
        }
        return $data;
    }
    /**
     * This function used for build otp data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildOtp($key, $data)
    {
        if ($this->setOtp()) {
            $value = $this->getOtp();
            $data  = $this->addDataArray($key, $value, $data, 'int');
        }
        return $data;
    }
    /**
     * This function used for build otpExpiry data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildOtpExpiry($key, $data)
    {
        if ($this->setOtpExpiry()) {
            $value = $this->getOtpExpiry();
            $data  = $this->addDataArray($key, $value, $data, 'int');
        }
        return $data;
    }
    /**
     * This function used for build otpLength data
     * @param string $key
     * @param array $data
     *
     * @return array
     */
    protected function buildOtpLength($key, $data)
    {
        if ($this->setOtpLength()) {
            $value = $this->getOtpLength();
            if ($this->isInterger($value)) {
                if ($value >= 4 && $value < 10) {
                    $data = $this->addArray($key, $value, $data);
                } else {
                    $message = "otp length min 4 to max 9. you given $value";
                    throw ParameterException::invalidInput($key, "int", $value, $message);
                }
            } else {
                throw ParameterException::invalidArrtibuteType($key, "int", $value);
            }
        }
        return $data;
    }
    /**
     * This function used for build sendOTP atrributes
     * @param string $key
     * @param array $inputdata
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array
     */
    protected function buildOtpDataArrtibutes($key, $inputData, $data)
    {
        if ($this->isKeyExists($key, $inputData)) {
            switch ($key) {
                case 'message':
                    $data = $this->buildMessage($key, $data);
                    break;
                case 'sender':
                    $data = $this->buildSender($key, $data);
                    break;
                case 'otp':
                    $data = $this->buildOtp($key, $data);
                    break;
                case 'otp_expiry':
                    $data = $this->buildOtpExpiry($key, $data);
                    break;
                case 'otp_length':
                    $data = $this->buildOtpLength($key, $data);
                    break;
                default:
                    $message = "parameter".$key."Missing";
                    throw ParameterException::missinglogic($message);
                    break;
            }
        }
        return $data;
    }
    /**
     * Add otp on the array
     * @param array $inputData
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array condition correct value add to the $data array
     */
    protected function addMessage($inputData, $data)
    {
        $data = $this->buildOtpDataArrtibutes('message', $inputData, $data);
        return $data;
    }
    /**
     * Add sender on the Array
     * @param array $inputData
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array condition correct value add to the $data array
     */
    protected function addSender($inputData, $data)
    {
        $data = $this->buildOtpDataArrtibutes('sender', $inputData, $data);
        return $data;
    }
    /**
     * Add otp on the array
     * @param array $inputData
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array condition correct value add to the $data array
     */
    protected function addOtp($inputData, $data)
    {
        $data = $this->buildOtpDataArrtibutes('otp', $inputData, $data);
        return $data;
    }
    /**
     * Add otp_expiry on the array
     * @param array $inputData
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array condition correct value add to the $data array
     */
    protected function addOtpExpiry($inputData, $data)
    {
        $data = $this->buildOtpDataArrtibutes('otp_expiry', $inputData, $data);
        return $data;
    }
    /**
     * Add otp_length on the array
     * @param array $inputData
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array condition correct value add to the $data array
     */
    protected function addOtpLength($inputData, $data)
    {
        $data = $this->buildOtpDataArrtibutes('otp_length', $inputData, $data);
        return $data;
    }
    /**
     * This function for buils Auth key
     * @param string $parameter
     *
     * @return bool
     */
    protected function hasAuthKey($parameter)
    {
        if ($this->setAuthkey()) {
            $value = $this->getAuthkey();
            if ($this->isString($value)) {
                return true;
            } else {
                throw ParameterException::invalidArrtibuteType($parameter, "string", $value);
            }
        }
    }
    /**
     * This function for buils Mobile
     * @param string $parameter
     *
     * @return bool
     */
    protected function hasMobile($parameter)
    {
        if ($this->setmobile()) {
            $value = $this->getmobile();
            if ($this->isInterger($value)) {
                return true;
            } else {
                throw ParameterException::invalidArrtibuteType($parameter, "int", $value);
            }
        }
    }
    /**
     * Check Authkey and mobile
     * @param string $parameter
     *
     * @throws ParameterException missing parameters or return empty
     * @return bool
     */
    protected function isParameterPresent($parameter)
    {
        if ($this->isKeyExists($parameter, $this->sendData)) {
            if ($parameter === 'authkey') {
                return $this->hasAuthKey($parameter);
            } else {
                return $this->hasMobile($parameter);
            }
        } else {
            $message = "Parameter ".$parameter." missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * Check Authkey
     *
     * @return bool
     */
    protected function checkAuthKey()
    {
        return $this->isParameterPresent('authkey');
    }
    /**
     * Check mobile
     *
     * @return bool
     */
    protected function checkMobile()
    {
        return $this->isParameterPresent('mobile');
    }
    
    /**
     * Add retry type
     *
     * @param array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return array Msg91 Json response
     */
    protected function addRetryType($data)
    {
        $data = $this->buildResendAndVerifyOtpArrtibutes('retrytype', $data);
        return $data;
    }
    /**
     * Add otp on the array
     * @param   array $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return  array condition correct value add to the $data array
     */
    protected function addOneTimePass($data)
    {
        $data = $this->buildResendAndVerifyOtpArrtibutes('oneTime', $data);
        return $data;
    }
    /**
     * This function call otpFinalSend() function
     * @param array $dataArray
     * @param array $data
     *
     */
    public function sendOtp($dataArray, $data)
    {
        $otp = new OtpSend();
        $response = $otp->otpFinalSend($dataArray, $data);
        return $response;
    }
    /**
     * This function call apiCategory() function
     * @param int $mobileNumber
     * @param int|string $value
     * @param string $otpAuthKey
     * @param int $apiCategory
     *
     */
    public function otpApiCategory($mobileNumber, $value, $AuthKey, $apiCategory)
    {
        $otp = new OtpVerifyAndResend();
        $response = $otp->apiCategory($mobileNumber, $value, $AuthKey, $apiCategory);
        return $response;
    }
}
