<?php

class Ideal_Press_Model_Mysql4_Press extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the press_id refers to the key field in your database table.
        $this->_init('press/press', 'press_id');
    }
}