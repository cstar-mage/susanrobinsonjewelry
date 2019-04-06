<?php

class Ideal_Press_Block_Adminhtml_Press_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('press_form', array('legend'=>Mage::helper('press')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('press')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('press')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
	  
	   $fieldset->addField('url', 'text', array(
          'label'     => Mage::helper('press')->__('Url'),
          //'class'     => 'required-entry',
          'required'  => false,
          'name'      => 'url',
     
      ));	
      
       $fieldset->addField('sort', 'text', array(
          'label'     => Mage::helper('press')->__('Sort order'),
          'class'     => 'required-entry',
          'required'  => false,
          'required'  => true,
          'name'      => 'sort',
     
      ));	
       
      
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('press')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('press')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('press')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('press')->__('Content'),
          'title'     => Mage::helper('press')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getPressData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getPressData());
          Mage::getSingleton('adminhtml/session')->setPressData(null);
      } elseif ( Mage::registry('press_data') ) {
          $form->setValues(Mage::registry('press_data')->getData());
      }
      return parent::_prepareForm();
  }
}
