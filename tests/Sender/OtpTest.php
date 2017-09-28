<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\MobileNumber;

/**
* This test class for testing OTP class
*/

class OtpTest extends TestCase
{
	private $otp;
    protected function setUp()
    {
        $this->otp = new Otp();
    }
    protected function tearDown()
    {
        $this->otp = null;
    }
    public function testSendOtp()
    {
    	$sendArray = [
           'message'       => "Your verification code is ##5421##",
           'sender'        => "Venkat",
           'otp'           => 5421,
           // 'otp_expiry'    => 20,
           // 'otp_length'    => 4
        ];
       $otpResponse   = $this->otp->sendOtp(919514028541,$sendArray);
       var_dump($otpResponse);
    }
}    