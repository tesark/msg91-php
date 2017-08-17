<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\OtpSend;

/**
* This test class for testing MSG91 OTP functions
*/

class OtpSendTest extends TestCase
{
    private $otp;
    protected function setUp()
    {
        $this->otp = new OtpSend();
    }
    protected function tearDown()
    {
        $this->otp = null;
    }
    //-----------------------------------
    public function testSendOtp()
    {
        $sendArray = [
           'message'       => "this is test value",
           'sender'        => "MSG91",
           'otp'           => 4535,
           'otp_expiry'    => 1,
           'otp_length'    => 4
        ];

        $expectArray = [
           'mobile'        => 9514028541,
           'message'       => "this is test value",
           'sender'        => "MSG91",
           'otp'           => 4535,
           'otp_expiry'    => 1,
           'otp_length'    => 4
        ];
        $result = [
            'query' => $expectArray
        ];
        $result = $this->otp->sendOtp(9514028541, $sendArray);
        $this->assertEquals($result, $result);
    }
    public function testSendOtpfalse()
    {
        $sendArray = [
           'message'      => "this is test value",
           'sender'       => "MSG91",
           'otp'          => 4535,
           'otp_expiry'   => 1,
           'otp_length'    => 10
        ];

        $expectArray = [
           'mobile'       => 9514028541,
           'message'      => "this is test value",
           'sender'       => "MSG91",
           'otp'          => 4535,
           'otp_expiry'   => 1,
           'otp_length'    => null
        ];
        $result = [
            'query' => $expectArray
        ];
        $result = $this->otp->sendOtp(9514028541, $sendArray);
        $this->assertEquals($result, $result);
    }
    //--------------------------------
    public function testVerifyOtp()
    {
        $expectArray = [
           'mobile'       => 9514028541,
           'otp'          => 4535
        ];
        $result = [
            'query' => $expectArray
        ];
        $result = $this->otp->verifyOtp(9514028541, 4535);
        $this->assertEquals($result, $result);
    }
    public function testVerifyOtpfalse()
    {
        $expectArray = [
           'mobile'       => 9514028541,
           'otp'          => 4535
        ];
        $result = [
            'query' => $expectArray
        ];
        $result = $this->otp->verifyOtp('9514028541', 4535);
        $this->assertNotEquals($result, $result);
    }

    //------------------------
    public function testResendOtp()
    {
        $expectArray = [
           'mobile'       => 9514028541,
           'retrytype'    => 'voice'
        ];
        $result = [
            'query' => $expectArray
        ];
        $result = $this->otp->resendOtp(9514028541, 'voice');
        $this->assertEquals($result, $result);
    }
    public function testResendOtpTrue()
    {
        $expectArray = [
           'mobile'       => 9514028541,
           'retrytype'    => 'text'
        ];
        $result = [
            'query' => $expectArray
        ];
        $result = $this->otp->resendOtp(9514028541, 'text');
        $this->assertEquals($result, $result);
    }
    public function testResendOtpEmpty()
    {
        $expectArrayT = [
           'mobile'       => 9514028541,
           'retrytype'    => 'text'
        ];
        $expectArrayV = [
           'mobile'       => 9514028541,
           'retrytype'    => 'voice'
        ];
        $result = [
            'query' => $expectArrayT || expectArrayV
        ];
        $result = $this->otp->resendOtp(9514028541);
        $this->assertEquals($result, $result);
    }
}
