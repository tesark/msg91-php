<?php
namespace Sender;

use Sender\Deliver;

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
                }
            } elseif ($key === 'sender') {
                if (is_string($value)) {
                    if (strlen($value) == 6) {
                        $data[$key] = $value ? $value : null;
                    }
                }
            } elseif ($key === 'otp') {
                if (is_int($value)) {
                    $data[$key] = $value ? $value : null;
                }
            } elseif ($key === 'otp_expiry') {
                if (is_int($value)) {
                    $data[$key] = $value ? $value : null;
                }
            } elseif ($key === 'otp_length') {
                if (is_int($value)) {
                    $value  = array('options' => array('min_range' => 4,'max_range' => 9));
                    $result = filter_var($value, FILTER_VALIDATE_INT, $value);
                    $data[$key] = $result ? $result : null;
                }
            }
        }
        if (array_key_exists('otp', $data) && array_key_exists('message', $data)) {
             var_dump("--working--");
             goto end;
        } else {
            echo "flase";
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
        $retryTypeArray = array('voice', 'text');
        $random = array_rand($retryTypeArray);
        $data['authkey'] = "170436A8DCExM8m259969531";
        $data['mobile'] = $mobileNumber;
        if (is_string($retrytype) || $retrytype == null) {
            $data['retrytype'] = $retrytype ? $retrytype : $retryTypeArray[$random];
        }
        $uri = 'retryotp.php';
        $response = Deliver::sendOtpGet($uri, $data);
        return $response;
    }
}
