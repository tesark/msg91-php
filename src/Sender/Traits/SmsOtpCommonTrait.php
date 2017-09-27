<?php
namespace Sender\Traits;

use Sender\Validation;
use Sender\MobileNumber;
use Sender\ExceptionClass\ParameterException;

/**
 * This trait for SMS OTP FUNCTIONS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

trait SmsOtpCommonTrait
{
    /**
     * This function add data to array
     * @param string $key
     * @param int|string $value
     * @param array $array
     *
     * @return array
     */
    protected function addArray($key, $value, $array)
    {
        $result = !is_null($value) ? $value : null; 
        return $array += [$key => $result];
    }
	/**
     * This function for test sender length
     * @param string $key
     * @param string $value
     * @param array $data
     * @param string $api
     * @param int $category
     * @param array $xmlDoc
     *
     */
    protected function validLength($key, $value, $data, $api, $category = null, $xmlDoc = null)
    {
        if (strlen($value) == 6) {
            if ($api === 'otp') {
                $data = $this->addArray($key, $value, $data);
            } else {
                $data = $this->buildData($category, $key, $value, $data, $xmlDoc);
            }    
        } else {
            $message = "String length must be 6 characters";
            throw ParameterException::invalidInput($key, "string", $value, $message);
        }
        return $data;
    }
    /**
     * Check string value
     * @param string $value
     * @return bool
     */
    protected function isString($value)
    {
        $result = Validation::isString($value);
        return $result;
    }
    /**
     * Check integer value
     * @param value
     * @return bool
     */
    public function isInterger($value)
    {
        $result = Validation::isInteger($value);
        return $result;
    }
    /**
     * Check numeric value
     * @param value
     * @return bool
     */
    public function isNumeric($value)
    {
        $result = Validation::isNumeric($value);
        return $result;
    }
    /*
     * Check isvalid mobile number 
     */
    public function isValidNumber($value)
    {
        $result = MobileNumber::isValidNumber($value);
        return $result;
    }
    /**
     * Check key present in array or not
     * @param string $key
     * @param array  $array
     *
     * @return bool
     */
    protected function isKeyExists($key, $array)
    {
        return array_key_exists($key, $array);
    }
}