<?php
namespace Sender\Traits;

use Sender\Validation;
use Sender\MobileNumber;
use Sender\Otp\OtpBuildClass;
use Sender\Sms\SmsDefineClass;
use Sender\Sms\SmsBuildClass;
use Sender\Otp\OtpDefineClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This trait for SMS OTP FUNCTIONS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
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
    public function addArray($key, $value, $array)
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
    public function validLength($key, $value, $data, $api, $category = null, $xmlDoc = null)
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
    public function isString($value)
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
    public function isKeyExists($key, $array)
    {
        return array_key_exists($key, $array);
    }
    /**
     * This function for check message length allowed only 160 char, unicode allowed 70 char
     * @param array $buildSmsData
     * @param int $limit
     *
     * @throws ParameterException missing parameters or return empty
     * @return array $buildSmsData
     */
    public function checkMessageLength($key, $buildSmsData, $limit, $value, $category, $xmlDoc)
    {
        if (strlen($value) <= $limit) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc, true, "TEXT");
            return $buildSmsData;
        } else {
            $message = "allowed below ".$limit." cheracters,but given length:_".strlen($value);
            throw ParameterException::invalidInput("message", "string", $value, $message);
        }
    }
    /**
     * This function for buildData normal SMS as well bulk SMS
     * @param int $category
     * @param string $key
     * @param int|string $value
     * @param array $buildSmsData
     * @param bool $isElement
     * @param string $attr
     *
     */
    public function buildData($category, $key, $value, $buildSmsData, $xmlDoc = null, $isElement = null, $attr = null)
    {
        if ($category === 1) {
            $buildSmsData = $this->addArray($key, $value, $buildSmsData);
        } else {
            if ($isElement) {
                $childAttr = $xmlDoc->createAttribute($attr);
                $childText = $xmlDoc->createTextNode($value);
                $buildSmsData->appendChild($childAttr)->appendChild($childText);
            } else {
                $buildSmsData = $this->addXml($buildSmsData, $xmlDoc, $key, $value);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function add data to xml string
     *
     */
    public function addXml($buildSmsData, $xmlDoc, $key, $value)
    {
        if ($key === 'schtime') {
            $key = 'scheduledatetime';
        }
        $key = strtoupper(trim($key));
        //create a country element
        $buildSmsData->appendChild($xmlDoc->createElement($key, $value));
        return $buildSmsData;
    }
    /**
     * This function added int value in array
     * @param string $key
     * @param int|string $value
     * @param array $data
     * @param string $type
     *
     * @return array
     */
    public function addDataArray($key, $value, $data, $type)
    {
        if ($type === 'int') {
            $test = $this->isInterger($value);
        } else {
            $test = $this->isString($value);
        }
        if ($test) {
            $data = $this->addArray($key, $value, $data);
        } else {
            throw ParameterException::invalidArrtibuteType($key, $type, $value);
        }
        return $data;
    }
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
