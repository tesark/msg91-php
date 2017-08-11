<?php
namespace sender;

/**
* 
*/
class TransactionalSms extends SmsSend
{
	
	function __construct()
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
    *  Send Bulk transactional SMS MSG91 Service
    * @param  $mobile
    * @param  $data
    *
    * @return array(Json format)
    *
    * @throws error missing parameters or return empty
    */
    public function sendBulkTransactional($mobile,$data)
    {

    }
}