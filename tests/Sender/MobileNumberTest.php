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
    //-------------------------
    //test string valid numbers
    public function testIsValidNumber()
    {
        $expectArray = [
            "value"=> true,
            "mobile"=> ["9514028541","9791466728","8148597834","9514028532"]
        ];
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597834,9514028532");
        $this->assertEquals($expectArray, $result);
        $expectArray = [
            "value"=> true,
            "mobile"=> ["9514028541"]
        ];
        $result = $this->mobile->isValidNumber("9514028541");
        $this->assertEquals($expectArray, $result);
    }
    // test sting type invalide one phone number
    public function testIsValidNumberFalse()
    {
        $expectArray = [
            "value"=> false,
            "mobile"=> "951402"
        ];
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597834,951402");
        $this->assertEquals($expectArray, $result);
    }
    //send invalid number correct
    public function testIsInvalideNumberTrue()
    {
        $result = $this->mobile->isValidNumber(9514028541);
        $this->assertFalse($result);
        $result = $this->mobile->isValidNumber(true);
        $this->assertFalse($result);
        $result = $this->mobile->isValidNumber(643.56735);
        $this->assertFalse($result);
        $expectArray = [
            "value"=> false,
            "mobile"=> "95140d28541"
        ];
        $result = $this->mobile->isValidNumber("95140d28541");
        $this->assertEquals($expectArray, $result);
        $expectArray = [
            "value"=> false,
            "mobile"=> "95@1402"
        ];
        $result = $this->mobile->isValidNumber("9514028541,9791466728,8148597834,95@1402");
        $this->assertEquals($expectArray, $result);
    }
    //send invalid number false
    public function testIsInvalideNumberFalse()
    {
        $expectArray = [
            "value"=> true,
            "mobile"=> ["9514028541"]
        ];
        $result = $this->mobile->isValidNumber("9514028541");
        $this->assertEquals($expectArray, $result);
        //send boolean
        $expectArray = [
            "value"=> false,
            "mobile"=> "true"
        ];
        $result = $this->mobile->isValidNumber("true");
        $this->assertEquals($expectArray, $result);
    }
}
