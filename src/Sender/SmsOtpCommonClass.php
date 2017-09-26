<?php
namespace Sender;

use DOMDocument;
use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
use Sender\Sms\SmsBuildClass;
use Sender\Otp\OtpBuildClass;
use Sender\Sms\SmsDefineClass;
use Sender\Otp\OtpDefineClass;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for send Bulk SMS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class SmsOtpCommonclass
{
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
     * Check afterminutes limits
     * @param string $afterMinutes
     *
     * @return bool
     */
    protected function isVaildAfterMinutes($afterMinutes)
    {
        $value  = array('options' => array('min_range' => 10, 'max_range' => 20000));
        $result = filter_var($afterMinutes, FILTER_VALIDATE_INT, $value);
        return (bool) $result;
    }/**
     * This function Check value 0 or 1
     *
     * @return int
     */
    protected function checkArray($value)
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
    protected function checkResponse($value)
    {
        $responseFormat = array('xml', 'json');
        $responseVal = strtolower($value);
        $value = in_array($responseVal, $responseFormat) ? $responseVal : null;
        return $value;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc = null)
    {
        if ($this->isString($value)) {
            $buildSmsData = $this->buildStringData($category, $key, $value, $buildSmsData, $xmlDoc);    
        } else {
            $message = "string values only accept";
            throw ParameterException::invalidInput($key, "string", $value, $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function buildStringData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        $buildSmsData = $this->CheckAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->CheckSenderData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->CheckMessageData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->CheckResponseData($category, $key, $value, $buildSmsData);        
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function CheckAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        if ($key === 'authkey' || $key === 'campaign') {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function CheckSenderData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        if ($key === 'sender') {
            $buildSmsData = $this->validLength($key, $value, $buildSmsData, 'sms', $category, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function CheckMessageData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        if ($key === 'message') {
            $buildSmsData = $this->messageCondition($category, $key, $buildSmsData, $value, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function CheckResponseData($category, $key, $value, $buildSmsData)
    {
        if ($key === 'response') {
            $value = $this->checkResponse($value);
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
        }
        return $buildSmsData;
    }
}