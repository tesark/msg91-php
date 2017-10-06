<?php
namespace Sender\Traits;

use Sender\Validation;
use Sender\MobileNumber;
use Sender\Sms\SmsDefineClass;
use Sender\Sms\SmsBuildClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This trait for SMS OTP FUNCTIONS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

trait SmsBuildSupportTrait
{
    /**
     * Check vaild Date Time
     * @return bool
     */
    public function isVaildDateTime($value)
    {
        if (Validation::isValidDateFirstFormat($value)) {
            return true;
        } elseif (Validation::isValidDateSecondFormat($value)) {
            return true;
        } elseif (Validation::isValidTimeStamp($value)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check key present
     * @param string $key
     *
     * @return bool
     */
    public function keyPresent($key)
    {
        if ($this->isKeyPresent($key)) {
            return true;
        } else {
            $message = $key."Must be present";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * Check afterminutes limits
     * @param string $afterMinutes
     *
     * @return bool
     */
    public function isVaildAfterMinutes($afterMinutes)
    {
        $value  = array('options' => array('min_range' => 10, 'max_range' => 20000));
        $result = filter_var($afterMinutes, FILTER_VALIDATE_INT, $value);
        return (bool) $result;
    }
    /**
     * This function Check value 0 or 1
     *
     * @return int
     */
    public function checkArray($value)
    {
        $responseFormat = array(0, 1);
        $value = in_array($value, $responseFormat) ? $value : null;
        return $value;
    }
    /**
     * This function check expect value present in array
     * @param string $value
     *
     */
    public function checkResponse($value)
    {
        $responseFormat = array('xml', 'json');
        $responseVal = strtolower($value);
        $value = in_array($responseVal, $responseFormat) ? $responseVal : null;
        return $value;
    }
}
