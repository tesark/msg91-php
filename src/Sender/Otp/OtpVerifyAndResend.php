<?php
namespace Sender\Otp;

use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\Otp\OtpDefineClass;
use Sender\Otp\OtpBuildClass;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for verify OTP
 *
 * @package    Sender\OtpVerify
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

class OtpVerifyAndResend extends OtpBuildClass
{
    /**
     * This function used for verify and resend OTP content
     * @param int $mobileNumber
     * @param int|string $value
     * @param string $otpAuthKey
     * @param int $apiCategory
     *
     * @return string
     */
    public function otpApiCategory($mobileNumber, $value, $AuthKey, $apiCategory)
    {
        $data = [];
        $otpAuthKey = null;
        $checkAuth = Validation::isAuthKey($AuthKey);
        if (!$checkAuth) {
            // Get Envirionment variable and config file values
            $config = new ConfigClass();
            $container = $config->getDefaults();
            $common = $container['common'];
            $otpAuthKey = $common['otpAuthKey'];
        }
        $data['authkey'] = $checkAuth ? $AuthKey : $otpAuthKey;
        $data['mobile'] = $mobileNumber;
        if ($apiCategory === 1) {
            $data['otp'] = $value;
            $uri = "verifyRequestOTP.php";
            $response = $this->otpFinalVerifyAndResend($data, $uri);
        } else {
            $data['retrytype'] = $value;
            $uri = 'retryotp.php';
            $response = $this->otpFinalVerifyAndResend($data, $uri);
        }
        return $response;
    }
    /**
     * This function for retry and verify OTP
     * @param int    $category
     * @param array  $data
     *
     * @throws ParameterException missing parameters or return empty
     * @return string Msg91 Json response
     */
    protected function otpFinalVerifyAndResend($data, $uri)
    {
        $this->sendData = $data;
        if ($this->checkAuthKey() && $this->checkMobile()) {
            $data = $this->sendData;
            //add retry type on array
            $data = $this->addRetryType($data);
            //add otp on array
            $data = $this->addOneTimePass($data);
        } else {
            $message = "The parameters Authkey or Mobile missing";
            throw ParameterException::missinglogic($message);
        }
        $delivery = new Deliver();
        $response = $delivery->sendOtpGet($uri, $data);
        return $response;
    }
}
