<?php
namespace Sender;

use Sender\Deliver;
use Sender\Exception\InvalidParameterException;

/**
* This function for send OTP through MSG91 service
*/

class OtpSend
{
    // public function __construct($authkey, $senderId = null, $otpLength = null)
    // {
    //     $this->authkey    = $authkey;
    //     $this->senderId   = $senderId;
    //     $this->otpLength  = $otpLength;
    // }
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
        $data = [];
        $data['authkey'] = "170436A8DCExM8m259969531";
        $data['mobile']  = $mobileNumber;
        
        foreach ($dataArray as $key => $value) {
            if ($key === 'message') {
                if (is_string($value)) {
                    $data[$key] = $value ? $value : null;
                } else {
                    throw InvalidParameterException::invalidArrtibuteType("message", "string", $value);
                }
            } elseif ($key === 'sender') {
                if (is_string($value)) {
                    if (strlen($value) == 6) {
                        $data[$key] = $value ? $value : null;
                    } else {
                        throw InvalidParameterException::invalidInput("sender", "string", $value, "String length must be 6 characters");
                    }
                } else {
                   throw InvalidParameterException::invalidArrtibuteType("sender", "string", $value); 
                }
            } elseif ($key === 'otp') {
                if (is_int($value)) {
                    $data[$key] = $value ? $value : null;
                } else{
                    throw InvalidParameterException::invalidArrtibuteType("otp", "int", $value);
                }
            } elseif ($key === 'otp_expiry') {
                if (is_int($value)) {
                    $data[$key] = $value ? $value : null;
                } else{
                    throw InvalidParameterException::invalidArrtibuteType("otp_expiry", "int", $value);
                }
            } elseif ($key === 'otp_length') {
                if (is_int($value)) {
                    $value  = array('options' => array('min_range' => 4,'max_range' => 9));
                    $result = filter_var($value, FILTER_VALIDATE_INT, $value);
                    $data[$key] = $result ? $result : null;
                } else {
                        throw InvalidParameterException::invalidInput("sender", "int", $value, "otp_length between 4 to 6 integer value");
                }
            }
        }
        if (array_key_exists('otp', $data) && array_key_exists('message', $data)) {
             goto end;
        } else {
            throw InvalidParameterException::missinglogic("When using otp and message only using same time, unable to use seperately");
        }
        end:
        $uri = "sendotp.php";
        $response = Deliver::sendOtpGet($uri, $data);
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
    public function verifyOtp($mobileNumber, $otp)
    {
        $data = [];
        $data += ['authkey' => "170436A8DCExM8m259969531"];
        $data += ['mobile' => $mobileNumber];
        if (is_int($otp)) {
            $data['otp'] = $otp ? $otp : null;
        } else {
            throw InvalidParameterException::invalidArrtibuteType("otp", "int", $value);
        }
        $uri = "verifyRequestOTP.php";
        $response = Deliver::sendOtpGet($uri, $data);
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
        $data = [];       
        $data['authkey'] = "170436A8DCExM8m259969531";
        $data['mobile'] = $mobileNumber;
        if (is_string($retrytype) || $retrytype == null) {
            $data['retrytype'] = $retrytype ? $retrytype : 'text';
        } else {
            throw InvalidParameterException::invalidInput("retrytype", "string", $retrytype, "retrytype are text or voice");
        }
        $uri = 'retryotp.php';
        $response = Deliver::sendOtpGet($uri, $data);
        return $response;
    }
}
