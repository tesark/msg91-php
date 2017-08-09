<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\MobileNumber;

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
    public function testIsvalid(){
        $result = $this->mobile->isValid(9514028541);
        $this->assertTrue($result);

    }
    public function testIsvalidfalse(){
        $result = $this->mobile->isValid("9514028541");
        $this->assertFalse($result);
    }
    public function testIsvalidfloat(){
        $result = $this->mobile->isValid(34567.65456);
        $this->assertFalse($result);
    }
    public function testIsvalidnull(){
        $result = $this->mobile->isValid('');
        $this->assertFalse($result);
    }
    
    public function testLengthCheck(){

    	$result = $this->mobile->getLength(9791466728);
    	$this->assertTrue($result);
    }
    public function testLengthCheckAbove(){

    	$result = $this->mobile->getLength(979146672823456);
    	$this->assertFalse($result);
    }
    public function testLengthCheckBelow(){

    	$result = $this->mobile->getLength(9);
    	$this->assertFalse($result);
    }
    public function testLengthCheckNutral(){

    	$result = $this->mobile->getLength(9791466);
    	$this->assertTrue($result);
    }




}