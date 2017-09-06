<?php
namespace Sender;

use PHPUnit\Framework\TestCase;
use Sender\MobileNumber;

/**
* This test class for testing mobile number
*/

class MobileNumberTest extends TestCase
{
    private $Mobile;
    protected function setUp()
    {
        $this->mobile = new MobileNumber();
    }
    protected function tearDown()
    {
        $this->mobile = null;
    }
    //--------------------------
    //test string valid numbers
    public function testIsValidNumber()
    {
        $expectArray = [
            "value"=> true,
            "mobile"=> ["9514028541","9791466728","8148597834","9514028532"]
        ];
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597834,9514028532");
        $this->assertEquals($expectArray, $result);
    }
    // test sting type invalide one phone number
    public function testIsValidNumberFalse()
    {
        $expectArray = [
            "value"=> false ,
            "mobile"=> "951402853"
        ];
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597834,951402853");
        $this->assertEquals($expectArray, $result);
    }
    //send invalid number correct
    public function testIsInvalideNumberTrue()
    {
        $result = $this->mobile->isValidNumber(9514028541);
        $this->assertFalse($result);
    }
    //send invalid number false
    public function testIsInvalideNumberFalse()
    {
        $expectArray = [
            "value"=> true ,
            "mobile"=> ["9514028541"]
        ];
        $result = $this->mobile->isValidNumber("9514028541");
        $this->assertEquals($expectArray, $result);
    }
    //---------------------------
    //Add Country code with mobile number
    public function testAddCountryCode()
    {   $expectArray = "919514028541";
        $result = $this->mobile->addCountryCode("9514028541", "IN");
        $this->assertEquals($expectArray, $result);
    }
    public function testAddCountryCodeSecond()
    {   $expectArray = 919514028541;
        $result = $this->mobile->addCountryCode(9514028541, "IN");
        $this->assertEquals($expectArray, $result);
    }
    //is vaild country code
    public function testIsVaildCountryCode()
    {
        $result = $this->mobile->isVaildCountryCode("919514028541", "IN");
        $this->assertTrue($result);
    }
    public function testIsVaildCountryCodeTrue()
    {
        $result = $this->mobile->isVaildCountryCode(919514028541, "IN");
        $this->assertTrue($result);
    }
    public function testIsVaildCountryCodeSecond()
    {
        $result = $this->mobile->isVaildCountryCode(919514028541, "US");
        $this->assertFalse($result);
    }
}
