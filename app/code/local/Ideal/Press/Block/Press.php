<?php
class Ideal_Press_Block_Press extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getPress()     
     { 
        if (!$this->hasData('press')) {
            $this->setData('press', Mage::registry('press'));
        }
        return $this->getData('press');
        
    }
}