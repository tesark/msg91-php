<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\MobileNumber;

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
    //-----------------------------------
    public function testIsvalid()
    {
        $result = $this->mobile->isValid(9514028541);
        $this->assertTrue($result);
    }
    public function testIsvalidfalse()
    {
        $result = $this->mobile->isValid("9514028541");
        $this->assertFalse($result);
    }
    public function testIsvalidfloat()
    {
        $result = $this->mobile->isValid(34567.65456);
        $this->assertFalse($result);
    }
    public function testIsvalidnull()
    {
        $result = $this->mobile->isValid('');
        $this->assertFalse($result);
    }
    //----------------------------------------------
    public function testLengthCheck()
    {
        $result = $this->mobile->getLength(9791466728);
        $this->assertTrue($result);
    }
    public function testLengthCheckAbove()
    {
        $result = $this->mobile->getLength(979146672823456);
        $this->assertFalse($result);
    }
    public function testLengthCheckBelow()
    {
        $result = $this->mobile->getLength(9);
        $this->assertFalse($result);
    }
    public function testLengthCheckNutral()
    {
        $result = $this->mobile->getLength(9791466);
        $this->assertTrue($result);
    }
    //-------------------------------------------
    public function testGetCountryCodeIn()
    {
        $expectArray = [
            "name"=>"India",
            "dial_code"=>"91",
            "code"=>"IN"
        ];
        $result = $this->mobile->getCountry("IN");
        $this->assertEquals($expectArray, $result);
    }
    public function testGetCountryCodeUs()
    {
        $expectArray = [
            "name"=>"United States",
            "dial_code"=>"1",
            "code"=>"US"
        ];
        $result = $this->mobile->getCountry("US");
        $this->assertEquals($expectArray, $result);
    }
    public function testGetCountryCodeFalse()
    {
        $expectArray = [];
        $result = $this->mobile->getCountry("44");
        $this->assertEquals($expectArray, $result);
    }
    //--------------------------
    public function testIsValidNumber()
    {   
        $expectArray = [
            "value"=> true            
        ];         
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597837,9514028532");
        $this->assertEquals($expectArray, $result);
    }
    public function testIsValidNumberFalse()
    {   
        $expectArray = [
            "value"=> false ,
            "mobile"=> "951402853"           
        ];   
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597837,9514028532");
        $this->assertEquals($expectArray, $result);
    }
}
