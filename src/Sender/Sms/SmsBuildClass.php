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
    public function addMobileNumber($xmlDoc, $smsTag)
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
    public function buildCountry($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildFlash($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildUnicode($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildSchtime($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildSmsSender($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildAfterMinutes($category, $key, $buildSmsData)
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
    public function buildMessage($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildResponse($category, $key, $buildSmsData)
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
    public function buildBulkAuth($category, $key, $buildSmsData, $xmlDoc)
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
    public function buildCampaign($category, $key, $buildSmsData, $xmlDoc)
    {
        if ($this->setCampaign()) {
            $value = $this->getCampaign();
            $buildSmsData = $this->stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
    /**
     * Add Content
     *
     *
     */
    public function addContent($root, $category, $xmlDoc)
    {
        if ($this->isKeyExists('content', $this->inputData) && $this->setContent()) {
            $bulkSms      = $this->getContent();
            $lenOfBulkSms = Validation::getSize($bulkSms);
            $this->checkContent($lenOfBulkSms, $bulkSms, $root, $category, $xmlDoc);
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
    public function addMessage($buildSmsData, $category, $xmlDoc = null)
    {
        $result = $this->keyPresent('message');
        if ($result) {
            $buildSmsData = $this->buildMessage($category, 'message', $buildSmsData, $xmlDoc);
            return $buildSmsData;
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
    public function addAuth($buildSmsData, $category, $xmlDoc = null)
    {
        $result = $this->keyPresent('authkey');
        if ($result) {
            $buildSmsData = $this->buildBulkAuth($category, 'authkey', $buildSmsData, $xmlDoc);
            return $buildSmsData;
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
    public function addSender($buildSmsData, $category, $xmlDoc = null)
    {
        $result = $this->keyPresent('sender');
        if ($result) {
            $buildSmsData = $this->buildSmsSender($category, 'sender', $buildSmsData, $xmlDoc);
            return $buildSmsData;
        }
    }
    /**
     * This function for sms array build with country
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     */
    public function addCountry($buildSmsData, $category, $xmlDoc = null)
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
    public function addFlash($buildSmsData, $category, $xmlDoc = null)
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
    public function addUnicode($buildSmsData, $category, $xmlDoc = null)
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
    public function addSchtime($buildSmsData, $category, $xmlDoc = null)
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
    public function addAfterMinutes($buildSmsData, $category)
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
    public function addResponse($buildSmsData, $category)
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
    public function addCampaign($buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent('campaign')) {
            $buildSmsData = $this->buildCampaign($category, 'campaign', $buildSmsData, $xmlDoc);
        }
        return $buildSmsData;
    }
}
