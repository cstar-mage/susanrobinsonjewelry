<?php

class Ideal_Stud_Model_Mysql4_Carat_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('stud/carat');
    }
}