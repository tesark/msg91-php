<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\PromotionalSms;
use Sender\ExceptionClass\ParameterException;

/**
* This test class for testing PromotionalSmsTest class
*/

class PromotionalSmsTest extends TestCase
{
    public $PromotionalSms;
    public function setUp()
    {
        $this->PromotionalSms = new PromotionalSms("170867ARdROqjKklk599a87a1aa");
    }
    public function tearDown()
    {
        $this->PromotionalSms = null;
    }
    //-----------------------Send PromotionalSmsTest--------------------
    //------Test mandatory fields with integer type mobile numbers------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMandatoryFieldsMissingMessageIntegerMobile()
    {
        $sendArray = [
           'sender'   => 'UTOOWE',
        ];
        $verifyResponse = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMandatoryFieldsMissingSenderIntegerMobile()
    {
        $sendArray = [
           'message'  => 'WELCOME TO TESARK',
        ];
        $verifyResponse = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMandatoryFieldsMissingIntegerMobile()
    {
        $sendArray = [];
        $verifyResponse = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    //------------------------Send PromotionalSms---------------------------
    //----------Test mandatory fields with String type mobile numbers-------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMandatoryFieldsMissingMessageStringMobile()
    {
        $sendArray = [
           'sender' => 'UTOOWE',
        ];
        $verifyResponse = $this->PromotionalSms->sendPromotional("919514028541,919791466728", $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMandatoryFieldsMissingSenderStringMobile()
    {
        $sendArray = [
           'message'  => 'WELCOME TO TESARK',
        ];
        $verifyResponse = $this->PromotionalSms->sendPromotional("919514028541,919791466728", $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMandatoryFieldsMissingStringMobile()
    {
        $sendArray = [];
        $verifyResponse = $this->PromotionalSms->sendPromotional("919514028541,919791466728", $sendArray);
    }
    //--------------------- Correct format No Error---------------------
    //-----------------------------Country Code-------------------------
    public function testPromotionalSmsWithCountryCodeInteger()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsWithOutCountryCodeInteger()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsWithCountryCodeNumericString()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => "91",
        ];
        $result = $this->PromotionalSms->sendPromotional("9514028541,9791466728", $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsWithCountryCodeStringMobile()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional("9514028541,9791466728", $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsWithOutCountryCodeString()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
        ];
        $result = $this->PromotionalSms->sendPromotional("919514028541,919791466728", $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //------------------------------Flash only -----------------
    public function testPromotionalSmsFlash()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => 1,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsFlashZero()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => 0,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsFlashCountryCode()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => 1,
           'country' => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //----------------------- Unicode ------------------------
    public function testPromotionalSmsUnicode()
    {
        $sendArray = [
            'message'      => 'WELCOME TO TESARK',
            'sender'       => 'UTOOWE',
            'unicode'      => 1,
          ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //---------------------- Schtime -------------------------
    public function testPromotionalSmsSchtimedashFormat()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020-01-01 10:10:00",
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testPromotionalSmsSchtimeFrontslashFormat()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020/01/01 10:10:00",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //----------------------- Response-----------------------
    public function testPromotionalSmsResponseJson()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => "json",
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $array = json_decode($result);
        $this->assertObjectHasAttribute("type", $array);
    }
    public function testPromotionalSmsResponseJsonCapital()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => "JSON",
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
        $array = json_decode($result);
        $this->assertObjectHasAttribute("type", $array);
    }
    //------------------------ Afterminutes-----------------
    public function testPromotionalSmsWithoutCountryCode()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
           'afterminutes' => 10
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //----------------------- Campaign ---------------------
    public function testPromotionalSmsCampaign()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'campaign'     => "venkat"
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //--------------- Wrong format with Error Exception -------
    //-------------------------Message-------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMessageInteger()
    {
        $sendArray = [
           'message'   => 452124555555,
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMessageDouble()
    {
        $sendArray = [
           'message'   => 4521.24555555,
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMessageBoolean()
    {
        $sendArray = [
           'message'   => true,
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMessageArray()
    {
        $sendArray = [
           'message'   => ['true'],
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMessageNull()
    {
        $sendArray = [
           'message'   => null,
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsMessageMax()
    {
        $sendArray = [
           'message'   => "WELCOME TO TESARK fgsdhjfsgdjhgfjsdghsffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffj",
           'sender'    => 'UTOOWE',
           'country'   => 91,
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    //---------------------- Sender ---------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderMin()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOO',
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderMax()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWESSSS',
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderInteger()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 564654,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderDouble()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 56.4654,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderBoolean()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => true,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderNull()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => null,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSenderArray()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => ['true'],
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    //------------------------ Country Code ----------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsWithCountryCodeBoolean()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => true,
        ];
        $result = $this->PromotionalSms->sendPromotional("9514028541,9791466728", $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsWithCountryCodeArray()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => ["IND"],
        ];
        $result = $this->PromotionalSms->sendPromotional("9514028541,9791466728", $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsWithCountryCodeString()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => "IND",
        ];
        $result = $this->PromotionalSms->sendPromotional("9514028541,9791466728", $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsWithCountryCodeNull()
    {
        $sendArray = [
           'message'   => 'WELCOME TO TESARK',
           'sender'    => 'UTOOWE',
           'country'   => null,
        ];
        $result = $this->PromotionalSms->sendPromotional("9514028541,9791466728", $sendArray);
    }
    //-------------------------Flash only ------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsFlashNull()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => null,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsFlashDefaultNull()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => 7,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsFlashArray()
    {
        $sendArray = [
           'message' => 'WELCOME TO TESARK',
           'sender' => 'UTOOWE',
           'flash' => ['7'],
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    //----------------------- Unicode -------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsUnicodeNull()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'unicode'      => null,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsUnicodeDefaultNull()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'unicode'      => 7,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsUnicodeArray()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'unicode'      => ['7'],
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsUnicodeOneMessageLimit()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
           'sender'       => 'UTOOWE',
           'unicode'      => 1,
        ];
        $result = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    //---------------------- Schtime --------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongOne()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020-01/01 10:10:00",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongTwo()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020-01/01",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongThree()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020-01/01 10-10-00",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongFour()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "10:10:00",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongFive()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "2020/01/01 10-10-00",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongSix()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "10-10-00",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongSeven()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => 30,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongEight()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => "1Days",
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongNine()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => true,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeArray()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => ['true'],
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatWrongTen()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => 7845.637,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsSchtimeFormatNull()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'schtime'      => null,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    //----------------------- Response-------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsResponseBoolean()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => true,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsResponseInteger()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => 4545,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsResponseArray()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => ['4545'],
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsResponseDouble()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'response'     => 43.435434,
        ];
        $result  = $this->PromotionalSms->sendPromotional(919514028541, $sendArray);
    }
    //------------------------ Afterminutes--------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsAfterminutesMin()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
           'afterminutes' => 9
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsAfterminutesMax()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
           'afterminutes' => 20001
        ];
        $result = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsAfterminuteBoolean()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
           'afterminutes' => true
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsAfterminutesString()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
           'afterminutes' => "20001"
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsAfterminutesArray()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'country'      => 91,
           'afterminutes' => ["20001"]
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    //----------------------- Campaign ---------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsCampaignBoolean()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'campaign'     =>  true
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsCampaignnull()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'campaign'     =>  null
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsCampaignInteger()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'campaign'     =>  4334
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsCampaignArray()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'campaign'     =>  [4.8888334]
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testPromotionalSmsCampaignDouble()
    {
        $sendArray = [
           'message'      => 'WELCOME TO TESARK',
           'sender'       => 'UTOOWE',
           'campaign'     =>  43.88888834
        ];
        $result  = $this->PromotionalSms->sendPromotional(9514028541, $sendArray);
    }
    //---------------------------Bulk SMS ------------------------
    public function testBulkMessage()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1aa',
                'sender' => 'MULSMS',
                'campaign' => 'venkat',
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541,919791466728'
                  ],
                  [
                    'message' => 'tesark world',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testBulkMessageWithCountryCode()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1aa',
                'sender' => 'MULSMS',
                'country' => '91',
                'unicode' => 1,
                'content' => [
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '9514028541'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
        $this->assertEquals(24, strlen($result));
    }
    public function testBulkMessageTwoAuthkey()
    {
        $sendArray = [
          [
           'authkey' => '170867ARdROqjKklk599a87a1aa',
           'sender' => 'MULSMS',
           'content' =>[ [
                'message' => 'welcome multi sms',
                'mobile' => '919514028541',
              ],
              [
                'message' => 'tesark world',
                'mobile' => '919514028541',
              ]
            ]
          ],
          [
           'authkey' => '170867ARdROqjKklk599a87a1aa',
           'sender' => 'SUNSMS',
           'content' =>[ [
                'message' => 'hai how are u',
                'mobile' => '919514028541',
              ],
              [
                'message' => 'hai welcome',
                'mobile' => '919514028541',
              ]
            ]
          ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
        $this->assertEquals(24, strlen($result));
    }
    //------------------Wrong format Bulk sms---------------------
    //---------------- Mandatory fields missing-------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingParametersString()
    {
        $sendArray = '9414028541';
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingParametersBoolean()
    {
        $sendArray = true;
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingParametersInteger()
    {
        $sendArray = 9414028541;
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingParametersDouble()
    {
        $sendArray = 94.14028541;
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingParametersNull()
    {
        $sendArray = null;
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingMandatoryAuthKey()
    {
        $sendArray = [
            [
                'sender' => 'MULSMSAA',
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingMandatorySender()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingMandatoryMobile()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => 'MULSMS',
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageMissingMandatoryMessage()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => 'MULSMS',
                'content' =>[
                  [
                    'mobile' => '919514028541'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    //-------------------------- Sender --------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderMaxlength()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => 'MULSMSAA',
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderMinlength()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => 'MUL',
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderBoolean()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => true,
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderArray()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => ['true'],
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderDouble()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => 67.564545,
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderInteger()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => 45345,
                'content' =>[
                  [
                    'message' => 'welcome multi sms',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    //-----------------------unicode--------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderUnicode()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'unicode' => 1,
                'content' =>[
                  [
                    'message' => 'welcome multi smsyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyrrrrrrrrrrrrrr',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderUnicodeNull()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'unicode' => null,
                'content' =>[
                  [
                    'message' => 'welcome multi smsyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyrrrrrrrrrrrrrr',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderUnicodeArray()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'unicode' => [1],
                'content' =>[
                  [
                    'message' => 'welcome multi smsyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyrrrrrrrrrrrrrr',
                    'mobile' => '919514028541,919791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSenderMaxNotUnicode()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => '91',
                'content' =>[
                  [
                    'message' => 'welcome reeerrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrmulti eeeeeeeeeeeeeeeeeeeeeeesms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    //------------------------Country code --------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCountryCodeArray()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => ['91'],
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCountryCodeBoolean()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => true,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCountryCodeAlphaString()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "IND",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCountryCodeMobileFormatWrong()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '95541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    //---------------------- Schtime --------------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongOne()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "2020-01/01 10:10:00",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongTwo()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "2020-01/01",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongThree()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "2020-01/01 10-10-00",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongFour()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "10:10:00",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongFive()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "2020/01/01 10-10-00",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongSix()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "10-10-00",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongSeven()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => 30,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongEight()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => "1Days",
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongNine()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => true,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongTen()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => 7845.637,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongArray()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => ['true'],
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageSchtimeFormatWrongNull()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'schtime' => null,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    //----------------------- flash ---------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageFlashNull()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'flash' => null,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageFlashArray()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'flash' => ['7'],
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageFlashInvalidInput()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'flash' => 7,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    //-------------------- campaign --------------------
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCampaignNull()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'campaign' => null,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCampaignArray()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'campaign' => ['venkat'],
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
    /**
     * @expectedException Sender\ExceptionClass\ParameterException
     */
    public function testBulkMessageCampaignBoolean()
    {
        $sendArray = [
            [
                'authkey' => '170867ARdROqjKklk599a87a1',
                'sender' => "VENKAT",
                'country' => "91",
                'campaign' => true,
                'content' =>[
                  [
                    'message' => 'welcome sms',
                    'mobile' => '9514028541,9791466728'
                  ],
                ]
            ]
        ];
        $result = $this->PromotionalSms->sendBulkSms($sendArray);
    }
}
