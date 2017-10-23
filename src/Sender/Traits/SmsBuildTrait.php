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
 * @link       https://github.com/tesark/msg91-php
 * @license    MIT
 */

trait SmsBuildTrait
{
    protected $inputData;
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
    public function checkAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc)
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
    public function checkMessageData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        if ($key === 'message') {
            $buildSmsData = $this->messageCondition($category, $key, $buildSmsData, $value, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * Message condition Check
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     * @param int $value
     *
     * @return array
     */
    public function messageCondition($category, $key, $buildSmsData, $value, $xmlDoc)
    {
        if (!$this->isKeyExists('unicode', $this->inputData)) {
            $buildSmsData = $this->checkMessageLength($key, $buildSmsData, 160, $value, $category, $xmlDoc);
        } elseif ($this->isKeyExists('unicode', $this->inputData)) {
            $buildSmsData = $this->checkMessageLength($key, $buildSmsData, 70, $value, $category, $xmlDoc);
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
     * This function check the content length
     *
     *
     */
    public function checkContent($lenOfBulkSms, $bulkSms, $root, $category, $xmlDoc)
    {
        for ($j = 0; $j < $lenOfBulkSms; $j++) {
            $currentData = $bulkSms[$j];
            if (array_key_exists('message', $currentData) && array_key_exists('mobile', $currentData)) {
                $this->inputData['message'] = $currentData['message'];
                $this->inputData['mobile'] = $currentData['mobile'];
                $smsTag = $this->createElement($xmlDoc, "SMS", $root);
                //check message length
                $smsTag = $this->buildMessage($category, 'message', $smsTag, $xmlDoc);
                //check mobile contents
                $this->addMobileNumber($xmlDoc, $smsTag);
            } else {
                $message = "parameters authkey or message missing";
                throw ParameterException::missinglogic($message);
            }
        }
    }
    /**
     * This function Create Element only
     * @param string $element
     * @param array $root
     *
     * @return array
     */
    public function createElement($xmlDoc, $element, $root = null)
    {
        if (is_null($root)) {
            $root = $xmlDoc->appendChild($xmlDoc->createElement($element));
        } else {
            $root = $root->appendChild($xmlDoc->createElement($element));
        }
        return $root;
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
            return $buildSmsData;
        } else {
            $message = "string values only accept";
            throw ParameterException::invalidInput($key, "string", $value, $message);
        }
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
            return $buildSmsData;
        } else {
            $message = "Allowed only 0 or 1";
            throw ParameterException::invalidInput($key, "int", $value, $message);
        }
    }
    
    /**
     * This function for sms array Build with mobilenumbers
     * @param string $key
     * @param array $buildSmsData
     * @param int $category
     *
     * @throws ParameterException missing parameters or return empty
     * @return array
     */
    public function checkIntegerOrString($key, $value, $buildSmsData, $category)
    {
        if ($this->isInterger($value)) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
        } elseif ($this->isString($value)) {
            $buildSmsData = $this->buildMobile($key, $value, $buildSmsData, $category);
        } else {
            $message = "interger or string comma seperate values";
            throw ParameterException::invalidInput($key, "string or integer", $value, $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array Build with mobilenumbers
     * @param  array $buildSmsData
     *
     *
     * @return array
     */
    public function buildMobile($key, $value, $buildSmsData, $category)
    {
        $result = $this->isValidNumber($value);
        if (!empty($result) && $result['value'] == true) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
            return $buildSmsData;
        } else {
            $message = "this number not the correct:_".$result['mobile'];
            throw ParameterException::invalidInput("mobiles", "string", $value, $message);
        }
    }
}
