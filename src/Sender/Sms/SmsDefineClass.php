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
    protected function hasMobileNumber()
    {
        $data = $this->inputData['mobile'];
        return isset($data);
    }
    /**
     * Check the data empty
     * @return bool
     */
    protected function hasData()
    {
        return isset($this->inputData);
    }
    /**
     * Check the sendData empty
     * @return bool
     */
    protected function hasSendData()
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
    protected function setContent()
    {
        $this->content = $this->inputData['content'];
        return true;
    }
    /*
     * get content
     */
    protected function getContent()
    {
        return $this->content;
    }
    /**
     * set mobile
     * @return bool
     */
    protected function setMobile()
    {
        $this->mobile = $this->inputData['mobile'];
        return true;
    }
    /*
     * get mobile
     */
    protected function getMobile()
    {
        return $this->mobile;
    }
    /**
     * set authkey
     * @return bool
     */
    protected function setAuthKey()
    {
        $this->authkey = $this->inputData['authkey'];
        return true;
    }
    /*
     * get authkey
     */
    protected function getAuthKey()
    {
        return $this->authkey;
    }
    /**
     * set message
     * @return bool
     */
    protected function setMessage()
    {
        $this->message = $this->inputData['message'];
        return true;
    }
    /*
     * get message
     */
    protected function getMessage()
    {
        return $this->message;
    }
    /**
     * set unicode
     * @return bool
     */
    protected function setUnicode()
    {
        $this->unicode = $this->inputData['unicode'];
        return true;
    }
    /*
     * get unicode
     */
    protected function getUnicode()
    {
        return $this->unicode;
    }
    /**
     * set sender
     * @return bool
     */
    protected function setSender()
    {
        $this->sender = $this->inputData['sender'];
        return true;
    }
    /*
     * get sender
     */
    protected function getSender()
    {
        return $this->sender;
    }
    /**
     * set country
     * @return bool
     */
    protected function setCountry()
    {
        $this->country = $this->inputData['country'];
        return true;
    }
    /*
     * get country
     */
    protected function getCountry()
    {
        return $this->country;
    }
    /**
     * set flash
     * @return bool
     */
    protected function setFlash()
    {
        $this->flash = $this->inputData['flash'];
        return true;
    }
    /*
     * get flash
     */
    protected function getFlash()
    {
        return $this->flash;
    }
    /**
     * set schtime
     * @return bool
     */
    protected function setSchtime()
    {
        $this->schtime = $this->inputData['schtime'];
        return true;
    }
    /*
     * get schtime
     */
    protected function getSchtime()
    {
        return $this->schtime;
    }
    /**
     * set afterminutes
     * @return bool
     */
    protected function setAfterminutes()
    {
        $this->afterminutes = $this->inputData['afterminutes'];
        return true;
    }
    /*
     * get afterminutes
     */
    protected function getAfterminutes()
    {
        return $this->afterminutes;
    }
    /**
     * set response
     * @return bool
     */
    protected function setResponse()
    {
        $this->response = $this->inputData['response'];
        return true;
    }
    /*
     * get response
     */
    protected function getResponse()
    {
        return $this->response;
    }
    /**
     * set campaign
     * @return bool
     */
    protected function setCampaign()
    {
        $this->campaign = $this->inputData['campaign'];
        return true;
    }
    /*
     * get campaign
     */
    protected function getCampaign()
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
     * Check key present
     * @param string $key
     *
     * @return bool
     */
    public function keyPresent($key)
    {
        if ($this->isKeyPresent($key)) {
            return true;
        } else {
            $message = $key."Must be present";
            throw ParameterException::missinglogic($message);
        }
    }
    /**
     * This function get Category wise mobile Number
     * @param int $category
     *
     */
    public function categoryWiseAddedMobile()
    {
        if ($this->isKeyExists('mobile', $this->inputData) && $this->setMobile()) {
            $value = $this->getMobile();
            return $value;
        } else {
            $message = "Missing mobile key ";
            throw ParameterException::missinglogic($message);
        }
    }
}
