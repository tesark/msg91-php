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
    *  Send promotional SMS MSG91 Service
    * @param  $mobile  string 954845**54
    * @param  $data    string 
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendProFlash($mobile,$data)
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
    public function sendProUnicode($mobile,$data)
    {
        
    }

    /** 
    *  Send transactional SMS MSG91 Service
    * @param  $mobile
    * @param  $data
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendTransactional($mobile,$data)
    {
        //transactional SMS content              
        $data = array(
            'authkey'   => $this->authKey,
            'mobiles'   => $mobileNumber,
					'message'   => $content,
					'sender'    => $this->senderId,
					'route'     => 4,
				);
                //this condition are check  this parameter are their added to data array
				if($this->countryCode != NULL)
				{
				    $data += ['country' => $this->countryCode];
				}                
                if($this->flash != NULL)
				{
				   $data += ['flash' => $this->flash];				   
				}
				if($this->unicode != NULL)
				{
				    $data += ['unicode' => $this->unicode];				   
				}
				if($this->ignoreNdnc != NULL)
				{
					$data += ['ignoreNdnc' => $this->ignoreNdnc];				    
				}
				if($this->schtime != NULL)
				{
					$data += ['schtime' => $this->schtime];				   
				}
				if($this->response != NULL)
				{
					$data += ['response' => $this->response];				    
				}
				if($this->campaign != NULL)
				{
					$data += ['campaign' => $this->campaign];				   
				}   	
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
        






   //      $array = [
   //          'AUTHKEY' => 'Authentication key',

		 //    'SMS' => [
		 //        '_attributes' => ['TEXT' => 'Hello Venkat']
		 //        'ADDRESS' => [
		 //             '_attributes' => ['TO' => 'number1']
		 //        ],	       
   //          ]
   //      ];
             

   //           <MESSAGE>
			//     <AUTHKEY>Authentication Key </AUTHKEY>
			//     <SENDER>SenderID</SENDER>
			//     <ROUTE>Template</ROUTE>
			//     <CAMPAIGN>XML API</CAMPAIGN>
			//     <COUNTRY>country code</COUNTRY>
			//     <SMS TEXT="message1" >
			//         <ADDRESS TO="number1"></ADDRESS>
			//         <ADDRESS TO="number2"></ADDRESS>
			//     </SMS>
			//     <SMS TEXT="hi test message" >
			//         <ADDRESS TO="number3"></ADDRESS>
			//     </SMS>
			// </MESSAGE> 



   //          //way1 
   //            'Good guy' => [
			//         '_attributes' => ['attr1' => 'value']
			//         'name' => 'Luke Skywalker',
			//         'weapon' => 'Lightsaber'
			//     ]
   //          <Good_guy attr1="value">
		 //        <name>Luke Skywalker</name>
		 //        <weapon>Lightsaber</weapon>

		 //    </Good_guy>

   //          //way 2
		 //    'Good guy' => [
			//     '_attributes' => ['attr1' => 'value']

			// ]
   //          <Good_guy attr1="value"></Good_guy>
    }
}