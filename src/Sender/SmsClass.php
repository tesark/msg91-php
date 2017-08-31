<?php
namespace Sender;

use Sender\Validation;
use Sender\MobileNumber;
use Sender\Exception\ParameterException;

/**
*
*/
class SmsClass
{
    /*
    *Mobile number is intger or string type
    */
    protected $mobiles     = null;
    /*
    *InputData is array type
    */
    protected $inputData   = null;
    /*
    *sendData is array type
    */
    protected $sendSmsData = null;
    /*
    *sendData 
    */
    protected $message = null;
    /*
    *unicode 
    */
    protected $unicode = null;
    /*
    *sender 
    */
    protected $sender = null;
    /*
    *country 
    */
    protected $country = null;
    /*
    *flash 
    */
    protected $flash = null;
    /*
    *schtime 
    */
    protected $schtime = null;
    /*
    *afterminutes 
    */
    protected $afterminutes = null;

    /*
    * Check the mobilenumber empty
    */
    public function hasMobileNumber()
    {
        return isset($this->mobiles);
    }
    /*
    * Check the data empty
    */
    public function hasData()
    {
        return isset($this->inputData);
    }
    /*
    * Check the sendData empty
    */
    public function hasSendData()
    {
        return isset($this->sendSmsData);
    }
    /*
    * Check the message key existes in array
    */
    public function isMessageKeyExists()
    {
        return array_key_exists("message", $this->inputData);
    }
    /*
    * Check the unicode key existes in array
    */
    public function isUnicodeKeyExists()
    {
        return array_key_exists("unicode", $this->inputData);
    }
    /*
    * Check the sender key existes in array
    */
    public function isSenderKeyExists()
    {
        return array_key_exists("sender", $this->inputData);
    }
    /*
    * Check the country key existes in array
    */
    public function isCountryKeyExists()
    {
        return array_key_exists("country", $this->inputData);
    }
    /*
    * Check the flash key existes in array
    */
    public function isFlashKeyExists()
    {
        return array_key_exists("flash", $this->inputData);
    }
    /*
    * Check the schtime key existes in array
    */
    public function isSchtimeKeyExists()
    {
        return array_key_exists("schtime", $this->inputData);
    }
    /*
    * Check the afterminutes key existes in array
    */
    public function isAfterMinutesKeyExists()
    {
        return array_key_exists("afterminutes", $this->inputData);
    }
    /*
    * Check the response key existes in array
    */
    public function isResponseKeyExists()
    {
        return array_key_exists("response", $this->inputData);
    }
    /*
    * Check the campaign key existes in array
    */
    public function isCampaignKeyExists()
    {
        return array_key_exists("campaign", $this->inputData);
    }
    /*
    * set mobiles
    */
    public function setMobiles()
    {
        $this->mobiles =  $this->mobiles;
        return true;
    }
    /*
    * get mobiles
    */
    public function getMobiles()
    {
        return $this->mobiles;
    }
    /*
    * set message
    */
    public function setMessage()
    {
        $this->message =  $this->inputData['message'];
        return true;
    }
    /*
    * get message
    */
    public function getMessage()
    {
        return $this->message;
    }
    /*
    * set unicode
    */
    public function setUnicode()
    {
        $this->unicode =  $this->inputData['unicode'];
        return true;
    }
    /*
    * get unicode
    */
    public function getUnicode()
    {
        return $this->unicode;
    }
    /*
    * set sender
    */
    public function setSender()
    {
        $this->sender =  $this->inputData['sender'];
        return true;
    }
    /*
    * get sender
    */
    public function getSender()
    {
        return $this->sender;
    }
    /*
    * set country
    */
    public function setCountry()
    {
        $this->country =  $this->inputData['country'];
        return true;
    }
    /*
    * get country
    */
    public function getCountry()
    {
        return $this->country;
    }
    /*
    * set flash
    */
    public function setFlash()
    {
        $this->flash =  $this->inputData['flash'];
        return true;
    }
    /*
    * get flash
    */
    public function getFlash()
    {
        return $this->flash;
    }
    /*
    * set schtime
    */
    public function setSchtime()
    {
        $this->schtime =  $this->inputData['schtime'];
        return true;
    }
    /*
    * get schtime
    */
    public function getSchtime()
    {
        return $this->schtime;
    }
    /*
    * set afterminutes
    */
    public function setAfterminutes()
    {
        $this->afterminutes =  $this->inputData['afterminutes'];
        return true;
    }
    /*
    * get afterminutes
    */
    public function getAfterminutes()
    {
        return $this->afterminutes;
    }
    /*
    * set response
    */
    public function setResponse()
    {
        $this->response =  $this->inputData['response'];
        return true;
    }
    /*
    * get response
    */
    public function getResponse()
    {
        return $this->response;
    }
    /*
    * set campaign
    */
    public function setCampaign()
    {
        $this->campaign =  $this->inputData['campaign'];
        return true;
    }
    /*
    * get campaign
    */
    public function getCampaign()
    {
        return $this->campaign;
    }
    /*
    * Check integer value 
    */
    public function isInterger($value)
    {
        $result = Validation::isInteger($value);
        return $result;
    }
    /*
    * Check string value 
    */
    public function isString($value)
    {
        $result = Validation::isString($value);
        return $result;
    }
    /*
    * Check numeric value 
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
    /*
    *Check vaild Date Time
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
    /*
    *This function for sms array Build with mobilenumbers 
    *
    */
    public function addMobile($buildSmsData)
    {
        if ($this->isInterger($this->mobiles)) {
            $buildSmsData += ['mobiles' => $this->mobiles];
        } elseif ($this->isString($this->mobiles)) {
            $result = $this->isValidNumber($this->mobiles);
            if ($result['value'] == true) {
                $buildSmsData += ['mobiles' => $this->mobiles];
            } else {
                $message = "this number not the correct:__". $result['mobile'];
                throw ParameterException::invalidInput("mobiles", "string", $this->mobiles, $message);
            }
        } else {
            $message = "interger or string comma seperate values";
            throw ParameterException::invalidInput("mobiles", "string or integer", $this->mobiles, $message);
        }
        return $buildSmsData;
    }
    /*
    *This function for sms array Build with message 
    *
    */
    public function addMessage($buildSmsData)
    {
        if ($this->isMessageKeyExists() && $this->setMessage()) {
            if ($this->isString($this->getMessage())) {
                if (!$this->isUnicodeKeyExists()) {
                    if (strlen($this->getMessage()) <= 160) {
                        $buildSmsData += ['message' => $this->getMessage()];
                    } else {
                        $message = "allowed below 160 cheracters,but given length:_". strlen($this->getMessage());
                        throw ParameterException::invalidInput("message", "string", $this->getMessage(), $message);
                    }
                } elseif ($this->isUnicodeKeyExists()) {
                    if (strlen($this->getMessage()) <= 70) {
                        $buildSmsData += ['message' => $this->getMessage()];
                    } else {
                        $message = "allowed below 70 cheracter using unicode, but given:__". strlen($this->getMessage());
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
    /*
    *This function for sms array Build with sender
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
    /*
    *This function for sms array build with country
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
    /*
    *This function for sms array build with flash
    *
    */
    public function addFlash($buildSmsData)
    {
        if ($this->isFlashKeyExists() && $this->setFlash()) {
            $responseFormat =  array(0,1);
            $value = in_array($this->getFlash(), $responseFormat)? $this->getFlash() : null;
            $buildSmsData += ['flash' => $this->getFlash()];
        }
        return $buildSmsData;
    }
    /*
    *This function for sms array build with flash
    *
    */
    public function addUnicode($buildSmsData)
    {
        if ($this->isUnicodeKeyExists() && $this->setUnicode()) {
            $responseFormat =  array(0,1);
            $value = in_array(strtolower($this->getUnicode()), $responseFormat) ? $this->getUnicode() : null;
            $buildSmsData += ['unicode' => $this->getUnicode()];
        }
        return $buildSmsData;
    }
    /*
    *This function for sms array build with schtime
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
    /*
    *This function for sms array build with 
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
    /*
    *This function for sms array build with Response
    *
    */    
    public function addResponse($buildSmsData)
    {
        if ($this->isResponseKeyExists() && $this->setResponse()) {
            if ($this->isString($this->getResponse())) {
                $responseFormat =  array('xml','json');
                $responseVal = strtolower($this->getResponse());
                $value = in_array($responseVal, $responseFormat) ? $responseVal:null;
                $buildSmsData += ['response' => $this->getResponse()];
            } else {
                throw ParameterException::invalidArrtibuteType("response", "string", $this->getResponse());
            }
        }
        return $buildSmsData;
    }
    /*
    *This function for sms array build with 
    *
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

    public function buildSmsDataArray($mobileNumber, $data, $sendData)
    {
        $this->mobiles     = $mobileNumber;
        $this->inputData   = $data;
        $this->sendSmsData = $sendData;
        var_dump("----test----");
        //this condition are check and parameters are added to buildSmsData array
        if ($this->hasMobileNumber() && $this->hasMobileNumber() && $this->hasMobileNumber()) {
            $buildSmsData = $sendData;
            for ($i = 0; $i<sizeof($this->inputData); $i++) {
                $buildSmsData =  $this->addMobile($buildSmsData);
                $buildSmsData =  $this->addMessage($buildSmsData);
                $buildSmsData =  $this->addSender($buildSmsData);
                $buildSmsData =  $this->addCountry($buildSmsData);
                $buildSmsData =  $this->addFlash($buildSmsData);
                $buildSmsData =  $this->addUnicode($buildSmsData);
                $buildSmsData =  $this->addSchtime($buildSmsData);
                $buildSmsData =  $this->addAfterMinutes($buildSmsData);
                $buildSmsData =  $this->addResponse($buildSmsData);
                $buildSmsData =  $this->addCampaign($buildSmsData);
            }
        } else {
            $message = "parameters Missing";
            throw ParameterException::missinglogic($message);
        }
        return $buildSmsData;
    }
    //build xml format
    public static function buildXmlData($xmlData)
    {
        $currentArray = $xmlData;
        //create the xml document
        $xmlDoc = new \DOMDocument();
        //create the root element
        $root = $xmlDoc->appendChild($xmlDoc->createElement("MESSAGE"));
        //check Auth
        if (array_key_exists('authkey', $currentArray) && is_string($currentArray['authkey'])) {
            //create a element
            $authTag = $root->appendChild($xmlDoc->createElement("AUTHKEY", $currentArray['authkey']));
        }
        //Check Sender
        if (array_key_exists("sender", $currentArray)) {
            if (is_string($currentArray['sender'])) {
                if (strlen($currentArray['sender']) == 6) {
                    //create a element
                    $senderTag = $root->appendChild($xmlDoc->createElement("SENDER", $currentArray['sender']));
                }
            }
        }
        if (array_key_exists("schtime", $currentArray)) {
            //create a element
            $senderTag = $root->appendChild($xmlDoc->createElement("SCHEDULEDATETIME", $currentArray['schtime']));
        }
        if (array_key_exists("campaign", $currentArray) && is_string($currentArray["campaign"])) {
            //create a element
            $campaignTag = $root->appendChild($xmlDoc->createElement("CAMPAIGN", $currentArray['campaign']));
        }
        if (array_key_exists("country", $currentArray)) {
            //create a element
            $countryTag = $root->appendChild($xmlDoc->createElement("COUNTRY", $currentArray['country']));
        }
        if (array_key_exists("flash", $currentArray)) {
            $responseFormat =  array(0,1);
            $value = in_array($currentArray["flash"], $responseFormat)? $currentArray["flash"] : 0;
            $flashTag = $root->appendChild($xmlDoc->createElement("FLASH", $value));
        }
        if (array_key_exists("unicode", $currentArray)) {
            $responseFormat =  array(0,1);
            $value = in_array(strtolower($currentArray["unicode"]), $responseFormat) ? $currentArray["unicode"] : 0;
            $unicodeTag = $root->appendChild($xmlDoc->createElement("UNICODE", $value));
        }
        if (array_key_exists('content', $currentArray)) {
            $bulkSms      = $currentArray['content'];
            $lenOfBulkSms = sizeof($bulkSms);
            for ($j=0; $j< $lenOfBulkSms; $j++) {
                $bulkCurrentArray =  $bulkSms[$j];
                $smsTag = $root->appendChild($xmlDoc->createElement("SMS"));
                //check message legth
                if (array_key_exists("message", $bulkCurrentArray) && is_string($bulkCurrentArray["message"])) {
                    if (!array_key_exists("unicode", $currentArray) && strlen($bulkCurrentArray["message"]) <= 160) {
                        $childAttr = $xmlDoc->createAttribute("TEXT");
                        $childText = $xmlDoc->createTextNode($bulkCurrentArray['message']);
                        $smsTag->appendChild($childAttr)->appendChild($childText);
                    }
                    if (array_key_exists("unicode", $currentArray) && strlen($bulkCurrentArray["message"]) <= 70) {
                        $child = $xmlDoc->createTextNode($bulkCurrentArray['message']);
                        $smsTag->appendChild($xmlDoc->createAttribute("TEXT"))->appendChild($child);
                    }
                }
                //check mobile contents
                if (is_string($bulkCurrentArray['mobile'])) {
                    $mobileArray = MobileNumber::isValidNumber($bulkCurrentArray['mobile']);
                    $mobiles     = $mobileArray['Mobiles'];
                    for ($k=0; $k <sizeof($mobiles); $k++) {
                        $addressTag = $smsTag->appendChild($xmlDoc->createElement("ADDRESS"));
                        $childAttr = $xmlDoc->createAttribute("TO");
                        $childText = $xmlDoc->createTextNode($mobiles[$k]);
                        $addressTag->appendChild($childAttr)->appendChild($childText);
                    }
                }
            }
        }
        return $xmlDoc;
    }
}
