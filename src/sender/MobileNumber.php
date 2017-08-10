<?php
namespace sender;

use Propaganistas\LaravelPhone\PhoneNumber;

/**
* 
*/
class MobileNumber
{

    // public function __construct($mobileNumber) {

    // 	$this->mobileNumber = $mobileNumber;
    // }

    
    public function isValid($phone)
    {
        if(is_int($phone)) {

            return  true;
        }         
        return false;
    }

    public function getLength($phone)
    {
       $length = strlen($phone);

       if($length > 1 && $length < 14) {
       	return true;
       } else {

         return false;
       }
    }


}