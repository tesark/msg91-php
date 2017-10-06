<?php
namespace Sender\Sms;

use Sender\Deliver;
use Sender\Validation;
use Sender\Sms\SmsBulk;
use Sender\Sms\SmsNormal;
use Sender\MobileNumber;
use Sender\Traits\SmsBuildTrait;
use Sender\Traits\SmsOtpCommonTrait;
use Sender\Traits\SmsBuildSupportTrait;
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
    use SmsBuildTrait;
    use SmsOtpCommonTrait;
    use SmsBuildSupportTrait;
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
                return $buildSmsData;
            } else {
                throw ParameterException::invalidArrtibuteType($key, "numeric", $value);
            }
        }
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
                return $buildSmsData;
            } else {
                $message = "Allowed can use Y-m-d h:i:s Or Y/m/d h:i:s Or timestamp ";
                throw ParameterException::invalidInput($key, "string", $value, $message);
            }
        }
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
            $buildSmsData = $this->stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc);
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
            $buildSmsData = $this->stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc);
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
            $buildSmsData = $this->stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData);
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
            return $buildSmsData;
        } else {
            $message = "this number not the correct:_".$result['mobile'];
            throw ParameterException::invalidInput("mobiles", "string", $this->getmobile(), $message);
        }
    }
    /**
     * This function get Category wise mobile Number
     * @param int $category
     *
     */
    protected function categoryWiseAddedMobile($category)
    {
        $value = '';
        if ($this->isKeyExists('mobile', $this->inputData) && $this->setMobile()) {
            $value = $this->getMobile();
            return $value;
        } else {
            $message = "Missing mobile key ";
            throw ParameterException::missinglogic($message);
        }
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
        $key = '';
        if ($category === 1) {
            $key = 'mobiles';
        } else {
            $key = 'mobile';
        }
        $value = $this->categoryWiseAddedMobile($category);
        $buildSmsData = $this->checkIntegerOrString($key, $value, $buildSmsData, $category);
        return $buildSmsData;
    }
    /**
     * This function check the content length
     *
     *
     */
    protected function checkContent($lenOfBulkSms,$bulkSms, $root, $category, $xmlDoc)
    {
        if ($lenOfBulkSms != 0) {
            for ($j = 0; $j < $lenOfBulkSms; $j++) {
                $this->inputData = $bulkSms[$j];
                $smsTag = $this->createElement($xmlDoc, "SMS", $root);
                //check message length
                $smsTag = $this->buildMessage($category, 'message', $smsTag, $xmlDoc);
                //check mobile contents
                $this->addMobileNumber($xmlDoc, $smsTag);
            }
        } else {
            $message = "content Empty";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * Add Content
     * 
     *
     */
    protected function addContent($root, $category, $xmlDoc)
    {
        if ($this->isKeyExists('content', $this->inputData) && $this->setContent()) {
            $bulkSms      = $this->getContent();
            $lenOfBulkSms = Validation::getSize($bulkSms);
            $this->checkContent($lenOfBulkSms,$bulkSms, $root, $category, $xmlDoc);            
        } else {
            $message = "content Must be present";
            throw ParameterException::missinglogic($message);
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
            return $buildSmsData;
        } else {
            $message = "Message Must be present";
            throw ParameterException::missinglogic($message);
        }
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
            return $buildSmsData;
        } else {
            $message = "Missing authkey";
            throw ParameterException::missinglogic($message);
        }
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
            return $buildSmsData;
        } else {
            $message = "Missing sender";
            throw ParameterException::missinglogic($message);
        }
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
