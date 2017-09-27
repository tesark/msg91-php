<?php
namespace Sender\Traits;

/**
 * This trait for SMS OTP FUNCTIONS
 *
 * @package    Msg91 SMS&OTP package
 * @author     VenkatS <venkatsamuthiram5@gmail.com>
 * @link       https://github.com/venkatsamuthiram/deliver
 * @license
 */

trait SmsTrait
{
	/**
     * Check afterminutes limits
     * @param string $afterMinutes
     *
     * @return bool
     */
    protected function isVaildAfterMinutes($afterMinutes)
    {
        $value  = array('options' => array('min_range' => 10, 'max_range' => 20000));
        $result = filter_var($afterMinutes, FILTER_VALIDATE_INT, $value);
        return (bool) $result;
    }
    /**
     * This function Check value 0 or 1
     *
     * @return int
     */
    protected function checkArray($value)
    {
        $responseFormat = array(0, 1);
        $value = in_array($value, $responseFormat) ? $value : null;
        return $value;
    }
    /**
     * This function check expect value present in array
     * @param string $value
     * 
     */
    protected function checkResponse($value)
    {
        $responseFormat = array('xml', 'json');
        $responseVal = strtolower($value);
        $value = in_array($responseVal, $responseFormat) ? $responseVal : null;
        return $value;
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
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function CheckMessageData($category, $key, $value, $buildSmsData, $xmlDoc)
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
    protected function CheckResponseData($category, $key, $value, $buildSmsData)
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
    protected function stringTypeCheckAndBuildData($category, $key, $value, $buildSmsData, $xmlDoc = null)
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
    protected function buildStringData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        $buildSmsData = $this->CheckAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->CheckSenderData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->CheckMessageData($category, $key, $value, $buildSmsData, $xmlDoc);
        $buildSmsData = $this->CheckResponseData($category, $key, $value, $buildSmsData);        
        return $buildSmsData;
    }
    /**
     * This function for Check String Type
     * @param int $category
     * @param string $key
     * @param array $buildSmsData
     *
     */
    protected function CheckAuthCampaignData($category, $key, $value, $buildSmsData, $xmlDoc)
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
    protected function CheckSenderData($category, $key, $value, $buildSmsData, $xmlDoc)
    {
        if ($key === 'sender') {
            $buildSmsData = $this->validLength($key, $value, $buildSmsData, 'sms', $category, $xmlDoc);
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
     * This function for Add mobile number to XML
     * @param array $xmlDoc
     * @param array $smsTag
     *
     */
    protected function addMobileToXml($xmlDoc, $smsTag, $result)
    {
        if (!empty($result) && $result['value'] == true) {
            $mobiles = $result['mobile'];
            $len = Validation::getSize($mobiles);
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
}
