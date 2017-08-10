<?php
namespace sender;

use Spatie\ArrayToXml\ArrayToXml;

/**
* 
*/
class SmsSend 
{
    // function __construct()
    // {
    // }

    /** 
    *  Array to Xml Converter
    * @param  $data Array
    *
    * @return Xml
    *
    * @throws error missing parameters or return empty
    */
    public function convertArrayToXml($data)
    {
          $result = ArrayToXml::convert($data, 'MESSAGE', false);
          return $result;
    }


}