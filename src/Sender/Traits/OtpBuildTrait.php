<?php
namespace Sender\Traits;

use Sender\Validation;
use Sender\MobileNumber;
use Sender\Otp\OtpBuildClass;
use Sender\Otp\OtpDefineClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This trait for OTP FUNCTIONS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

trait OtpBuildTrait
{
    /**
     * Check Authkey and mobile
     * @param string $parameter
     *
     * @throws ParameterException missing parameters or return empty
     * @return bool
     */
    public function isParameterPresent($parameter)
    {
        if ($this->isKeyExists($parameter, $this->sendData)) {
            if ($parameter === 'authkey') {
                return $this->hasAuthKey($parameter);
            } else {
                return $this->hasMobile($parameter);
            }
        } else {
            $message = "Parameter ".$parameter." missing";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * Check Authkey
     *
     * @return bool
     */
    public function checkAuthKey()
    {
        return $this->isParameterPresent('authkey');
    }
    /**
     * Check mobile
     *
     * @return bool
     */
    public function checkMobile()
    {
        return $this->isParameterPresent('mobile');
    }
}
