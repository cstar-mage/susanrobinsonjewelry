<?php
class Ideal_Selldiamond_IndexController extends Mage_Core_Controller_Front_Action
{
		const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
		private function rpHash($value) {
		  $hash = 5381;
		  $value = strtoupper($value);
		  for($i = 0; $i < strlen($value); $i++) {
		   $hash = ($this->leftShift32($hash, 5) + $hash) + ord(substr($value, $i));
		  }
		  return $hash;
		 }
		 // Perform a 32bit left shift
		 private function leftShift32($number, $steps) {
		  // convert to binary (string)
		  $binary = decbin($number);
		  // left-pad with 0's if necessary
		  $binary = str_pad($binary, 32, "0", STR_PAD_LEFT);
		  // left shift manually
		  $binary = $binary.str_repeat("0", $steps);
		  // get the last 32 bits
		  $binary = substr($binary, strlen($binary) - 32);
		  // if it's a positive number return it
		  // otherwise return the 2's complement
		  return ($binary{0} == "0" ? bindec($binary) :
		  -(pow(2, 31) - bindec(substr($binary, 1))));
 }
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/selldiamond?id=15 
    	 *  or
    	 * http://site.com/selldiamond/id/15 	
    	 */
    	/* 
		$selldiamond_id = $this->getRequest()->getParam('id');

  		if($selldiamond_id != null && $selldiamond_id != '')	{
			$selldiamond = Mage::getModel('selldiamond/selldiamond')->load($selldiamond_id)->getData();
		} else {
			$selldiamond = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($selldiamond == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$selldiamondTable = $resource->getTableName('selldiamond');
			
			$select = $read->select()
			   ->from($selldiamondTable,array('selldiamond_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$selldiamond = $read->fetchRow($select);
		}
		Mage::register('selldiamond', $selldiamond);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
    
    
    public function sendemailAction()
    {
		 if($captch=$_POST['defaultReal']){
    if ($this->rpHash($_POST['defaultReal']) != $_POST['defaultRealHash']) {
     Mage::getSingleton('core/session')->addError(Mage::helper('contactform')->__('The security code entered was incorrect. Please try again!'));
     //$this->_redirect('*/');
     $this->_redirectReferer();
     return;
    }
   } 
    	if ($data = $this->getRequest()->getPost()) {
    		$post = $this->getRequest()->getPost();
    		 
    		if($post['certification']=="Yes")
    		{
    			$post['certificationtype']=$post['certificationtype'];
    		}
    		else
    		{
    			$post['certificationtype']=$post['certificationtype1'];
    		}
    		
    		$model = Mage::getModel('selldiamond/selldiamond');
    		$model->setData($data)
    		->setId($this->getRequest()->getParam('id'));
    		
    		
    
    		try {
    			if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
    				$model->setCreatedTime(now())
    				->setUpdateTime(now());
    			} else {
    				$model->setUpdateTime(now());
    			}
    		} catch (Exception $e) {
    
    		}
    		 
    		$model->save();
    
    		//Fetch submited params
    		$params = $this->getRequest()->getParams();
    		if($params['certification']=="Yes")
    		{
    			$type=$params['certificationtype'];
    		}
    		else
    		{
    			$type=$params['certificationtype1'];
    		}
    		$mail = new Zend_Mail();
    		$mail->setBodyText('Name: '.$params['name']."\r\nPrimary Phone Number: ".$params['phone1']."\r\nSecondary Phone Number: ".$params['phone2']."\r\nEmail: ".$params['email']."\r\nBest Time of Day to Contact You: ".$params['contact_time']."\r\nShape: ".$params['shape']."\r\nWeight:".$params['weight']."\r\nAsking Price: ".$params['price']."\r\nCertification: ".$params['certification']."\r\nType: ".$type."\r\nComment: ".$params['content']);
    		$mail->setFrom($params['email'], Mage::getStoreConfig('trans_email/ident_general/name')." - ".$params['name']);
    		$mail->addTo(Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT), Mage::getStoreConfig('trans_email/ident_general/name').' Diamondseller');
			$mail->addBcc($params['email']);
    		//$mail->addTo('info@losangelesdiamondseller.com', 'Some Recipient');	  
    		$mail->setSubject('Sell your diamonds');
    		try {
    			$mail->send();
    			Mage::getSingleton('core/session')->addSuccess('<p>Thank you, we\'ve received your request. Our expert jeweler will contact you within 24 hours.</p>');
    		}
    		catch(Exception $ex) {
    			Mage::getSingleton('core/session')->addError('Unable to send email');
    		}
    		//Redirect back to index action of (this) inchoo-simplecontact controller
    		$this->_redirect('sell-your-diamonds');
    	}
    }
}
