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