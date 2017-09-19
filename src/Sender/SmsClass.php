<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
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
     * @var string $Mobiles
     */
    protected $mobiles = null;
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
        return isset($this->mobiles);
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
     * Check the hasXmlData empty
     * @return bool
     */
    public function hasXmlData()
    {
        return isset($this->inputData);
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
     * set mobiles
     * @return bool
     */
    public function setMobiles()
    {
        $this->mobiles = $this->mobiles;
        return true;
    }
    /*
     * get mobiles
     */
    public function getMobiles()
    {
        return $this->mobiles;
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
     * This function throw mobile invalid Exception
     * @param int|string $mobiles
     * @param string     $result
     * @throws ParameterException missing parameters or return empty
     */
    protected function invalidMobileException($mobiles, $result)
    {
        $message = "this number not the correct:__".$result;
        throw ParameterException::invalidInput("mobiles", "string", $mobiles, $message);
    }
    /**
     * This function for sms array Build with mobilenumbers
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or return empty
     * @return array $buildSmsData
     *
     */
    public function addMobile($buildSmsData)
    {
        if ($this->isInterger($this->mobiles)) {
            $buildSmsData += ['mobiles' => $this->mobiles];
        } elseif ($this->isString($this->mobiles)) {
            $result = $this->isValidNumber($this->mobiles);
            if (!empty($result) && $result['value'] == true) {
                $buildSmsData += ['mobiles' => $this->mobiles];
            } else {
                $this->invalidMobileException($this->mobiles, $result['mobile']);
            }
        } else {
            $message = "interger or string comma seperate values";
            throw ParameterException::invalidInput("mobiles", "string or integer", $this->mobiles, $message);
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
    protected function checkMessageLength($buildSmsData, $limit)
    {
        if (strlen($this->getMessage()) <= $limit) {
            $buildSmsData += ['message' => $this->getMessage()];
        } else {
            $message = "allowed below ".$limit." cheracters,but given length:_".strlen($this->getMessage());
            throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array Build with message
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or return empty
     * @return array $buildSmsData
     */
    public function addMessage($buildSmsData)
    {
        if ($this->isKeyExists('message', $this->inputData) && $this->setMessage()) {
            if ($this->isString($this->getMessage())) {
                if (!$this->isKeyExists('unicode', $this->inputData)) {
                    $buildSmsData = $this->checkMessageLength($buildSmsData, 160);
                } elseif ($this->isKeyExists('unicode', $this->inputData)) {
                    $buildSmsData = $this->checkMessageLength($buildSmsData, 70);
                }
            } else {
                $message = "string values only accept";
                throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
            }
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
        if ($this->isKeyExists('sender', $this->inputData) && $this->setSender()) {
            if ($this->isString($this->getSender())) {
                if (strlen($this->getSender()) == 6) {
                    if ($category === 1) {
                        $buildSmsData += ['sender' => $this->getSender()];
                    } else {
                        $buildSmsData->appendChild($xmlDoc->createElement("SENDER", $this->getSender()));
                    }
                } else {
                    $message = "String length must be 6 characters";
                    throw ParameterException::invalidInput("sender", "string", $this->getSender(), $message);
                }
            } else {
                throw ParameterException::invalidArrtibuteType("message", "string", $this->getSender());
            }
        }
        return $buildSmsData;
    }
    /**
     * This function used to buils Data Arrtibutes are like
     * Country,Flash,Unicode,Schtime, campaign
     *
     * @param string $key
     * @param int|string|array $buildSmsData
     * @param int $array
     * @param array $xmlDoc
     *
     * @throws ParameterException missing parameters or type error
     */
    public function buildDataArrtibutes($key, $buildSmsData, $category, $xmlDoc = null)
    {   
        if ($this->isKeyPresent($key)) {
            switch ($key) {
                case 'country':
                    if ($this->setCountry()) {
                        $value = $this->getCountry();
                        if ($this->isNumeric($value)) {
                            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
                        } else {
                            throw ParameterException::invalidArrtibuteType($key, "numeric", $value);
                        }
                    }
                    break;
                case 'flash':
                    if ($this->setFlash()) {
                        $value = $this->getFlash();
                        $value = $this->chackArray($value);
                        $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
                    }
                    break;
                case 'unicode':
                    if ($this->setUnicode()) {
                        $value = $this->getUnicode();
                        $value = $this->chackArray($value);
                        $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
                    }
                    break; 
                case 'schtime':
                    if ($this->setSchtime()) {
                        $value = $this->getSchtime();
                        if ($this->isVaildDateTime($value)) {
                            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
                        } else {
                            $message = "Allowed can use Y-m-d h:i:s Or Y/m/d h:i:s Or timestamp ";
                            throw ParameterException::invalidInput($key, "string", $value, $message);
                        }
                    }
                    break;
                case 'campaign':
                    if ($this->setCampaign()) {
                        $value = $this->getCampaign();
                        if ($this->isString($value)) {
                            $buildSmsData = $this->buildData($category, $key, $value, $buildSmsData, $xmlDoc);
                        } else {
                            throw ParameterException::invalidArrtibuteType($key, "string", $value);
                        }
                    }
                    break;
                default:
                    $message = "parameter key Missing";
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
     * This function for buildData
     *
     *
     */
    protected function buildData($category, $key, $value, $buildSmsData, $xmlDoc = null)
    {
        if ($category === 1) {
            $buildSmsData = $this->addArray($key, $value, $buildSmsData);
        } else {
            $buildSmsData = $this->addXml($buildSmsData, $xmlDoc, $key, $value);
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
     * This function for sms array build with country
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $root
     */
    public function addCountry($buildSmsData, $category, $xmlDoc = null)
    {
        $buildSmsData = $this->buildDataArrtibutes('country', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildDataArrtibutes('flash', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildDataArrtibutes('unicode', $buildSmsData, $category, $xmlDoc);
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
        $buildSmsData = $this->buildDataArrtibutes('schtime', $buildSmsData, $category, $xmlDoc);
        return $buildSmsData;
    }
    /**
     * This function for sms array build with
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addAfterMinutes($buildSmsData)
    {
        if ($this->isKeyExists('afterminutes', $this->inputData) && $this->setAfterminutes()) {
            if ($this->isInterger($this->getAfterminutes())) {
                if ($this->isAfterMinutes($this->getAfterminutes())) {
                    $buildSmsData += ['afterminutes' => $this->getAfterminutes()];
                } else {
                    $message = "Allowed between 10 to 20000 mintutes";
                    throw ParameterException::invalidInput("afterminutes", "int", $this->getAfterminutes(), $message);
                }
            } else {
                throw ParameterException::invalidArrtibuteType("afterminutes", "int", $this->getAfterminutes());
            }
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with Response
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     */
    public function addResponse($buildSmsData)
    {
        if ($this->isKeyExists('response', $this->inputData) && $this->setResponse()) {
            if ($this->isString($this->getResponse())) {
                $responseFormat = array('xml', 'json');
                $responseVal = strtolower($this->getResponse());
                $value = in_array($responseVal, $responseFormat) ? $responseVal : null;
                $buildSmsData += ['response' => $value];
            } else {
                throw ParameterException::invalidArrtibuteType("response", "string", $this->getResponse());
            }
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
        $buildSmsData = $this->buildDataArrtibutes('campaign', $buildSmsData, $category, $xmlDoc);
        return $buildSmsData;
    }
    /**
     * This function Category to send SMS
     * @param  int|string $mobileNumber
     * @param  array $data
     * @param  int $category
     * @param  string $authKey
     *
     * @return string
     */
    public function smsCategory($mobileNumber, $data, $category, $authKey)
    {   
        $transAuthKey = null;
        $promoAuthKey = null;
        $checkAuth = Validation::isAuthKey($authKey);
        if (!$checkAuth) {
            // Get Envirionment variable and config file values
            $config          = new ConfigClass();
            $container       = $config->getDefaults();
            $commonValue     = $container['common'];
            $transAuthKey    = $commonValue['transAuthKey'];
            $promoAuthKey    = $commonValue['promoAuthKey']; 
        }
        if ($category === 1) {
            //transactional SMS content
            $sendData = array(
                'authkey'     => $checkAuth ? $authKey : $transAuthKey,
                'route'       => 4,
            );
        } else {
            $sendData = array(
                'authkey'     => $checkAuth ? $authKey : $promoAuthKey,
                'route'       => 1,
            );
        }
        $output = $this->sendSms($mobileNumber, $data, $sendData);
        return $output;
    }
    /**
     * This function Used to send the SMS data to Deliver Class
     * @param string|int $mobileNumber
     * @param array $data
     * @param array $sendData
     *
     * @throws ParameterException missing parameters or type error
     * @return string
     */
    protected function sendSms($mobileNumber, $data, $sendData)
    {
        $this->mobiles     = $mobileNumber;
        $this->inputData   = $data;
        $this->sendSmsData = $sendData;
        //this condition are check and parameters are added to buildSmsData array
        if ($this->hasMobileNumber() && $this->hasData() && $this->hasSendData()) {
            $buildSmsData = $sendData;
            $len = sizeof($this->inputData);
            for ($i = 0; $i < $len; $i++) {
                $buildSmsData = $this->addMobile($buildSmsData);
                $buildSmsData = $this->addMessage($buildSmsData);
                $buildSmsData = $this->addSender($buildSmsData, 1);
                $buildSmsData = $this->addCountry($buildSmsData, 1);
                $buildSmsData = $this->addFlash($buildSmsData, 1);
                $buildSmsData = $this->addUnicode($buildSmsData, 1);
                $buildSmsData = $this->addSchtime($buildSmsData, 1);
                $buildSmsData = $this->addAfterMinutes($buildSmsData);
                $buildSmsData = $this->addResponse($buildSmsData);
                $buildSmsData = $this->addCampaign($buildSmsData, 1);
            }
            $inputDataLen     = sizeof($data);
            $buildDataLen     = sizeof($buildSmsData);
            if ($inputDataLen+3 == $buildDataLen) {
                $uri      = "sendhttp.php";
                $delivery = new Deliver();
                $response = $delivery->sendOtpGet($uri, $buildSmsData);
                return $response;
            } else {
                throw ParameterException::missinglogic("Check Input parameters, something wrong");
            }
        } else {
            $message = "parameters Missing";
            throw ParameterException::missinglogic($message);
        }
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
        $this->inputData = $xmlData;
        if ($this->hasXmlData()) {
            //create the xml document
            $xmlDoc = new \DOMDocument();
            //create the root element
            $root = $xmlDoc->appendChild($xmlDoc->createElement("MESSAGE"));
            /**
             *check Auth
             *
             */
            if ($this->isKeyExists('authkey', $this->inputData) && $this->setAuthKey()) {
                if ($this->isString($this->getAuthKey())) {
                    //create a element
                    $root->appendChild($xmlDoc->createElement("AUTHKEY", $this->getAuthKey()));
                } else {
                    throw ParameterException::invalidArrtibuteType("authkey", "string", $this->getAuthKey());
                }
            }
            /**
             *Check Sender
             *
             */
            $root = $this->addSender($root, 2, $xmlDoc);
            /**
             *Check schtime
             *
             */
            $root = $this->addSchtime($root, 2, $xmlDoc);
            /**
             *Check campaign
             *
             */
            $root = $this->addCampaign($root, 2, $xmlDoc);
            /**
             *Check country
             *
             */
            $root = $this->addCountry($root, 2, $xmlDoc);
            /**
             * Check flash
             *
             */
            $root = $this->addFlash($root, 2, $xmlDoc);
            /**
             * Check unicode
             *
             */
            $root = $this->addUnicode($root, 2, $xmlDoc);
            if ($this->isKeyExists('content', $this->inputData) && $this->setContent()) {
                $bulkSms      = $this->getContent();
                $lenOfBulkSms = sizeof($bulkSms);
                for ($j = 0; $j < $lenOfBulkSms; $j++) {
                    $this->inputData = $bulkSms[$j];
                    $smsTag = $root->appendChild($xmlDoc->createElement("SMS"));
                    //check message length
                    if ($this->isKeyExists('message', $this->inputData) && $this->setMessage()) {
                        if ($this->isString($this->getMessage())) {
                            if (!$this->isKeyExists('unicode', $this->inputData)) {
                                if (strlen($this->getMessage()) <= 160) {
                                    $childAttr = $xmlDoc->createAttribute("TEXT");
                                    $childText = $xmlDoc->createTextNode($this->getMessage());
                                    $smsTag->appendChild($childAttr)->appendChild($childText);
                                } else {
                                    $message = "allowed below 160 cheracters,but given length:_".strlen($this->getMessage());
                                    throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
                                }
                            } elseif ($this->isKeyExists('unicode', $this->inputData)) {
                                if (strlen($this->getMessage()) <= 70) {
                                    $child = $xmlDoc->createTextNode($this->getMessage());
                                    $smsTag->appendChild($xmlDoc->createAttribute("TEXT"))->appendChild($child);
                                } else {
                                    $message = "allowed below 70 cheracter using unicode, but given:__".strlen($this->getMessage());
                                    throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
                                }
                            }
                        } else {
                            $message = "string values only accept";
                            throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
                        }
                    }
                    //check mobile contents
                    if ($this->setMobile() && $this->isString($this->getmobile())) {
                        $result = $this->isValidNumber($this->getmobile());
                        if ($result && $result['value'] == true) {
                            $mobiles = $result['mobile'];
                            $len = sizeof($mobiles);
                            for ($k = 0; $k < $len; $k++) {
                                $addressTag = $smsTag->appendChild($xmlDoc->createElement("ADDRESS"));
                                $childAttr = $xmlDoc->createAttribute("TO");
                                $childText = $xmlDoc->createTextNode($mobiles[$k]);
                                $addressTag->appendChild($childAttr)->appendChild($childText);
                            }
                        } else {
                            $this->invalidMobileException($this->getmobile(), $result['mobile']);
                        }
                    } else {
                        $message = "string comma seperate values";
                        throw ParameterException::invalidInput("mobiles", "string or integer", $this->getmobile(), $message);
                    }
                }
            }
        } else {
            $message = "parameters Missing";
            throw ParameterException::missinglogic($message);
        }
        header("Content-Type: text/xml");
        //make the output pretty
        $xmlDoc->formatOutput = true;
        $xmlData  = $xmlDoc->saveXML();
        $uri      = "postsms.php";
        $delivery = new Deliver();
        $response = $delivery->sendSmsPost($uri, $xmlData);
        return $response;
    }
}
