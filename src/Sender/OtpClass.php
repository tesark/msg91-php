<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\Exception\ParameterException;

/**
* This Class for build and send OTP
*
* @package    Msg91 SMS&OTP package
* @author     VenkatS <venkatsamuthiram5@gmail.com>
* @link       https://github.com/venkatsamuthiram/deliver
* @license    
*/

class OtpClass
{
    /*
    *InputData is array type
    */
    protected $inputData   = null;
    /*
    *sendData is array type
    */
    protected $sendData   = null;
    /*
    * Check the data empty
    */
    public function hasInputData()
    {
        return isset($this->inputData);
    }
    /*
    * Check the sendData empty
    */
    public function hasSendData()
    {
        return isset($this->sendData);
    }    
    /*
    * Check the message key existes in array
    */
    public function isMessageKeyExists()
    {
        return array_key_exists("message", $this->inputData);
    }
    /*
    * Check the sender key existes in array
    */
    public function isSenderKeyExists()
    {
        return array_key_exists("sender", $this->inputData);
    }
    /*
    * Check the otp key existes in array
    */
    public function isOtpKeyExists()
    {
        return array_key_exists("otp", $this->inputData);
    }
    /*
    * Check the otp key existes in array
    */
    public function isOneTimeKeyExists()
    {
        return isset($this->inputData);
    }
    /*
    * Check the otp_expiry key existes in array
    */
    public function isOtpExpiryKeyExists()
    {
        return array_key_exists("otp_expiry", $this->inputData);
    }
    /*
    * Check the otp_length key existes in array
    */
    public function isOtpLengthKeyExists()
    {
        return array_key_exists("otp_length", $this->inputData);
    }
    /*
    * Check the authkey key existes in array
    */
    public function isAuthKeyExists()
    {
        return isset($this->sendData);
    }
    /*
    * Check the mobile key existes in array
    */
    public function isMobileKeyExists()
    {
        return array_key_exists("mobile", $this->sendData);
    }
    /*
    * Check the retrytype key existes in array
    */
    public function isRetryTypeExists()
    {
        return isset($this->inputData);
    }
    /*
    * set message
    */
    public function setMessage()
    {
        $this->message =  $this->inputData['message'];
        return true;
    }
    /*
    * get message
    */
    public function getMessage()
    {
        return $this->message;
    }
    /*
    * set sender
    */
    public function setSender()
    {
        $this->sender =  $this->inputData['sender'];
        return true;
    }
    /*
    * get sender
    */
    public function getSender()
    {
        return $this->sender;
    }
    /*
    * set otp
    */
    public function setOtp()
    {
        $this->otp =  $this->inputData['otp'];
        return true;
    }
    /*
    * get otp
    */
    public function getOtp()
    {
        return $this->otp;
    }
    /*
    * set setonetime
    */
    public function setOneTimePass()
    {
        $this->otp =  $this->inputData;
        return true;
    }
    /*
    * get setonetime
    */
    public function getOneTimePass()
    {
        return $this->otp;
    }
    /*
    * set otp_expiry
    */
    public function setOtpExpiry()
    {
        $this->otpExpiry =  $this->inputData['otp_expiry'];
        return true;
    }
    /*
    * get otp_expiry
    */
    public function getOtpExpiry()
    {
        return $this->otpExpiry;
    }
    /*
    * set otp_length
    */
    public function setOtpLength()
    {
        $this->otpLength =  $this->inputData['otp_length'];
        return true;
    }
    /*
    * get otp_length
    */
    public function getOtpLength()
    {
        return $this->otpLength;
    }
    /*
    * set authkey
    */
    public function setAuthkey()
    {
        $this->authkey =  $this->sendData['authkey'];
        return true;
    }
    /*
    * get authkey
    */
    public function getAuthkey()
    {
        return $this->authkey;
    }
    /*
    * set mobile
    */
    public function setmobile()
    {
        $this->mobile =  $this->sendData['mobile'];
        return true;
    }
    /*
    * get mobile
    */
    public function getmobile()
    {
        return $this->mobile;
    }
    /*
    * set retrytype
    */
    public function setRetryType()
    {
        $this->retrytype =  $this->inputData;
        return true;
    }
    /*
    * get retrytype
    */
    public function getRetryType()
    {
        return $this->retrytype;
    }    
	/*
    * Check integer value 
    */
    public function isInterger($value)
    {
        $result = Validation::isInteger($value);
        return $result;
    }
    /*
    * Check string value 
    */
    public function isString($value)
    {
        $result = Validation::isString($value);
        return $result;
    }
    /*
    *add otp on the array
    **/
    public function addMessage($data)
    {
        if ($this->isMessageKeyExists() && $this->setMessage()) {
            if ($this->isString($this->getMessage())) {
                $data['message'] = $this->getMessage() ? $this->getMessage() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("message", "string", $this->getMessage());
            }
        }
        return $data;
    }
    /*
    *add sender on the Array
    */
    public function addSender($data)
    {
        if ($this->isSenderKeyExists() && $this->setSender()) {
            if ($this->isString($this->getSender())) {
                if (strlen($this->getSender()) == 6) {
                    $data['sender'] = $this->getSender() ? $this->getSender() : null;
                } else {
                    $message = "String length must be 6 characters";
                    throw ParameterException::invalidInput("sender", "string", $this->getSender(), $message);
                }
            } else {
                throw ParameterException::invalidArrtibuteType("sender", "string", $this->getSender());
            }
        }
        return $data;
    }
     /*
    *add otp on the array
    */
    public function addOtp($data)
    {
        if ($this->isOtpKeyExists() && $this->setOtp()) {
            if ($this->isInterger($this->getOtp())) {
                $data['otp'] = $this->getOtp() ? $this->getOtp() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("otp", "int", $this->getOtp());
            }
        }
        return $data;
    }
     /*
    *add otp on the array
    */
    public function addOneTimePass($data)
    {
        if ($this->isOneTimeKeyExists() && $this->setOneTimePass()) {
            if ($this->isInterger($this->getOneTimePass())) {
                $data['otp'] = $this->getOneTimePass() ? $this->getOneTimePass() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("otp", "int", $this->getOneTimePass());
            }
        }
        return $data;
    }
    /*
    *add otp_expiry on the array
    */
    public function addOtpExpiry($data)
    {
        if ($this->isOtpExpiryKeyExists() && $this->setOtpExpiry()) {
            if ($this->isInterger($this->getOtpExpiry())) {
                $data['otp_expiry'] = $this->getOtpExpiry() ? $this->getOtpExpiry() : null;
            } else {
                throw ParameterException::invalidArrtibuteType("otp_expiry", "int", $this->getOtpExpiry());
            }
        }
        return $data;
    }
    /*
    *add otp_length on the array
    */
    public function addOtpLength($data)
    {
    	if ($this->isOtpLengthKeyExists() && $this->setOtpLength()) {
            if ($this->isInterger($this->getOtpLength())) {
                $value  = array('options' => array('min_range' => 4,'max_range' => 9));
                $result = filter_var($this->getOtpLength(), FILTER_VALIDATE_INT, $value);
                $data["otp_length"] = $result ? $result : null;
            } else {
                $message = "otp_length between 4 to 6 integer";
                throw ParameterException::invalidInput("otp_length", "int", $this->getOtpLength(), $message);
            }
        }
        return $data;
    }
    /*
    *Check Authkey 
    */
    public function checkAuthKey()
    {
        if ($this->isAuthKeyExists() && $this->setAuthkey()) {
            if ($this->isString($this->getAuthkey())) {
               return true;
            } else {
               throw ParameterException::invalidArrtibuteType("Authkey", "string", $this->getAuthkey());
            }
        } else {
            $message = "Parameter Authkey missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /*
    *Check mobile 
    */
    public function checkMobile()
    {
        if ($this->isMobileKeyExists() && $this->setmobile()) {
            if ($this->isInterger($this->getmobile())) {
               return true;
            } else {
               throw ParameterException::invalidArrtibuteType("mobile", "int", $this->getmobile());
            }
        } else {
            $message = "Parameter mobile missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /*
    *This function for send OTP 
    *
    *
    */
    public function sendOtp($dataArray, $data)
    {
        $this->inputData    = $dataArray;
        $this->sendData     = $data;
        if ($this->hasInputData() && $this->hasSendData()) {
            var_dump("----test----");
            if ($this->checkAuthKey() && $this->checkMobile()) {
                $data = $this->sendData;
                //add message on array
                $data = $this->addMessage($data); 
                //add sender on the Array
                $data = $this->addSender($data);
                //add otp on the array
                $data = $this->addOtp($data);
                //add otp_expiry on the array
                $data = $this->addOtpExpiry($data);
                //add otp_length on the array
                $data = $this->addOtpLength($data);
                var_dump($data);  
            }
            if (array_key_exists('otp', $data) && array_key_exists('message', $data)) {
                goto end;
            } else {
                throw ParameterException::missinglogic("When using otp or message, unable to use seperately");
            }
            end:
            $uri = "sendotp.php";
            $delivery = new Deliver();
            $response = $delivery->sendOtpGet($uri, $data);
            var_dump("----------------");
            var_dump($response);
            return $response;
        } else {
           $message = "The wrong parameter found";
           throw ParameterException::missinglogic($message);
        }
    }
    /*
    *Add retry type
    */
    public function addRetryType($data)
    {
        if ($this->isRetryTypeExists() && $this->setRetryType()) {
            if ($this->isString($this->getRetryType())) {
               $data['retrytype'] =  $this->getRetryType() ? $this->getRetryType() : null;
            } else {
               throw ParameterException::invalidArrtibuteType("mobile", "int", $this->getRetryType());
            }
        } else {
            $message = "Parameter mobile missing";
            throw ParameterException::missinglogic($message);
        }
        return $data;
    }
    /*
    *This function for retry OTP 
    *
    *
    */
    public function retryOtp($retrytype, $data)
    {
        $this->inputData    = $retrytype;
        $this->sendData     = $data;
        if ($this->hasInputData() && $this->hasSendData()) {
            var_dump("----testretry----");
            if ($this->checkAuthKey() && $this->checkMobile()) {
                $data = $this->sendData;
                //add message on array
                $data = $this->addRetryType($data);
                var_dump($data);
            }
        } else {
           $message = "The parameters not found";
           throw ParameterException::missinglogic($message);
        }
        $uri = 'retryotp.php';
        $delivery = new Deliver();
        $response = $delivery->sendOtpGet($uri, $data);
        var_dump("----------------");
        var_dump($response);
        return $response;
    }
    /*
    *This function for verify OTP 
    *
    *
    */
    public function verifyOtp($otp, $data)
    {
        $this->inputData    = $otp;
        $this->sendData     = $data;
        if ($this->hasInputData() && $this->hasSendData()) {
            var_dump("----testverify----");
            if ($this->checkAuthKey() && $this->checkMobile()) {
                $data = $this->sendData;
                //add message on array
                $data = $this->addOneTimePass($data);
                var_dump($data);
            }
        } else {
           $message = "The parameters not found";
           throw ParameterException::missinglogic($message);
        }
        $uri = "verifyRequestOTP.php";
        $delivery = new Deliver();
        $response = $delivery->sendOtpGet($uri, $data);
        var_dump("----------------");
        var_dump($response);
        return $response;
    }
}
