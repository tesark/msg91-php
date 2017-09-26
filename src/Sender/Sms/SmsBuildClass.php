<?php
namespace Sender\Sms;

use Sender\Deliver;
use Sender\Validation;
use Sender\Sms\SmsBulk;
use Sender\Sms\SmsNormal;
use Sender\MobileNumber;
use Sender\SmsOtpCommonclass;
use Sender\Config\Config as ConfigClass;
use Sender\ExceptionClass\ParameterException;

/**
 * This Class for Build and send the SMS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

class SmsBuildClass extends SmsDefineClass
{
    /**
     * This function for build country
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildCountry($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setCountry()) {
            $value = $this->getCountry();
            if ($this->isNumeric($value)) {
                $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
            } else {
                throw ParameterException::invalidArrtibuteType($key, "numeric", $value);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function for build flash
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildFlash($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setFlash()) {
            $value = $this->getFlash();
            $buildSmsData = $this->checkArrayValue($category, $key, $value, $buildSmsData, $xmlDoc);
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
    protected function checkArrayValue($category, $key, $value, $buildSmsData, $xmlDoc)
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
     * This function for build Unicode
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildUnicode($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setUnicode()) {
            $value = $this->getUnicode();
            $buildSmsData = $this->checkArrayValue($category, $key, $value, $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for build schtime
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildSchtime($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setSchtime()) {
            $value = $this->getSchtime();
            if ($this->isVaildDateTime($value)) {
                $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
            } else {
                $message = "Allowed can use Y-m-d h:i:s Or Y/m/d h:i:s Or timestamp ";
                throw ParameterException::invalidInput($key, "string", $value, $message);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function simply SMS Sender to Array
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function simplifySender($category, $key, $buildSmsData, $xmlDoc, $value)
    {
        if ($this->isString($value)) {
            $buildSmsData = $this->validLength($key, $value, $buildSmsData, 'sms', $category, $xmlDoc)
        } else {
            throw ParameterException::invalidArrtibuteType($key, "string", $value);
        }
        return $buildSmsData;
    }
    /**
     * This function for build sender
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildSmsSender($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setSender()) {
            $value = $this->getSender();
            $buildSmsData = $this->simplifySender($category, $key, $buildSmsData, $xmlDoc, $value);
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
    protected function checkAfterMinutes($category, $key, $value, $buildSmsData)
    {
        if ($this->isVaildAfterMinutes($value)) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
        } else {
            $message = "Allowed between 10 to 20000 mintutes";
            throw ParameterException::invalidInput("afterminutes", "int", $value, $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for simplify afterminutes
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function simplifyAfterMinutes($category, $key, $buildSmsData, $value)
    {
        if ($this->isInterger($value)) {
            $buildSmsData = $this->checkAfterMinutes($category, $key, $value, $buildSmsData);
        } else {
            throw ParameterException::invalidArrtibuteType($key, "int", $value);
        }
        return $buildSmsData;
    }
    /**
     * This function for build afterminutes
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildAfterMinutes($category, $key, $buildSmsData)
    {
        if ($this->setAfterminutes()) {
            $value = $this->getAfterminutes();
            $buildSmsData = $this->simplifyAfterMinutes($category, $key, $buildSmsData, $value);
        }
        return $buildSmsData;
    }
    /**
     *This function for simplify message
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function simplifyMessage($category, $key, $buildSmsData, $value, $xmlDoc)
    {
        if ($this->isString($value)) {
            $buildSmsData = $this->messageCondition($category, $key, $buildSmsData, $value, $xmlDoc);
        } else {
            $message = "string values only accept";
            throw ParameterException::invalidInput($key, "string", $value, $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for build Message
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildMessage($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setMessage()) {
            $value = $this->getMessage();
            $buildSmsData = $this->simplifyMessage($category, $key, $buildSmsData, $value, $xmlDoc);
        }
        return $buildSmsData;
    }
     /**
      *This function for simplify message
      * @param int $category
      * @param string $key
      * @param array $buildSmsData
      *
      * @return array
      */
    protected function simplifyResponse($category, $key, $value, $buildSmsData)
    {
        if ($this->isString($value)) {
            $value = $this->checkResponse($value);
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
        } else {
            $message = "string values only accept";
            throw ParameterException::invalidInput($key, "string", $value, $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for build Response
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildResponse($category, $key, $buildSmsData)
    {
        if ($this->setResponse()) {
            $value = $this->getResponse();
            $buildSmsData = $this->simplifyResponse($category, $key, $value, $buildSmsData);
        }
        return $buildSmsData;
    }
    /**
     * This function for build Authkey
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildBulkAuth($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setAuthKey()) {
            $value = $this->getAuthKey();
            $buildSmsData = $this->stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for build campaign
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function buildCampaign($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setCampaign()) {
            $value = $this->getCampaign();
            $buildSmsData = $this->stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc);
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
    protected function stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc = null)
    {
        if ($this->isString($value)) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
        } else {
            throw ParameterException::invalidArrtibuteType($key, "string", $value);
        }
        return $buildSmsData;
    }
    /**
     * This function for buildData normal SMS as well bulk SMS
     *
     *
     */
    protected function buildData($category, $key, $value, $buildSmsData, $xmlDoc = null, $isElement = null, $Atrr = null)
    {
        if ($category === 1) {
            $buildSmsData = $this->addArray($key, $value, $buildSmsData);
        } else {
            if ($isElement) {
                $childAttr = $xmlDoc->createAttribute($Atrr);
                $childText = $xmlDoc->createTextNode($this->getMessage());
                $buildSmsData->appendChild($childAttr)->appendChild($childText);
            } else {
                $buildSmsData = $this->addXml($buildSmsData, $xmlDoc, $key, $value);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function check variable Key in input array
     * @param string $key
     *
     * @return bool
     */
    protected function isKeyPresent($key)
    {
        return $this->isKeyExists($key, $this->inputData);
    }
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
        return $array += [$key => $value];
    }
    /**
     * This function add data to xml string
     *
     */
    protected function addXml($buildSmsData, $xmlDoc, $key, $value)
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
     * This function for sms array Build with mobilenumbers
     * @param  array $buildSmsData
     *
     *
     * @return array
     */
    protected function buildMobile($key, $value, $buildSmsData, $category)
    {
        $result = $this->isValidNumber($value);
        if (!empty($result) && $result['value'] == true) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
        } else {
            $message = "this number not the correct:_".$result['mobile'];
            throw ParameterException::invalidInput("mobiles", "string", $this->getmobile(), $message);
        }
        return $buildSmsData;
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
    protected function checkIntegerOrString($key, $value, $buildSmsData, $category)
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
     * @param array $buildSmsData
     * @param int $category
     *
     * @throws ParameterException missing parameters or return empty
     * @return array
     */
    protected function addMobile($buildSmsData, $category)
    {
        $value = '';
        $key = ''; 
        if ($category === 1) {
            if ($this->setMobile()) {
                $value = $this->getMobile();
                $key = 'mobiles';
            }
        } else {
            if ($this->setMobile()) {
                $value = $this->getMobile();
                $key = 'mobile';
            }
        }
        $buildSmsData = $this->checkIntegerOrString($key, $value, $buildSmsData, $category);
        return $buildSmsData;
    }
    /**
     * This function for check message length allowed only 160 char, unicode allowed 70 char
     * @param array $buildSmsData
     * @param int $limit
     *
     * @throws ParameterException missing parameters or return empty
     * @return array $buildSmsData
     */
    protected function checkMessageLength($key, $buildSmsData, $limit, $value, $category, $xmlDoc)
    {
        if (strlen($this->getMessage()) <= $limit) {
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc, true, "TEXT");
        } else {
            $message = "allowed below ".$limit." cheracters,but given length:_".strlen($this->getMessage());
            throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
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
    protected function messageCondition($category, $key, $buildSmsData, $value, $xmlDoc)
    {
        if (!$this->isKeyExists('unicode', $this->inputData)) {
            $buildSmsData = $this->checkMessageLength($key, $buildSmsData, 160, $value, $category, $xmlDoc);
        } elseif ($this->isKeyExists('unicode', $this->inputData)) {
            $buildSmsData = $this->checkMessageLength($key, $buildSmsData, 70, $value, $category, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function Create Element only
     * @param array $xmlDoc
     * @param string $element
     * @param array $root
     *
     * @return array
     */
    protected function createElement($xmlDoc, $element, $root = null)
    {
        if (is_null($root)) {
            $root = $xmlDoc->appendChild($xmlDoc->createElement($element));
        } else {
            $root = $root->appendChild($xmlDoc->createElement($element));
        }
        return $root;
    }
    protected function addContent($root, $category, $xmlDoc)
    {
        if ($this->isKeyExists('content', $this->inputData) && $this->setContent()) {
            $bulkSms      = $this->getContent();
            $lenOfBulkSms = $this->getSize($bulkSms);
            for ($j = 0; $j < $lenOfBulkSms; $j++) {
                $this->inputData = $bulkSms[$j];
                $smsTag = $this->createElement($xmlDoc, "SMS", $root);
                //check message length
                $smsTag = $this->buildMessage($category, 'message', $smsTag, $xmlDoc);
                //check mobile contents
                $this->addMobileNumber($xmlDoc, $smsTag);
            }
        }
    }
    /**
     * This function for Add mobile number to XML
     * @param array $xmlDoc
     * @param array $smsTag
     *
     */
    protected function addMobileToXml($xmlDoc, $smsTag, $result)
    {
        if (!empty($result) && $result['value'] == true) {
            $mobiles = $result['mobile'];
            $len = $this->getSize($mobiles);
            for ($k = 0; $k < $len; $k++) {
                $addressTag = $smsTag->appendChild($xmlDoc->createElement("ADDRESS"));
                $childAttr = $xmlDoc->createAttribute("TO");
                $childText = $xmlDoc->createTextNode($mobiles[$k]);
                $addressTag->appendChild($childAttr)->appendChild($childText);
            }
        } else {
            $message = "string comma seperate values";
            throw ParameterException::invalidInput("mobiles", "string or integer", $this->getmobile(), $message);
        }
    }
    /**
     * This function for Add mobile number
     * @param array $xmlDoc
     * @param array $smsTag
     *
     */
    protected function addMobileNumber($xmlDoc, $smsTag)
    {
        if ($this->setMobile() && $this->getMobile()) {
            $result = $this->isValidNumber($this->getMobile());
            $this->addMobileToXml($xmlDoc, $smsTag, $result);
        }
    }
    /**
     * This function for sms array Build with message
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or return empty
     * @return array $buildSmsData
     */
    protected function addMessage($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('message')) {
            $buildSmsData = $this->buildMessage($category, 'message', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array Build with Authkey
     * @param  int $category
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     *
     */
    protected function addAuth($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('authkey')) {
            $buildSmsData = $this->buildBulkAuth($category, 'authkey', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array Build with sender
     * @param  int $category
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     *
     */
    protected function addSender($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('sender')) {
            $buildSmsData = $this->buildSmsSender($category, 'sender', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with country
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     */
    protected function addCountry($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('country')) {
            $buildSmsData = $this->buildCountry($category, 'country', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with flash
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     *
     */
    protected function addFlash($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('flash')) {
            $buildSmsData = $this->buildFlash($category, 'flash', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with flash
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    protected function addUnicode($buildSmsData, $category, $xmlDoc = null)
    {   
        if ($this->isKeyPresent('unicode')) {
            $buildSmsData = $this->buildUnicode($category, 'unicode', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with schtime
     * @param  int $category
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     *
     */
    protected function addSchtime($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('schtime')) {
            $buildSmsData = $this->buildSchtime($category, 'schtime', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    protected function addAfterMinutes($buildSmsData, $category)
    {
        if ($this->isKeyPresent('afterminutes')) {
            $buildSmsData = $this->buildAfterMinutes($category, 'afterminutes', $buildSmsData);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with Response
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     */
    protected function addResponse($buildSmsData, $category)
    {
        if ($this->isKeyPresent('response')) {
            $buildSmsData = $this->buildResponse($category, 'response', $buildSmsData);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with campaign
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     */
    protected function addCampaign($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('campaign')) {
            $buildSmsData = $this->buildCampaign($category, 'campaign', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
}
