<?php

class ES_Newssubscribers_Model_Subscriber extends Mage_Newsletter_Model_Subscriber
{
	const XML_PATH_ADMIN_EMAIL_CONFIRMATION_TEMPLATE 		= 'newsletter/general/admin_email_template';
    public function getCouponCode()
    {
        if (!Mage::getStoreConfig('newsletter/coupon/isactive'))
            return '';

        $model = Mage::getModel('salesrule/rule');
        $model->load(Mage::getStoreConfig('newsletter/coupon/roleid'));
        $massGenerator = $model->getCouponMassGenerator();
        $session = Mage::getSingleton('core/session');
        try {
            $massGenerator->setData(array(
                'rule_id' => Mage::getStoreConfig('newsletter/coupon/roleid'),
                'qty' => 1,
                'length' => Mage::getStoreConfig('newsletter/coupon/length'),
                'format' => Mage::getStoreConfig('newsletter/coupon/format'),
                'prefix' => Mage::getStoreConfig('newsletter/coupon/prefix'),
                'suffix' => Mage::getStoreConfig('newsletter/coupon/suffix'),
                'dash' => Mage::getStoreConfig('newsletter/coupon/dash'),
                'uses_per_coupon' => 1,
                'uses_per_customer' => 1
            ));
            $massGenerator->generatePool();
            $latestCuopon = max($model->getCoupons());
        } catch (Mage_Core_Exception $e) {
            $session->addException($e, $this->__('There was a problem with coupon: %s', $e->getMessage()));
        }
        catch (Exception $e) {
            $session->addException($e, $this->__('There was a problem with coupon.'));
        }

        return $latestCuopon->getCode();
    }
    
    public function sendConfirmationSuccessEmail()
    {
 
    	if ($this->getImportMode()) {
    		return $this;
    	}
    
    	if(!Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_TEMPLATE)
    			|| !Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_IDENTITY)
    	) {
    		return $this;
    	}
    
    	$translate = Mage::getSingleton('core/translate');
    	/* @var $translate Mage_Core_Model_Translate */
    	$translate->setTranslateInline(false);
    
    	$email = Mage::getModel('core/email_template');
    	$theme = Ideal_Evolved_Block_Evolved::getConfig();
    	$coupen = $theme['newsletter_coupon_code'];
    	$email->sendTransactional(
    			Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_TEMPLATE),
    			Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_IDENTITY),
    			$this->getEmail(),
    			$this->getName(),
    			array('subscriber'=>$this,'coupen'=>$coupen)
    	);
    	$email->sendTransactional(
    	 Mage::getStoreConfig(self::XML_PATH_ADMIN_EMAIL_CONFIRMATION_TEMPLATE),
    	 Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_IDENTITY),
    	 Mage::getStoreConfig('trans_email/ident_general/email'),
    	 null,
    	 null
    	);
    	
    	$translate->setTranslateInline(true);
    
    	return $this;
    }
}