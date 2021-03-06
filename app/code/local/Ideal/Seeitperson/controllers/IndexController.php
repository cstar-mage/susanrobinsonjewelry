<?php
class Ideal_Seeitperson_IndexController extends Mage_Core_Controller_Front_Action
{
	const XML_PATH_EMAIL_RECIPIENT  = 'seeitperson/email/recipient_email';
	const XML_PATH_EMAIL_SENDER     = 'seeitperson/email/sender_email_identity';
	const XML_PATH_EMAIL_TEMPLATE   = 'seeitperson/email/email_template';
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/seeitperson?id=15 
    	 *  or
    	 * http://site.com/seeitperson/id/15 	
    	 */
    	/* 
		$seeitperson_id = $this->getRequest()->getParam('id');

  		if($seeitperson_id != null && $seeitperson_id != '')	{
			$seeitperson = Mage::getModel('seeitperson/seeitperson')->load($seeitperson_id)->getData();
		} else {
			$seeitperson = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($seeitperson == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$seeitpersonTable = $resource->getTableName('seeitperson');
			
			$select = $read->select()
			   ->from($seeitpersonTable,array('seeitperson_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$seeitperson = $read->fetchRow($select);
		}
		Mage::register('seeitperson', $seeitperson);
		*/

			
		$this->loadLayout();   
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');       
		$this->renderLayout();
    }
   
public function personpostAction()
	{
		$data = $this->getRequest()->getPost();
	
		if ($data) {
			
			$translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
			
			try {
                $postObject = new Varien_Object();
                $postObject->setData($data);
                $error = false;

                if (!Zend_Validate::is(trim($_POST['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($_POST['email']), 'EmailAddress')) {
                    $error = true;
                }
                
                if ($error) {
					throw new Exception();
                }

				$model = Mage::getSingleton('seeitperson/seeitperson')->setData($data);
                if(!$model->save()){
                	throw new Exception();
                }
                
                $mailTemplate = Mage::getModel('core/email_template');
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($_POST['email'])
					->sendTransactionalnew(
							Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
							Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
						   Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
							$data['name'],
							array('data' => $postObject),
							$data['email']
                    );
					
                
                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }
                else {echo "";/*exit;*/}

                $translate->setTranslateInline(true);

                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);
                return;
            }
        }
    }

	
	public function seepersonpostAction()
	{//echo "hi";
	//exit;
	//echo $this->getRequest()->getPost('email');
		
		$data = $this->getRequest()->getPost();
	
		if ($data) {
			

				
			$post = $this->getRequest()->getPost();
			
			$model = Mage::getModel('seeitperson/seeitperson');
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
				
				
			//$to = Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT);
				$mail_html = "";
			$mail_html .="Product Sku :".$post['psku'];
			$mail_html .="\nName :".$post['name'];
			$mail_html .="\nEmail :".$post['email'];
			$mail_html .="\nZipCode :".$post['zip_code'];
			$mail_html .="\nPhone :".$post['phone'];
			$mail_html .="\nSPECIAL INSTRUCTIONS OR QUESTIONS? :".$post['content'];
				
			
				/*$mail = Mage::getModel('core/email');
				$mail->setToName('jewelrydemo.com');
				$mail->setToEmail('support@idealbrandmarketing.com');
				$mail->setBody($mail_html);
				$mail->setSubject('See Item In Person Request');
				$mail->setFromEmail('support@idealbrandmarketing.com');
				$mail->setFromName('jewelrydemo.com');
				$mail->setType('html');*/
				
				$mail = new Zend_Mail();
				$mail->setBodyText($mail_html);
				$mail->setFrom($post['email'], Mage::getStoreConfig('trans_email/ident_general/name')." - ".$post['name']);
				//$mail->addTo('support@idealbrandmarketing.com', 'Jewelrydemo See Item In Person Request');
				$mail->addTo(Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT), Mage::getStoreConfig('trans_email/ident_general/name').' See Item In Person Request');
				//$mail->addBcc('support@idealbrandmarketing.com');
				//$mail->addTo('info@losangelesdiamondseller.com', 'Some Recipient');
				$mail->setSubject('See Item In Person Request');
				
			try {
				$mail->send();	
				Mage::getSingleton('core/session')->addSuccess(Mage::helper('seeitperson')->__('Message was successfully sent'));
				$this->_redirectUrl($post['purl']);			
			} catch (Exception $e) {

                Mage::getSingleton('customer/session')->addError(Mage::helper('seeitperson')->__('Sorry Message could not send').$e->getMessage());
                $this->_redirectUrl($post['purl']);
                return;
            }
		}
		else {
            $this->_redirectUrl($post['purl']);
        }
	}
	
}
