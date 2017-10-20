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
        $this->otp = new Otp("170436A8DCExM8m259969531aa");
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
    //------------------------Message----------------------
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
    public function testSendOtpMessageIntegerSentException()
    {
        $sendArray = [
          'message'       => 63475374,
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
    public function testSendOtpMessageDoubleSentException()
    {
        $sendArray = [
          'message'       => 63.475374,
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
    public function testSendOtpMessageArraySentException()
    {
        $sendArray = [
          'message'       => ['63.475374'],
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    //--------------------Sender------------------------
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
    public function testSendOtpSenderArrayException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => ['true'],
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpSenderIntegerException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => 444444,
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpSenderDoubleException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => 34.534534,
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    //--------------------OTP--------------------------
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
    public function testSendOtpArrayException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => ['true'],
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpDoubleException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 44.566666666,
          'otp_expiry'    => 1,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    //--------------------OTP Expiry --------------------------
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
    public function testSendOtpExpiryArrayException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => ['true'],
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpExpiryDoubleException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 56.54545,
          'otp_length'    => 8
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    //-------------------OTP Length-------------------
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
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpLengthArrayException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => ['true'],
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testSendOtpLengthDoubleException()
    {
        $sendArray = [
          'message'       => "Your verification code is ##5421##",
          'sender'        => "Venkat",
          'otp'           => 5424,
          'otp_expiry'    => 1,
          'otp_length'    => 45.34534,
        ];
        $otp = $this->otp->sendOtp(919514028541, $sendArray);
    }
    //----------Retry Otp ---------
    public function testRetryOtpTextformat()
    {
        $response   = $this->otp->resendOtp(919514028541, "text");
        $array = json_decode($response);
        $this->assertObjectHasAttribute("type", $array);
    }
    public function testRetryOtpVoiceformat()
    {
        $response   = $this->otp->resendOtp(919514028541, "voice");
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
    public function testRetryOtpMissingFirstParameterIsBooleanformat()
    {
        $response   = $this->otp->resendOtp(true, 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingFirstParameterIsArrayformat()
    {
        $response   = $this->otp->resendOtp(['true'], 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingFirstParameterIsStringformat()
    {
        $response   = $this->otp->resendOtp('true', 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingFirstParameterIsDoubleformat()
    {
        $response   = $this->otp->resendOtp(45.76345343, 4565);
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
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingSecondParameterIsArrayformat()
    {
        $response   = $this->otp->resendOtp(919514028541, ['true']);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testRetryOtpMissingSecondParameterIsIntegerformat()
    {
        $response   = $this->otp->resendOtp(919514028541, 345343434);
    }
    //----------- Verify OTP --------
    public function testVerifyOtp()
    {
        $verifyResponse   = $this->otp->verifyOtp(919514028541, 5421);
        $array = json_decode($verifyResponse);
        $this->assertObjectHasAttribute("type", $array);
    }
    public function testVerifyOtpIsString()
    {
        $verifyResponse   = $this->otp->verifyOtp(919514028541, "5421");
        $array = json_decode($verifyResponse);
        $this->assertObjectHasAttribute("type", $array);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingFirstParameterIsBooleanformat()
    {
        $response   = $this->otp->verifyOtp(true, 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingFirstParameterIsArrayformat()
    {
        $response   = $this->otp->verifyOtp(['true'], 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingFirstParameterIsStringformat()
    {
        $response   = $this->otp->verifyOtp('true', 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingFirstParameterIsDoubleformat()
    {
        $response   = $this->otp->verifyOtp(45.76345343, 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingSecondParameterIsNumberformat()
    {
        $response   = $this->otp->verifyOtp(true, 4565);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingSecondParameterIsFloatformat()
    {
        $response   = $this->otp->verifyOtp(['true'], 45.65);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingSecondParameterIsBooleanformat()
    {
        $response   = $this->otp->verifyOtp(['true'], true);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingSecondParameterIsArrayformat()
    {
        $response   = $this->otp->verifyOtp(true, ['true']);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testVerifyOtpMissingSecondParameterIsIntegerformat()
    {
        $response   = $this->otp->verifyOtp(91951.4028541, 345343434);
    }
}
