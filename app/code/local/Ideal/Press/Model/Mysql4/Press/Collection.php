<?php

class Ideal_Press_Model_Mysql4_Press_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('press/press');
    }
}