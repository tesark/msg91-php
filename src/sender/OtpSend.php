<?php
namespace sender;

class OtpSend
{

	// public function __construct($senderId, $otpLength)
 //    {
 //        $this->senderId   = $senderId;
 //        $this->otpLength  = $otpLength; 
 //    }

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
        if (is_int ($mobileNumber)) {
          
          $data['mobile'] = $mobileNumber;
        }
        foreach ($dataArray as $key => $value) {
        	
        	if ($key === 'message') {

               if(is_string($value)) {

                   $data[$key] = $value ? $value : null;
               }

        	} elseif ($key === 'sender') {
               
                if(is_string($value)) {

                   $data[$key] = $value ? $value : $this->senderId;
                }

        	} elseif ($key === 'otp') {

        		if(is_int($value)) {
                   
                   $data[$key] = $value ? $value : null;
        		}        		
        	   	
        	} elseif ($key === 'otp_expiry') {

                if(is_int($value)) {
                   
                   $data[$key] = $value ? $value : null;
        		} 
        		
        	} elseif ($key === 'otp_length') {
                
                if(is_int($value)) {

                   $result = filter_var($value, FILTER_VALIDATE_INT, array('options' => array('min_range' => 4,'max_range' => 9)));
                   $data[$key] = $result ? $result : $this->otpLength;
        		} 
        	}

        }
        var_dump($data);
        return $data;
    }
}