<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\OtpSend;

class OtpSendTest extends TestCase
{
    private $otp;
    // $array = [
    //     'senderId'  => "MSG91",
    //     'otpLength' => 4
    // ];    
    protected function setUp()
    {
        $this->otp = new OtpSend();
    }
    protected function tearDown()
    {
        $this->otp = null;
    }
    //-----------------------------------
    public function testSendOtp() {        

        $sendArray = [     
           'message'      => "this is test value",
	       'sender'  	  => "MSG91",
	       'otp'          => 4535,
	       'otp_expiry'   => 1,
	       'otp_length'    => 4, 
	              
        ];

        $expectArray = [
           'mobile'       => 9514028541,
           'message'      => "this is test value",
	       'sender'  	  => "MSG91",
	       'otp'          => 4535,
	       'otp_expiry'   => 1,
	       'otp_length'    => 4,       
	       
        ];

        $result = $this->otp->sendOtp(9514028541,$sendArray);
        $this->assertEquals($expectArray, $result);

    }

    // public function testSendOtpfalse() {        

    //     $sendArray = [     
    //        'message'      => "this is test value",
	   //     'sender'  	  => "MSG91",
	   //     'otp'          => 4535,
	   //     'otp_expiry'   => 1,
	   //     'otp_length'    => 10, 
	              
    //     ];

    //     $expectArray = [
    //        'mobile'       => "9514028541",
    //        'message'      => "this is test value",
	   //     'sender'  	  => "MSG91",
	   //     'otp'          => 4535,
	   //     'otp_expiry'   => 1,
	   //     'otp_length'    => 4,       
	       
    //     ];

    //     $result = $this->otp->sendOtp("9514028541",$sendArray);
    //     $this->assertNotEquals($expectArray, $result);

    // } 

    


}