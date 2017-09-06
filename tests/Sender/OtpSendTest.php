<?php
namespace Sender;

use Sender\OtpSend;
use Sender\Config\MyConfig;
use PHPUnit\Framework\TestCase;

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
    // public function testSendOtp()
    // {
    //     $sendArray = [
    //        'message'       => "this is test value",
    //        'sender'        => "MSG91",
    //        'otp'           => 4535,
    //        'otp_expiry'    => 1,
    //        'otp_length'    => 4
    //     ];

    //     $expectArray = [
    //        'mobile'        => 9514028541,
    //        'message'       => "this is test value",
    //        'sender'        => "MSG91",
    //        'otp'           => 4535,
    //        'otp_expiry'    => 1,
    //        'otp_length'    => 4
    //     ];

    //     $result = $this->otp->sendOtp(9514028541, $sendArray);
    //     $this->assertEquals($expectArray, $result);
    // }
    // public function testSendOtpfalse()
    // {
    //     $sendArray = [
    //        'message'      => "this is test value",
    //        'sender'       => "MSG91",
    //        'otp'          => 4535,
    //        'otp_expiry'   => 1,
    //        'otp_length'    => 10
    //     ];

    //     $expectArray = [
    //        'mobile'       => 9514028541,
    //        'message'      => "this is test value",
    //        'sender'       => "MSG91",
    //        'otp'          => 4535,
    //        'otp_expiry'   => 1,
    //        'otp_length'    => null
    //     ];

    //     $result = $this->otp->sendOtp(9514028541, $sendArray);
    //     $this->assertEquals($expectArray, $result);
    // }
    // //--------------------------------
    // public function testVerifyOtp()
    // {
    //     $expectArray = [
    //        'mobile'       => 9514028541,
    //        'otp'          => 4535
    //     ];
 
    //     $result = $this->otp->verifyOtp(9514028541, 4535);
    //     $this->assertEquals($expectArray, $result);
    // }
    // public function testVerifyOtpfalse()
    // {
    //     $expectArray = [
    //        'mobile'       => 9514028541,
    //        'otp'          => 4535
    //     ];

    //     $result = $this->otp->verifyOtp('9514028541', 4535);
    //     $this->assertNotEquals($expectArray, $result);
    // }

    // //------------------------
    // public function testResendOtp()
    // {
    //     $expectArray = [
    //        'mobile'       => 9514028541,
    //        'retrytype'    => 'voice'
    //     ];

    //     $result = $this->otp->resendOtp(9514028541, 'voice');
    //     $this->assertEquals($expectArray, $result);
    // }
    // public function testResendOtpTrue()
    // {
    //     $expectArray = [
    //        'mobile'       => 9514028541,
    //        'retrytype'    => 'text'
    //     ];

    //     $result = $this->otp->resendOtp(9514028541, 'text');
    //     $this->assertEquals($expectArray, $result);
    // }
    // public function testResendOtpEmpty()
    // {
    //     $expectArrayT = [
    //        'mobile'       => 9514028541,
    //        'retrytype'    => 'text'
    //     ];
    //     $expectArrayV = [
    //        'mobile'       => 9514028541,
    //        'retrytype'    => 'voice'
    //     ];

    //     $result = $this->otp->resendOtp(9514028541);
    //     $this->assertEquals($expectArray, $result);
    // }
}
