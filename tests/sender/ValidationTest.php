<?php
namespace sender;

use PHPUnit\Framework\TestCase;
use sender\Validation;
/**
* 
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

}