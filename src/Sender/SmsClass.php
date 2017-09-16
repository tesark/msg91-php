<?php
namespace Sender;

use Sender\Deliver;
use Sender\Validation;
use Sender\MobileNumber;
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
     * @var string|int|array $InputData
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
     * Check the Auth key existes in array
     * @return bool
     */
    public function isAuthKeyExists()
    {
        return array_key_exists("authkey", $this->inputData);
    }
    /**
     * Check the message key existes in array
     * @return bool
     */
    public function isMessageKeyExists()
    {
        return array_key_exists("message", $this->inputData);
    }
    /**
     * Check the unicode key existes in array
     * @return bool
     */
    public function isUnicodeKeyExists()
    {
        return array_key_exists("unicode", $this->inputData);
    }
    /**
     * Check the sender key existes in array
     * @return bool
     */
    public function isSenderKeyExists()
    {
        return array_key_exists("sender", $this->inputData);
    }
    /**
     * Check the country key existes in array
     * @return bool
     */
    public function isCountryKeyExists()
    {
        return array_key_exists("country", $this->inputData);
    }
    /**
     * Check the flash key existes in array
     * @return bool
     */
    public function isFlashKeyExists()
    {
        return array_key_exists("flash", $this->inputData);
    }
    /**
     * Check the schtime key existes in array
     * @return bool
     */
    public function isSchtimeKeyExists()
    {
        return array_key_exists("schtime", $this->inputData);
    }
    /**
     * Check the afterminutes key existes in array
     * @return bool
     */
    public function isAfterMinutesKeyExists()
    {
        return array_key_exists("afterminutes", $this->inputData);
    }
    /**
     * Check the response key existes in array
     * @return bool
     */
    public function isResponseKeyExists()
    {
        return array_key_exists("response", $this->inputData);
    }
    /**
     * Check the campaign key existes in array
     * @return bool
     */
    public function isCampaignKeyExists()
    {
        return array_key_exists("campaign", $this->inputData);
    }
    /**
     * Check the response key existes in array
     * @return bool
     */
    public function isContentKeyExists()
    {
        return array_key_exists("content", $this->inputData);
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
                $message = "this number not the correct:__".$result['mobile'];
                throw ParameterException::invalidInput("mobiles", "string", $this->mobiles, $message);
            }
        } else {
            $message = "interger or string comma seperate values";
            throw ParameterException::invalidInput("mobiles", "string or integer", $this->mobiles, $message);
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
        if ($this->isMessageKeyExists() && $this->setMessage()) {
            if ($this->isString($this->getMessage())) {
                if (!$this->isUnicodeKeyExists()) {
                    if (strlen($this->getMessage()) <= 160) {
                        $buildSmsData += ['message' => $this->getMessage()];
                    } else {
                        $message = "allowed below 160 cheracters,but given length:_".strlen($this->getMessage());
                        throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
                    }
                } elseif ($this->isUnicodeKeyExists()) {
                    if (strlen($this->getMessage()) <= 70) {
                        $buildSmsData += ['message' => $this->getMessage()];
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
        return $buildSmsData;
    }
    /**
     * This function for sms array Build with sender
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addSender($buildSmsData)
    {
        if ($this->isSenderKeyExists() && $this->setSender()) {
            if ($this->isString($this->getSender())) {
                if (strlen($this->getSender()) == 6) {
                    $buildSmsData += ['sender' => $this->getSender()];
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
     * This function for sms array build with country
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addCountry($buildSmsData)
    {
        if ($this->isCountryKeyExists() && $this->setCountry()) {
            if ($this->isNumeric($this->getCountry())) {
                $buildSmsData += ['country' => $this->getCountry()];
            } else {
                throw ParameterException::invalidArrtibuteType("country", "numeric", $this->getCountry());
            }
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with flash
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addFlash($buildSmsData)
    {
        if ($this->isFlashKeyExists() && $this->setFlash()) {
            $responseFormat = array(0, 1);
            $value = in_array($this->getFlash(), $responseFormat) ? $this->getFlash() : null;
            $buildSmsData += ['flash' => $value];
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with flash
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addUnicode($buildSmsData)
    {
        if ($this->isUnicodeKeyExists() && $this->setUnicode()) {
            $responseFormat = array(0, 1);
            $value = in_array(strtolower($this->getUnicode()), $responseFormat) ? $this->getUnicode() : null;
            $buildSmsData += ['unicode' => $value];
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with schtime
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addSchtime($buildSmsData)
    {
        if ($this->isSchtimeKeyExists() && $this->setSchtime()) {
            if ($this->isVaildDateTime($this->getSchtime())) {
                $buildSmsData += ['schtime' => $this->getSchtime()];
            } else {
                $message = "Allowed can use Y-m-d h:i:s Or Y/m/d h:i:s Or timestamp ";
                throw ParameterException::invalidInput("schtime", "string", $this->getSchtime(), $message);
            }
        }
        return $buildSmsData;
    }
    /**
     * This function for sms array build with
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     *
     */
    public function addAfterMinutes($buildSmsData)
    {
        if ($this->isAfterMinutesKeyExists() && $this->setAfterminutes()) {
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
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     */
    public function addResponse($buildSmsData)
    {
        if ($this->isResponseKeyExists() && $this->setResponse()) {
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
     * @param  array $buildSmsData
     *
     * @throws ParameterException missing parameters or tpye error
     * @return array $buildSmsData
     */
    public function addCampaign($buildSmsData)
    {
        if ($this->isCampaignKeyExists() && $this->setCampaign()) {
            if ($this->isString($this->getCampaign())) {
                $buildSmsData += ['campaign' => $this->getCampaign()];
            } else {
                throw ParameterException::invalidArrtibuteType("campaign", "string", $this->getCampaign());
            }
        }
        return $buildSmsData;
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
    public function sendSms($mobileNumber, $data, $sendData)
    {
        $this->mobiles     = $mobileNumber;
        $this->inputData   = $data;
        $this->sendSmsData = $sendData;
        //this condition are check and parameters are added to buildSmsData array
        if ($this->hasMobileNumber() && $this->hasData() && $this->hasSendData()) {
            $buildSmsData = $sendData;
            for ($i = 0; $i < sizeof($this->inputData); $i++) {
                $buildSmsData = $this->addMobile($buildSmsData);
                $buildSmsData = $this->addMessage($buildSmsData);
                $buildSmsData = $this->addSender($buildSmsData);
                $buildSmsData = $this->addCountry($buildSmsData);
                $buildSmsData = $this->addFlash($buildSmsData);
                $buildSmsData = $this->addUnicode($buildSmsData);
                $buildSmsData = $this->addSchtime($buildSmsData);
                $buildSmsData = $this->addAfterMinutes($buildSmsData);
                $buildSmsData = $this->addResponse($buildSmsData);
                $buildSmsData = $this->addCampaign($buildSmsData);
            }
            if ((sizeof($data)+3) == sizeof($buildSmsData)) {
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
            if ($this->isAuthKeyExists() && $this->setAuthKey()) {
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
            if ($this->isSenderKeyExists() && $this->setSender()) {
                if ($this->isString($this->getSender())) {
                    if (strlen($this->getSender()) == 6) {
                        //create a Sender element
                        $root->appendChild($xmlDoc->createElement("SENDER", $this->getSender()));
                    } else {
                        $message = "String length must be 6 characters";
                        throw ParameterException::invalidInput("sender", "string", $this->getSender(), $message);
                    }
                } else {
                    throw ParameterException::invalidArrtibuteType("message", "string", $this->getSender());
                }
            }
            /**
             *Check schtime
             *
             */
            if ($this->isSchtimeKeyExists() && $this->setSchtime()) {
                if ($this->isVaildDateTime($this->getSchtime())) {
                    //create a schtime element
                    $root->appendChild($xmlDoc->createElement("SCHEDULEDATETIME", $this->getSchtime()));
                } else {
                    $message = "Allowed can use Y-m-d h:i:s Or Y/m/d h:i:s Or timestamp ";
                    throw ParameterException::invalidInput("schtime", "string", $this->getSchtime(), $message);
                }
            }
            /**
             *Check campaign
             *
             */
            if ($this->isCampaignKeyExists() && $this->setCampaign()) {
                if ($this->isString($this->getCampaign())) {
                    //create a campaign element
                    $root->appendChild($xmlDoc->createElement("CAMPAIGN", $this->getCampaign()));
                } else {
                    throw ParameterException::invalidArrtibuteType("campaign", "string", $this->getCampaign());
                }
            }
            /**
             *Check country
             *
             */
            if ($this->isCountryKeyExists() && $this->setCountry()) {
                if ($this->isNumeric($this->getCountry())) {
                    //create a country element
                    $root->appendChild($xmlDoc->createElement("COUNTRY", $this->getCountry()));
                } else {
                    throw ParameterException::invalidArrtibuteType("country", "numeric", $this->getCountry());
                }
            }
            /**
             * Check flash
             *
             */
            if ($this->isFlashKeyExists() && $this->setFlash()) {
                $responseFormat = array(0, 1);
                $value = in_array($this->getFlash(), $responseFormat) ? $this->getFlash() : null;
                //create a flash element
                $root->appendChild($xmlDoc->createElement("FLASH", $value));
            }
            /**
             *Check unicode
             *
             */
            if ($this->isUnicodeKeyExists() && $this->setUnicode()) {
                $responseFormat = array(0, 1);
                $value = in_array(strtolower($this->getUnicode()), $responseFormat) ? $this->getUnicode() : null;
                //create a unicode element
                $root->appendChild($xmlDoc->createElement("UNICODE", $value));
            }
            if ($this->isContentKeyExists() && $this->setContent()) {
                $bulkSms      = $this->getContent();
                $lenOfBulkSms = sizeof($bulkSms);
                for ($j = 0; $j < $lenOfBulkSms; $j++) {
                    $this->inputData = $bulkSms[$j];
                    $smsTag = $root->appendChild($xmlDoc->createElement("SMS"));
                    //check message length
                    if ($this->isMessageKeyExists() && $this->setMessage()) {
                        if ($this->isString($this->getMessage())) {
                            if (!$this->isUnicodeKeyExists()) {
                                if (strlen($this->getMessage()) <= 160) {
                                    $childAttr = $xmlDoc->createAttribute("TEXT");
                                    $childText = $xmlDoc->createTextNode($this->getMessage());
                                    $smsTag->appendChild($childAttr)->appendChild($childText);
                                } else {
                                    $message = "allowed below 160 cheracters,but given length:_".strlen($this->getMessage());
                                    throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
                                }
                            } elseif ($this->isUnicodeKeyExists()) {
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
                            for ($k = 0; $k < sizeof($mobiles); $k++) {
                                $addressTag = $smsTag->appendChild($xmlDoc->createElement("ADDRESS"));
                                $childAttr = $xmlDoc->createAttribute("TO");
                                $childText = $xmlDoc->createTextNode($mobiles[$k]);
                                $addressTag->appendChild($childAttr)->appendChild($childText);
                            }
                        } else {
                            $message = "this number not the correct:__".$result['mobile'];
                            throw ParameterException::invalidInput("mobiles", "string", $this->getmobile(), $message);
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
