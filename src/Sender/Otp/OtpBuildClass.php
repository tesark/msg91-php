<?php
namespace Sender\Otp;

use Sender\Deliver;
use Sender\Validation;
use Sender\Otp\OtpSend;
use Sender\MobileNumber;
use Sender\SmsOtpCommonclass;
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

class OtpBuildClass extends OtpDefineClass
{
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
    protected function buildOneTimePass($data)
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
                    $data = $this->buildOneTimePass($data);
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
                $data = $this->validLength($key, $value, $data, 'otp');
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
     * This function used for Check otpLength data
     * @param string $key
     * @param int $value
     * @param array $data
     *
     * @return array
     */
    protected function checkOtpLength($key, $value, $data)
    {
        if ($value >= 4 && $value < 10) {
            $data = $this->addArray($key, $value, $data);
        } else {
            $message = "otp length min 4 to max 9. you given $value";
            throw ParameterException::invalidInput($key, "int", $value, $message);
        }
        return $data;
    }
    /**
     * This function used for build otpLength data
     * @param string $key
     * @param int $value
     * @param array $data
     *
     * @return array
     */
    protected function buildOtpLength($key, $data)
    {
        if ($this->setOtpLength()) {
            $value = $this->getOtpLength();
            if ($this->isInterger($value)) {
                $data = $this->checkOtpLength($key, $value, $data);
            } else {
                throw ParameterException::invalidArrtibuteType($key, "int", $value);
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
        if ($this->isKeyExists('message', $inputData)) {
            $data = $this->buildMessage('message', $data);
        }
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
        if ($this->isKeyExists('sender', $inputData)) {
            $data = $this->buildSender('sender', $data);
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
    protected function addOtp($inputData, $data)
    {
        if ($this->isKeyExists('otp', $inputData)) {
            $data = $this->buildOtp('otp', $data);
        }
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
        if ($this->isKeyExists('otp_expiry', $inputData)) {
            $data = $this->buildOtpExpiry('otp_expiry', $data);
        }
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
        if ($this->isKeyExists('otp_length', $inputData)) {
            $data = $this->buildOtpLength('otp_length', $data);
        }
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
}
