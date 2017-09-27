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

class SmsDefineClass
{
    use SmsBuildTrait;
    use SmsOtpCommonTrait;
    use SmsBuildSupportTrait;

    /**
     * @var int $mobile
     */
    protected $mobile = null;
    /**
     * @var array $inputData
     */
    protected $inputData = null;
    /**
     * @var string $authkey
     */
    protected $authkey = null;
    /**
     * @var array $sendData
     */
    protected $sendSmsData = null;
    /**
     * @var string $message
     */
    protected $message = null;
    /**
     * @var string|int $unicode
     */
    protected $unicode = null;
    /**
     * @var string $sender
     */
    protected $sender = null;
    /**
     * @var string|int $country
     */
    protected $country = null;
    /**
     * @var string $content
     */
    protected $content = null;
    /**
     * @var string|int $flash
     */
    protected $flash = null;
    /**
     * @var string $schtime
     */
    protected $schtime = null;
    /**
     * @var string $afterminutes
     */
    protected $afterminutes = null;
    /**
     * @var string $response
     */
    protected $response = null;
    /**
     * @var string $campaign
     */
    protected $campaign = null;

    /**
     * Check the mobilenumber empty
     * @return bool
     */
    public function hasMobileNumber()
    {
        $data = $this->inputData['mobile'];
        return isset($data);
    }
    /**
     * Check the data empty
     * @return bool
     */
    public function hasData()
    {
        return isset($this->inputData);
    }
    /**
     * Check the sendData empty
     * @return bool
     */
    public function hasSendData()
    {
        return isset($this->sendSmsData);
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
     * set content
     * @return bool
     */
    public function setContent()
    {
        $this->content = $this->inputData['content'];
        return true;
    }
    /*
     * get content
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * set mobile
     * @return bool
     */
    public function setMobile()
    {
        $this->mobile = $this->inputData['mobile'];
        return true;
    }
    /*
     * get mobile
     */
    public function getMobile()
    {
        return $this->mobile;
    }
    /**
     * set authkey
     * @return bool
     */
    public function setAuthKey()
    {
        $this->authkey = $this->inputData['authkey'];
        return true;
    }
    /*
     * get authkey
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }
    /**
     * set message
     * @return bool
     */
    public function setMessage()
    {
        $this->message = $this->inputData['message'];
        return true;
    }
    /*
     * get message
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * set unicode
     * @return bool
     */
    public function setUnicode()
    {
        $this->unicode = $this->inputData['unicode'];
        return true;
    }
    /*
     * get unicode
     */
    public function getUnicode()
    {
        return $this->unicode;
    }
    /**
     * set sender
     * @return bool
     */
    public function setSender()
    {
        $this->sender = $this->inputData['sender'];
        return true;
    }
    /*
     * get sender
     */
    public function getSender()
    {
        return $this->sender;
    }
    /**
     * set country
     * @return bool
     */
    public function setCountry()
    {
        $this->country = $this->inputData['country'];
        return true;
    }
    /*
     * get country
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * set flash
     * @return bool
     */
    public function setFlash()
    {
        $this->flash = $this->inputData['flash'];
        return true;
    }
    /*
     * get flash
     */
    public function getFlash()
    {
        return $this->flash;
    }
    /**
     * set schtime
     * @return bool
     */
    public function setSchtime()
    {
        $this->schtime = $this->inputData['schtime'];
        return true;
    }
    /*
     * get schtime
     */
    public function getSchtime()
    {
        return $this->schtime;
    }
    /**
     * set afterminutes
     * @return bool
     */
    public function setAfterminutes()
    {
        $this->afterminutes = $this->inputData['afterminutes'];
        return true;
    }
    /*
     * get afterminutes
     */
    public function getAfterminutes()
    {
        return $this->afterminutes;
    }
    /**
     * set response
     * @return bool
     */
    public function setResponse()
    {
        $this->response = $this->inputData['response'];
        return true;
    }
    /*
     * get response
     */
    public function getResponse()
    {
        return $this->response;
    }
    /**
     * set campaign
     * @return bool
     */
    public function setCampaign()
    {
        $this->campaign = $this->inputData['campaign'];
        return true;
    }
    /*
     * get campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
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
    protected function buildData($category, $key, $value, $buildSmsData, $xmlDoc = null, $isElement = null, $attr = null)
    {
        if ($category === 1) {
            $buildSmsData = $this->addArray($key, $value, $buildSmsData);
        } else {
            if ($isElement) {
                $childAttr = $xmlDoc->createAttribute($attr);
                $childText = $xmlDoc->createTextNode($this->getMessage());
                $buildSmsData->appendChild($childAttr)->appendChild($childText);
            } else {
                $buildSmsData = $this->addXml($buildSmsData, $xmlDoc, $key, $value);
            }
        }
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
}