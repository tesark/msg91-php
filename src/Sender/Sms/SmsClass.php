<?php
namespace Sender\Sms;

use Sender\Deliver;
use Sender\Validation;
use Sender\Sms\SmsBulk;
use Sender\Sms\SmsNormal;
use Sender\MobileNumber;
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

class SmsClass
{
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
     * Check string value
     * @param value
     * @return bool
     */
    public function isString($value)
    {
        $result = Validation::isString($value);
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
    /*
     * Check isvalid afterminutes 
     */
    public function isAfterMinutes($value)
    {
        $result = Validation::isVaildAfterMinutes($value);
        return $result;
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
     * This function get array the size
     * @param array $value
     *
     * return int Size fo the array
     */
    protected function getSize($value)
    {
        return sizeof($value);
    }
    /**
     * This function return String length
     * @param String $value
     *
     * @return int
     */
    protected function getLength($value)
    {
        return strlen($value);
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
            $value = $this->chackArray($value);
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
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
            $value = $this->chackArray($value);
            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
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
            if ($this->isString($value)) {
                $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
            } else {
                throw ParameterException::invalidArrtibuteType($key, "string", $value);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function simpliy SMS Sender to Array
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function simplifySender($category, $key, $buildSmsData, $xmlDoc, $value)
    {
        if ($this->isString($value)) {
            if (strlen($value) == 6) {
                $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
            } else {
                $message = "String length must be 6 characters";
                throw ParameterException::invalidInput("sender", "string", $value, $message);
            }
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
     *This function for simplify afterminutes
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     * @return array
     */
    protected function simplifyAfterMinutes($category, $key, $buildSmsData, $value)
    {
        if ($this->isInterger($value)) {
            if ($this->isAfterMinutes($value)) {
                $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData);
            } else {
                $message = "Allowed between 10 to 20000 mintutes";
                throw ParameterException::invalidInput("afterminutes", "int", $value, $message);
            }
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
    protected function simplifyResponse($category, $key, $buildSmsData, $value)
    {
        if ($this->isString($value)) {
            $responseFormat = array('xml', 'json');
            $responseVal = strtolower($value);
            $value = in_array($responseVal, $responseFormat) ? $responseVal : null;
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
            if ($this->isString($value)) {
                $buildSmsData = $this->simplifyResponse($category, $key, $buildSmsData, $value);
            } else {
                throw ParameterException::invalidArrtibuteType($key, "string", $value);
            }
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
            if ($this->isString($value)) {
                $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
            } else {
                throw ParameterException::invalidArrtibuteType($key, "string", $value);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function used to buils Data Arrtibutes are like
     * Country,Flash,Unicode,Schtime, campaign
     *
     * @param string $key
     * @param array $buildSmsData
     * @param int $array
     * @param array $xmlDoc
     *
     * @throws ParameterException missing parameters or type error
     */
    public function buildSmsDataArrtibutes($key, $buildSmsData, $category, $xmlDoc = null)
    {
        if ($this->isKeyPresent($key)) {
            switch ($key) {
                case 'country':
                    $buildSmsData = $this->buildCountry($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'flash':
                    $buildSmsData = $this->buildFlash($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'unicode':
                    $buildSmsData = $this->buildUnicode($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'schtime':
                    $buildSmsData = $this->buildSchtime($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'campaign':
                    $buildSmsData = $this->buildCampaign($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'sender':
                    $buildSmsData = $this->buildSmsSender($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'authkey':
                    $buildSmsData = $this->buildBulkAuth($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'afterminutes':
                    $buildSmsData = $this->buildAfterMinutes($category, $key, $buildSmsData);
                    break;
                case 'message':
                    $buildSmsData = $this->buildMessage($category, $key, $buildSmsData, $xmlDoc);
                    break;
                case 'response':
                    $buildSmsData = $this->buildResponse($category, $key, $buildSmsData);
                    break;
                default:
                    $message = "parameter".$key."Missing";
                    throw ParameterException::missinglogic($message);
                    break;
            }
        }
        return $buildSmsData;
    }
    /**
     * This function Check value 0 or 1
     *
     * @return int
     */
    protected function chackArray($value)
    {
        $responseFormat = array(0, 1);
        $value = in_array($value, $responseFormat) ? $value : null;
        return $value;
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
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or return empty
     * @return array $buildSmsData
     *
     */
    public function addMobile($buildSmsData, $category, $smsTag = null)
    {
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
     * @param array $buildSmsData
     *
     * @return $data
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
                $smsTag = $this->buildSmsDataArrtibutes('message', $smsTag, 2, $xmlDoc);
                //check mobile contents
                $this->addMobileNumber($xmlDoc, $smsTag);
            }
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
            if ($result && $result['value'] == true) {
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
        $buildSmsData = $this->buildSmsDataArrtibutes('message', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('authkey', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('sender', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('country', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('flash', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('unicode', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('schtime', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('afterminutes', $buildSmsData, $category);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('response', $buildSmsData, $category);
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
        $buildSmsData = $this->buildSmsDataArrtibutes('campaign', $buildSmsData, $category, $xmlDoc);
        return $buildSmsData;
    }
    /**
     * This function for Call buildSmsTransPromoCategory() function
     * @param  int|string $mobileNumber
     * @param  array $data
     * @param  int $category
     * @param  string $authKey
     *
     */
    public function smsCategory($mobileNumber, $data, $category, $authKey)
    {
        $normalSms = new SmsNormal();
        $response  = $normalSms->buildSmsTransPromoCategory($mobileNumber, $data, $category, $authKey);
        return $response;
    }
    /**
     * This function Used to send the SMS XML formated data to Deliver Class
     * @param array $xmlData
     *
     * @throws ParameterException missing parameters or type error
     * @return string MSG91
     */
    public function sendXmlSms($xmlData)
    {
        $bulkSms = new SmsBulk();
        $response  = $bulkSms->buildAndSendXmlSms($xmlData);
        return $response;
    }
}
