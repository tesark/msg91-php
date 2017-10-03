<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\Otp;
use Sender\ExceptionClass\ParameterException;

/**
* This test class for testing otp class
*/

class OtpTest extends TestCase
{
    public $otp;
    public function setUp()
    {
        $this->otp = new Otp("170436A8DCExM8m259969531");
    }
    public function tearDown()
    {
        $this->otp = null;
    }
    // public function testSendOtp()
    // {
    //     $sendArray = [
    //       'message'       => "Your verification code is ##5421##",
    //       'sender'        => "Venkat",
    //       'otp'           => 5421,
    //       // 'otp_expiry'    => 20,
    //       // 'otp_length'    => 4
    //     ];
    //     $otpResponse = $this->otp->sendOtp(919514028541, $sendArray);
    //     $array = json_decode($otpResponse);
    //     $this->assertObjectHasAttribute("type", $array);
    // }
    public function testSendOtpMessageException()
    {
        $sendArray = [
          // 'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5421,
          // 'otp_expiry'    => 20,
          // 'otp_length'    => 4
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
        $message = 'Error exception: When using otp or message, unable to use seperately';
        // $this->assertSame($otp, $message);
    }
    // public function testSendOtpOtpException()
    // {
    //     $sendArray = [
    //       'message'       => "Your verification code is ##5421##",
    //       'sender'        => "Venkat",
    //       // 'otp'           => 5421,
    //       // 'otp_expiry'    => 20,
    //       // 'otp_length'    => 4
    //     ];
    //     $otp = $this->otp->sendOtp(919514028541, $sendArray);
    //     $message = 'Error exception: When using otp or message, unable to use seperately';
    //     $this->assertSame($otp, $message);
    // }
    // public function testSendSenderException()
    // {
    //     $sendArray = [
    //       'message'       => "Your verification code is ##5421##",
    //       'sender'        => "Venkatskpi",
    //       'otp'           => 5421,
    //       // 'otp_expiry'    => 20,
    //       // 'otp_length'    => 4
    //     ];
    //     $otp = $this->otp->sendOtp(919514028541, $sendArray);
    //     $message = 'Invalid Input expect type:  string  params: sender  given:  string  Reason: String length must be 6 characters';
    //     $this->assertSame($otp, $message);
    // }
    // public function testSendOtpExpiryException()
    // {
    //     $sendArray = [
    //       'message'       => "Your verification code is ##5421##",
    //       'sender'        => "Venkat",
    //       'otp'           => 5424,
    //       'otp_expiry'    => 0,
    //       // 'otp_length'    => 4
    //     ];
    //     $otp = $this->otp->sendOtp(919514028541, $sendArray);
    //     $message = 'Invalid Input expect type:  int params: otp_expiry  given:  integer Reason: otp expiry min 1 mintues default 1 day. you given 0';
    //     $this->assertSame($otp, $message);
    // }
    // public function testSendOtpMinLengthException()
    // {
    //     $sendArray = [
    //       'message'       => "Your verification code is ##5421##",
    //       'sender'        => "Venkat",
    //       'otp'           => 5424,
    //       'otp_expiry'    => 1,
    //       'otp_length'    => 3
    //     ];
    //     $otp = $this->otp->sendOtp(919514028541, $sendArray);
    //     $message = 'Invalid Input expect type: int params: otp_length  given:  integer Reason: otp length min 4 to max 9. you given 3';
    //     $this->assertSame($otp, $message);
    // }
    // public function testSendOtpMaxLengthException()
    // {
    //     $sendArray = [
    //       'message'       => "Your verification code is ##5421##",
    //       'sender'        => "Venkat",
    //       'otp'           => 5424,
    //       'otp_expiry'    => 1,
    //       'otp_length'    => 10
    //     ];
    //     $otp = $this->otp->sendOtp(919514028541, $sendArray);
    //     var_dump("--------------------");
    //     var_dump($otp);
    //     // $this->expectException(\ParameterException::class);
    //     $this->assertEquals('Sender\ExceptionClass\ParameterException: Invalid Input expect type: int params: otp_length  given:  integer Reason: otp length min 4 to max 9. you given 10', $otp);
    // }
}
