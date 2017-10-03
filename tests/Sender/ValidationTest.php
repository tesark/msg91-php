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
    //test string function
    public function testIsString()
    {
        $result = $this->validate->isString("smsandotp");
        $this->assertTrue($result);
        $result = $this->validate->isString('smsandotp');
        $this->assertTrue($result);
        $result = $this->validate->isString('54545');
        $this->assertTrue($result);
        $result = $this->validate->isString('54.45');
        $this->assertTrue($result);
        $result = $this->validate->isString('true');
        $this->assertTrue($result);
    }
    public function testIsStringFalse()
    {
        $result = $this->validate->isString(9514028541);
        $this->assertFalse($result);
        $result = $this->validate->isString(44.55);
        $this->assertFalse($result);
        $result = $this->validate->isString(44.55555555555555555555);
        $this->assertFalse($result);
        $result = $this->validate->isString(true);
        $this->assertFalse($result);
    }
    //test integer function
    public function testIsInteger()
    {
        $result = $this->validate->isInteger(9514028541);
        $this->assertTrue($result);
        $result = $this->validate->isInteger(45);
        $this->assertTrue($result);
    }
    public function testIsIntegerFalse()
    {
        $result = $this->validate->isInteger("9514028541");
        $this->assertFalse($result);
        $result = $this->validate->isInteger(44.55);
        $this->assertFalse($result);
        $result = $this->validate->isInteger(true);
        $this->assertFalse($result);
        $result = $this->validate->isInteger("jhasff^$#@22");
        $this->assertFalse($result);
    }
    //test numeric function
    public function testIsNumeric()
    {
        $result = $this->validate->isNumeric("9514028541");
        $this->assertTrue($result);
        $result = $this->validate->isNumeric("91");
        $this->assertTrue($result);
        $result = $this->validate->isNumeric(45);
        $this->assertTrue($result);
        $result = $this->validate->isNumeric(45.55);
        $this->assertTrue($result);
    }
    public function testIsNumericFalseSecond()
    {
        $result = $this->validate->isNumeric("dd28541");
        $this->assertFalse($result);
        $result = $this->validate->isNumeric(true);
        $this->assertFalse($result);
        $result = $this->validate->isNumeric("smsotp");
        $this->assertFalse($result);
        $result = $this->validate->isNumeric("sfd#73^&@");
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
        $result = $this->validate->isValidDateFirstFormat("2020/01/01");
        $this->assertFalse($result);
        $result = $this->validate->isValidDateFirstFormat("10:10:00");
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
        $result = $this->validate->isValidDateSecondFormat("2020/01-01 10:10:00");
        $this->assertFalse($result);
         $result = $this->validate->isValidDateSecondFormat("2020-01-01 10/10/00");
        $this->assertFalse($result);
        $result = $this->validate->isValidDateSecondFormat("2020-01-01");
        $this->assertFalse($result);
        $result = $this->validate->isValidDateSecondFormat("10:10:00");
        $this->assertFalse($result);
    }
    //validation timestamp
    public function testisValidTimeStamp()
    {
        $result = $this->validate->isValidTimeStamp(strtotime("now"));
        $this->assertTrue($result);
        $result = $this->validate->isValidTimeStamp(strtotime("-5 minutes"));
        $this->assertTrue($result);
        $result = $this->validate->isValidTimeStamp(strtotime("-10 minutes"));
        $this->assertTrue($result);
    }
    public function testisValidTimeStampFalse()
    {
        $result = $this->validate->isValidTimeStamp("2020-01-01 10:10:00");
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp("2010-01-01 10:10:00");
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp("2010-01-01 10:10:00");
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp(strtotime("-1 Days"));
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp(strtotime("+1 Days"));
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp(strtotime("+15 Days"));
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp("1506576470");
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp(strtotime("February"));
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp(strtotime("+1 week"));
        $this->assertFalse($result);
        $result = $this->validate->isValidTimeStamp(strtotime("-1 week"));
        $this->assertFalse($result);
    }
    //validation authkey
    public function testCheckAuthKeyAlpha()
    {
        $result = $this->validate->isAuthKey("sgdfafdsjhfahjdfhjas");
        $this->assertTrue($result);
        $result = $this->validate->isAuthKey("hsdgyu4r78fydegfg432ew");
        $this->assertTrue($result);
        $result = $this->validate->isAuthKey("324353456465546456");
        $this->assertTrue($result);
         $result = $this->validate->isAuthKey("3sffa#6A3456&(C46456");
        $this->assertTrue($result);
    }
    public function testCheckAuthKeysFalse()
    {
        $result = $this->validate->isAuthKey(3748576346);
        $this->assertFalse($result);
        $result = $this->validate->isAuthKey(true);
        $this->assertFalse($result);
        $result = $this->validate->isAuthKey(374.6);
        $this->assertFalse($result);
    }
    // Get array size
    public function testGetSizeTrue()
    {
        $array = ["fasdgh", "afsdghf"];
        $result = $this->validate->getSize($array);
        $this->assertEquals(2, $result);
        $array = ["fasdgh" => "askjgdhj", "afsdghf"=> "asnmbdfgas", "hjasfdghfash" =>"hjasfghd"];
        $result = $this->validate->getSize($array);
        $this->assertEquals(3, $result);
        $array = ["3", "1", "2", "2", "4", "5"];
        $result = $this->validate->getSize($array);
        $this->assertEquals(6, $result);
    }
    public function testGetSizeFalse()
    {
        $result = $this->validate->getSize(3748576346);
        $this->assertFalse($result);
        $result = $this->validate->getSize(true);
        $this->assertFalse($result);
        $result = $this->validate->getSize(374.6);
        $this->assertFalse($result);
    }
}
