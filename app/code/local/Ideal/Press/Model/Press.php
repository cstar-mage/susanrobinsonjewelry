<?php

class Ideal_Press_Model_Press extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('press/press');
    }
}