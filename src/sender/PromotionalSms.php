<?php
namespace sender;

/**
* 
*/
class PromotionalSms extends SmsSend
{
	
	function __construct()
	{
		
	}
	/** 
    *  Send promotional SMS MSG91 Service
    * @param  $mobile  string 954845**54
    * @param  $data    string 
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendPromotional($mobile,$data)
    {
        
    }

    /** 
    *  Send Bulk promotional SMS MSG91 Service
    * @param  $mobile  string 954845**54
    * @param  $data    string 
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendBulkPromotional($mobile,$data)
    {        
   //  	$array = [
   //          'AUTHKEY' => 'Authentication key',

		 //    'SMS' => [
		 //        '_attributes' => ['TEXT' => 'Hello Venkat']
		 //        'ADDRESS' => [
		 //             '_attributes' => ['TO' => 'number1']
		 //        ],
		 //        'ADDRESS' => [
		 //             '_attributes' => ['TO' => 'number2']
		 //        ],	       
   //          ],
   //          'SMS' => [
		 //        '_attributes' => ['TEXT' => 'Hello Kutty']
		 //        'ADDRESS' => [
		 //             '_attributes' => ['TO' => 'number3']
		 //        ],
		 //        'ADDRESS' => [
		 //             '_attributes' => ['TO' => 'number4']
		 //        ],	       
   //          ]
   //      ];
             

   //           <MESSAGE>
			//     <AUTHKEY>Authentication Key </AUTHKEY>		
			//     <SMS TEXT="Hello Venkat" >
			//         <ADDRESS TO="number1"></ADDRESS>
			//         <ADDRESS TO="number2"></ADDRESS>			
			//     </SMS>
			//     <SMS TEXT="Hello Kutty" >
			//         <ADDRESS TO="number3"></ADDRESS>
			//         <ADDRESS TO="number4"></ADDRESS>
			//     </SMS>
			// </MESSAGE> 


    }
}