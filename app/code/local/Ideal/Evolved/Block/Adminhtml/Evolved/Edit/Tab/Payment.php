<?php

class Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Tab_Payment extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('evolved_form_payment', array('legend'=>Mage::helper('evolved')->__('Payment')));
     
      $fieldset->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));
      
      /* $fieldset->addField('payment_', 'text', array(
          'label'     => Mage::helper('evolved')->__(''),
          'name'      => 'payment_',
      )); */
      $fieldset->addField('checkout_text_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Checkout Title Color:'),
      		'name'      => 'checkout_text_color',
      ));
      
      $fieldset->addField('checkout_bghover_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Checkout hover background:'),
      		'name'      => 'checkout_bghover_color',
      ));
      
      $fieldset->addField('checkout_step_title_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Title Color:'),
      		'name'      => 'checkout_step_title_color',
      ));
      
      $fieldset->addField('checkout_step_number_background', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Number Background:'),
      		'name'      => 'checkout_step_number_background',
      ));
      
      $fieldset->addField('checkout_step_number_active_background', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Number Active Background:'),
      		'name'      => 'checkout_step_number_active_background',
      ));
      
      $fieldset->addField('checkout_step_title_active_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Title Active Color:'),
      		'name'      => 'checkout_step_title_active_color',
      ));
      
      $fieldset->addField('checkout_edit_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Checkout Edit Color:'),
      		'name'      => 'checkout_edit_color',
      ));
      
      $fieldset->addField('checkout_step_number_active_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Number Active Background:'),
      		'name'      => 'checkout_step_number_active_color',
      ));
      
      $fieldset->addField('checkout_step_text_active_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('One Step Text Active Background:'),
      		'name'      => 'checkout_step_text_active_color',
      ));
      
      $fieldset->addField('checkout_button_background', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Checkout Button Background:'),
      		'name'      => 'checkout_button_background',
      ));
      
      $fieldset->addField('checkout_button_text_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Checkout Button Text Color:'),
      		'name'      => 'checkout_button_text_color',
      ));
      
      if ( Mage::getSingleton('adminhtml/session')->getEvolvedData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getEvolvedData());
          Mage::getSingleton('adminhtml/session')->setEvolvedData(null);
      } elseif ( Mage::registry('evolved_data') ) {
          $form->setValues(Mage::registry('evolved_data'));
      }
      return parent::_prepareForm();
  }
}