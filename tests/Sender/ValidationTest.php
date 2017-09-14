<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\Validation;

/**
* This test calss use for tesing Validation Call
*/

class ValidationTest extends TestCase
{
    private $validate;
    protected function setUp()
    {
        $this->validate = new Validation();
    }
    protected function tearDown()
    {
        $this->validate = null;
    }
    //----------------------------
    //test string finction
    public function testIsString()
    {
        $result = $this->validate->isString("smsandotp");
        $this->assertTrue($result);
    }
    public function testIsStringTrue()
    {
        $result = $this->validate->isString('smsandotp');
        $this->assertTrue($result);
    }
    public function testIsStringFalse()
    {
        $result = $this->validate->isString(9514028541);
        $this->assertFalse($result);
    }
    public function testIsStringFalseSecond()
    {
        $result = $this->validate->isString(44.55);
        $this->assertFalse($result);
    }
    //test integer function
    public function testIsInteger()
    {
        $result = $this->validate->isInteger(9514028541);
        $this->assertTrue($result);
    }
    public function testIsIntegerTrue()
    {
        $result = $this->validate->isInteger(45);
        $this->assertTrue($result);
    }
    public function testIsIntegerFalse()
    {
        $result = $this->validate->isInteger("9514028541");
        $this->assertFalse($result);
    }
    public function testIsIntegerFalseSecond()
    {
        $result = $this->validate->isInteger(44.55);
        $this->assertFalse($result);
    }
    //test numeric function
    public function testIsNumeric()
    {
        $result = $this->validate->isNumeric("9514028541");
        $this->assertTrue($result);
    }
    public function testIsNumericTrue()
    {
        $result = $this->validate->isNumeric("91");
        $this->assertTrue($result);
    }
    public function testIsNumericTrueSecond()
    {
        $result = $this->validate->isNumeric(45);
        $this->assertTrue($result);
    }
    public function testIsNumericTrueThird()
    {
        $result = $this->validate->isNumeric(45.55);
        $this->assertTrue($result);
    }
    public function testIsNumericFalse()
    {
        $result = $this->validate->isNumeric("dd28541");
        $this->assertFalse($result);
    }
    public function testIsNumericFalseSecond()
    {
        $result = $this->validate->isNumeric(true);
        $this->assertFalse($result);
    }
    public function testIsNumericFalseThird()
    {
        $result = $this->validate->isNumeric("smsotp");
        $this->assertFalse($result);
    }
    //validation first format
    public function testisValidDateFirstFormat()
    {
        $result = $this->validate->isValidDateFirstFormat("2020-01-01 10:10:00");
        $this->assertTrue($result);
    }
    public function testisValidDateFirstFormatFalse()
    {
        $result = $this->validate->isValidDateFirstFormat("2020/01/01 10:10:00");
        $this->assertFalse($result);
    }
    // vaildation second format
    public function testisValidDateSecondFormat()
    {
        $result = $this->validate->isValidDateSecondFormat("2020/01/01 10:10:00");
        $this->assertTrue($result);
    }
    public function testisValidDateSecondFormatFalse()
    {
        $result = $this->validate->isValidDateSecondFormat("2020-01-01 10:10:00");
        $this->assertFalse($result);
    }
    //validation timestamp
    public function testisValidTimeStamp()
    {
        $result = $this->validate->isValidTimeStamp(strtotime("now"));
        $this->assertTrue($result);
    }
    public function testisValidTimeStampFalse()
    {
        $result = $this->validate->isValidTimeStamp("2020-01-01 10:10:00");
        $this->assertFalse($result);
    }
    //validation authkey
    public function testCheckAuthKeyAlpha()
    {
        $result = $this->validate->checkAuthKey("sgdfafdsjhfahjdfhjas");
        $this->assertTrue($result);
    }
    public function testCheckAuthKeysNumeric()
    {
        $result = $this->validate->checkAuthKey("324353456465546456");
        $this->assertTrue($result);
    }
    public function testCheckAuthKeysAlphaNumeric()
    {
        $result = $this->validate->checkAuthKey("hsdgyu4r78fydegfg432ew");
        $this->assertTrue($result);
    }
    public function testCheckAuthKeysFalse()
    {
        $result = $this->validate->checkAuthKey(3748576346);
        $this->assertFalse($result);
    }
    public function testCheckAuthKeysFalseSecond()
    {
        $result = $this->validate->checkAuthKey(374.6);
        $this->assertFalse($result);
    }
    public function testCheckAuthKeysFalseBool()
    {
        $result = $this->validate->checkAuthKey(true);
        $this->assertFalse($result);
    }
}
