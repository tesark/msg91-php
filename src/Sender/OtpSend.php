<?php
namespace Sender;

use Sender\Deliver;
use Sender\Exception\ParameterException;

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
    public static function sendOtp($mobileNumber, $dataArray)
    {
        $data = [];
        $data['authkey'] = "170436A8DCExM8m259969531";
        $data['mobile']  = $mobileNumber;
        $otp      = new OtpClass();
        $response = $otp->sendOtp($dataArray, $data);
        return $response;

        // foreach ($dataArray as $key => $value) {
        //     switch ($key) {
        //         case 'message':
        //             if (is_string($value)) {
        //                 $data[$key] = $value ? $value : null;
        //             } else {
        //                 throw ParameterException::invalidArrtibuteType("message", "string", $value);
        //             }
        //             break;
        //         case 'sender':
        //             if (is_string($value)) {
        //                 if (strlen($value) == 6) {
        //                     $data[$key] = $value ? $value : null;
        //                 } else {
        //                     $message = "String length must be 6 characters";
        //                     throw ParameterException::invalidInput("sender", "string", $value, $message);
        //                 }
        //             } else {
        //                 throw ParameterException::invalidArrtibuteType("sender", "string", $value);
        //             }
        //             break;
        //         case 'otp':
        //             if (is_int($value)) {
        //                 $data[$key] = $value ? $value : null;
        //             } else {
        //                 throw ParameterException::invalidArrtibuteType("otp", "int", $value);
        //             }
        //             break;
        //         case 'otp_expiry':
        //             if (is_int($value)) {
        //                 $data[$key] = $value ? $value : null;
        //             } else {
        //                 throw ParameterException::invalidArrtibuteType("otp_expiry", "int", $value);
        //             }
        //             break;
        //         case 'otp_length':
        //             if (is_int($value)) {
        //                 $value  = array('options' => array('min_range' => 4,'max_range' => 9));
        //                 $result = filter_var($value, FILTER_VALIDATE_INT, $value);
        //                 $data[$key] = $result ? $result : null;
        //             } else {
        //                     $message = "otp_length between 4 to 6 integer";
        //                     throw ParameterException::invalidInput("sender", "int", $value, $message);
        //             }
        //             break;
        //         default:
        //             $message = "Unwanted prameters found:".$key."is the wrong parameter";
        //             throw ParameterException::missinglogic($message);
        //             break;
        //     }
        // }
        // if (array_key_exists('otp', $data) && array_key_exists('message', $data)) {
        //      goto end;
        // } else {
        //     throw ParameterException::missinglogic("When using otp or message, unable to use seperately");
        // }
        // end:
        // $uri = "sendotp.php";
        // $response = Deliver::sendOtpGet($uri, $data);
        // var_dump("----------------");
        // var_dump($response);
        // return $response;
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
    public static function verifyOtp($mobileNumber, $oneTimePass)
    {
        $data = [];
        $data += ['authkey' => "170436A8DCExM8m259969531"];
        $data += ['mobile' => $mobileNumber];
        $otp      = new OtpClass();
        $response = $otp->verifyOtp($oneTimePass, $data);
        return $response;

        // if (is_int($otp)) {
        //     $data['otp'] = $otp ? $otp : null;
        // } else {
        //     throw ParameterException::invalidArrtibuteType("otp", "int", $value);
        // }
        // $uri = "verifyRequestOTP.php";
        // $response = Deliver::sendOtpGet($uri, $data);
        // var_dump("----------------");
        // var_dump($response);
        // return $response;
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
    public static function resendOtp($mobileNumber, $retrytype = null)
    {
        $data = [];
        $data['authkey'] = "170436A8DCExM8m259969531";
        $data['mobile'] = $mobileNumber;
        $otp      = new OtpClass();
        $response = $otp->retryOtp($retrytype, $data);
        return $response;

        // if (is_string($retrytype) || $retrytype == null) {
        //     $data['retrytype'] = $retrytype ? $retrytype : 'text';
        // } else {
        //     $message = "retrytype are text or voice";
        //     throw ParameterException::invalidInput("retrytype", "string", $retrytype, $message);
        // }
        // $uri = 'retryotp.php';
        // $response = Deliver::sendOtpGet($uri, $data);
        // var_dump("----------------");
        // var_dump($response);
        // return $response;
    }
}
