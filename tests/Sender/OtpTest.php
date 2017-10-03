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
    public function testSendOtp()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5421,
          // 'otp_expiry'    => 20,
          // 'otp_length'    => 4
        ];
        $otpResponse = $this->otp->sendOtp(919514028541, $sendArray);
        $array = json_decode($otpResponse);
        $this->assertObjectHasAttribute("type", $array);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
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
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpOtpException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          // 'otp'           => 5421,
          // 'otp_expiry'    => 20,
          // 'otp_length'    => 4
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendSenderException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkatskpi",
          'otp'           => 5421,
          // 'otp_expiry'    => 20,
          // 'otp_length'    => 4
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpExpiryException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 0,
          // 'otp_length'    => 4
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpMinLengthException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 3
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpMaxLengthException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 10
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
}
