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
    //------------Send OTP----------
    public function testSendOtp()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5421,
        ];
        $otpResponse = $this->otp->sendOtp(919514028541, $sendArray);
        $array = json_decode($otpResponse);
        $this->assertObjectHasAttribute("type", $array);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpMessageNotSentException()
    {
        $sendArray = [
          'sender'        => "Venkat",
          'otp'           => 5421,
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpSenderIsNumberException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => 456464,
          'otp'           => 5421,
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpIsStringException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => "5421",
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
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpExpiryIsStringException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => "0",
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
    public function testSendOtpMinLengthIsStringException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => "3"
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
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpMessageBooleanSentException()
    {
        $sendArray = [
          'message'       => true,
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpSenderBooleanException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => true,
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpBooleanException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => true,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpExpiryBooleanException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => true,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpLengthBooleanException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => true,
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    //----------Retry Otp ---------
    public function testRetryOtpTextformat()
    {
      $response   = $this->otp->resendOtp(919514028541,"text");
      $array = json_decode($response);
      $this->assertObjectHasAttribute("type", $array);
    }
    public function testRetryOtpVoiceformat()
    {
      $response   = $this->otp->resendOtp(919514028541,"voice");
      $array = json_decode($response);
      $this->assertObjectHasAttribute("type", $array);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingFirstParameterformat()
    {
      $response   = $this->otp->resendOtp("text");
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingSecondParameterformat()
    {
      $response   = $this->otp->resendOtp(919514028541);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingSecondParameterIsNumberformat()
    {
      $response   = $this->otp->resendOtp(919514028541, 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingSecondParameterIsFloatformat()
    {
      $response   = $this->otp->resendOtp(919514028541, 45.65);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingSecondParameterIsBooleanformat()
    {
      $response   = $this->otp->resendOtp(919514028541, true);
    }
    //----------- Verify OTP --------
    public function testVerifyOtp()
    {
        $verifyResponse   = $this->otp->verifyOtp(919514028541,5421);
        $array = json_decode($verifyResponse);
        $this->assertObjectHasAttribute("type", $array);
    }
    public function testVerifyOtpIsString()
    {
        $verifyResponse   = $this->otp->verifyOtp(919514028541,"5421");
        $array = json_decode($verifyResponse);
        $this->assertObjectHasAttribute("type", $array);
    }
}
