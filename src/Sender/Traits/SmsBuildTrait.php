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
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

trait SmsBuildTrait
{
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    public function checkMessageData($category, $key, $value, $buildSmsData, $xmlDoc)
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
    public function checkSenderData($category, $key, $value, $buildSmsData, $xmlDoc)
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
    public function checkResponseData($category, $key, $value, $buildSmsData)
    {
        if ($key === 'response') {
            $value = $this->checkResponse($value);
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
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
    public function stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc = null)
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
    public function buildStringData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        $buildSmsData = $this->checkAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->checkSenderData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->checkMessageData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->checkResponseData($category, $key, $value, $buildSmsData);
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    public function checkAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        if ($key === 'authkey' || $key === 'campaign') {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function used for Array inside present 0 or 1
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    public function checkArrayValue($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        $value = $this->checkArray($value);
        if (!is_null($value)) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
        } else {
            $message = "Allowed only 0 or 1";
            throw ParameterException::invalidInput($key, "int", $value, $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for check afterminutes
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    public function checkAfterMinutes($category, $key, $value, $buildSmsData)
    {
        if ($this->isVaildAfterMinutes($value)) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
        } else {
            $message = "Allowed between 10 to 20000 mintutes";
            throw ParameterException::invalidInput("afterminutes", "int", $value, $message);
        }
        return $buildSmsData;
    }
}
