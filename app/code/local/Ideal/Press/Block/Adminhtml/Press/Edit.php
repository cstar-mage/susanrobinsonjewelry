<?php

class Ideal_Press_Block_Adminhtml_Press_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'press';
        $this->_controller = 'adminhtml_press';
        
        $this->_updateButton('save', 'label', Mage::helper('press')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('press')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('press_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'press_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'press_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('press_data') && Mage::registry('press_data')->getId() ) {
            return Mage::helper('press')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('press_data')->getTitle()));
        } else {
            return Mage::helper('press')->__('Add Item');
        }
    }
}