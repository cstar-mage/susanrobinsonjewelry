<?php

class Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Tab_Privacypolicy extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      
      
      $configSettings = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
      		array(
      				'add_images' => true,
      				'add_widgets' => true,
      				'add_variables' => true,
      				'files_browser_window_url'=> Mage::helper("adminhtml")->getUrl("adminhtml/cms_wysiwyg_images/index"),
      		));
      $fieldset = $form->addFieldset('evolved_privacypolicy_main_title', array('legend'=>Mage::helper('evolved')->__('Privacy Policy Title')));
      
      $fieldset->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));
     
     
      $fieldset->addField('privacypolicy_main_title_color', 'colorpicker', array(
          'label'     => Mage::helper('evolved')->__('Color'),
          'name'      => 'evolved_privacypolicy_main_title[privacypolicy_main_title_color]',
      ));
      $fieldset->addField('privacypolicy_main_title_fontsize', 'text', array(
                  'label'     => Mage::helper('evolved')->__('Font Size:'),
                  'name'      => 'evolved_privacypolicy_main_title[privacypolicy_main_title_fontsize]',
                  'note' => Mage::helper('evolved')->__('Font size in PX'),
      ));

       $fieldset->addField('privacypolicy_main_title_texttransform', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Transform, text, title:'),
                  'name'      => 'evolved_privacypolicy_main_title[privacypolicy_main_title_texttransform]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'none','label'=>'none'),
                              array('value'=>'capitalize','label'=>'capitalize'),
                              array('value'=>'uppercase','label'=>'uppercase'),
                              array('value'=>'lowercase','label'=>'lowercase'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
      
      $fieldset->addField('privacypolicy_main_title_style', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Style, text, title:'),
                  'name'      => 'evolved_privacypolicy_main_title[privacypolicy_main_title_style]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'normal','label'=>'normal'),
                              array('value'=>'italic','label'=>'italic'),
                              array('value'=>'oblique','label'=>'oblique'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
      
      $fieldset->addField('privacypolicy_main_title_weight', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Weight, text, title:'),
                  'name'      => 'evolved_privacypolicy_main_title[privacypolicy_main_title_weight]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'normal','label'=>'normal'),
                              array('value'=>'bold','label'=>'bold'),
                              array('value'=>'bolder','label'=>'bolder'),
                              array('value'=>'lighter','label'=>'lighter'),
                              array('value'=>'100','label'=>'100'),
                              array('value'=>'200','label'=>'200'),
                              array('value'=>'300','label'=>'300'),
                              array('value'=>'400','label'=>'400'),
                              array('value'=>'500','label'=>'500'),
                              array('value'=>'600','label'=>'600'),
                              array('value'=>'700','label'=>'700'),
                              array('value'=>'800','label'=>'800'),
                              array('value'=>'900','label'=>'900'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
   
  
      
	   $fieldset1 = $form->addFieldset('evolved_privacypolicy_sub_title', array('legend'=>Mage::helper('evolved')->__('Privacy Policy Sub Title')));
	   $fieldset1->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));
	   
	   $fieldset1->addField('privacypolicy_sub_title_color', 'colorpicker', array(
	   		'label'     => Mage::helper('evolved')->__('Color, title:'),
	   		'name'      => 'evolved_privacypolicy_sub_title[privacypolicy_sub_title_color]',
	   ));
	   
	   $fieldset1->addField('privacypolicy_sub_title_fontsize', 'text', array(
	   		'label'     => Mage::helper('evolved')->__('Color, title, size:'),
	   		'name'      => 'evolved_privacypolicy_sub_title[privacypolicy_sub_title_fontsize]',
	   		'note' => Mage::helper('evolved')->__('Font size in PX'),
	   ));

         $fieldset1->addField('privacypolicy_sub_title_texttransform', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Transform, text, title:'),
                  'name'      => 'evolved_privacypolicy_sub_title[privacypolicy_sub_title_texttransform]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'none','label'=>'none'),
                              array('value'=>'capitalize','label'=>'capitalize'),
                              array('value'=>'uppercase','label'=>'uppercase'),
                              array('value'=>'lowercase','label'=>'lowercase'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
      
      $fieldset1->addField('privacypolicy_sub_title_style', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Style, text, title:'),
                  'name'      => 'evolved_privacypolicy_sub_title[privacypolicy_sub_title_style]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'normal','label'=>'normal'),
                              array('value'=>'italic','label'=>'italic'),
                              array('value'=>'oblique','label'=>'oblique'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
      
      $fieldset1->addField('privacypolicy_sub_title_weight', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Weight, text, title:'),
                  'name'      => 'evolved_privacypolicy_sub_title[privacypolicy_sub_title_weight]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'normal','label'=>'normal'),
                              array('value'=>'bold','label'=>'bold'),
                              array('value'=>'bolder','label'=>'bolder'),
                              array('value'=>'lighter','label'=>'lighter'),
                              array('value'=>'100','label'=>'100'),
                              array('value'=>'200','label'=>'200'),
                              array('value'=>'300','label'=>'300'),
                              array('value'=>'400','label'=>'400'),
                              array('value'=>'500','label'=>'500'),
                              array('value'=>'600','label'=>'600'),
                              array('value'=>'700','label'=>'700'),
                              array('value'=>'800','label'=>'800'),
                              array('value'=>'900','label'=>'900'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
   

	   
	         
	  $fieldset2 = $form->addFieldset('evolved_privacypolicy_content', array('legend'=>Mage::helper('evolved')->__('Privacy Policy Content')));
	  $fieldset2->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));

	  $fieldset2->addField('privacypolicy_content_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Color, text:'),
	  		'name'      => 'evolved_privacypolicy_content[privacypolicy_content_color]',
	  ));
	  
        $fieldset2->addField('privacypolicy_content_fontsize', 'text', array(
                  'label'     => Mage::helper('evolved')->__('Color, title, size:'),
                  'name'      => 'evolved_privacypolicy_content[privacypolicy_content_fontsize]',
                  'note' => Mage::helper('evolved')->__('Font size in PX'),
         ));


        $fieldset2->addField('privacypolicy_content_texttransform', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Transform, text, title:'),
                  'name'      => 'evolved_privacypolicy_content[privacypolicy_content_texttransform]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'none','label'=>'none'),
                              array('value'=>'capitalize','label'=>'capitalize'),
                              array('value'=>'uppercase','label'=>'uppercase'),
                              array('value'=>'lowercase','label'=>'lowercase'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
      
      $fieldset2->addField('privacypolicy_content_style', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Style, text, title:'),
                  'name'      => 'evolved_privacypolicy_content[privacypolicy_content_style]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'normal','label'=>'normal'),
                              array('value'=>'italic','label'=>'italic'),
                              array('value'=>'oblique','label'=>'oblique'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
      
      $fieldset2->addField('privacypolicy_content_weight', 'select', array(
                  'label'     => Mage::helper('evolved')->__('Weight, text, title:'),
                  'name'      => 'evolved_privacypolicy_content[privacypolicy_content_weight]',
                  'values'    => array(
                              array('value'=>'','label'=>'Please Select'),
                              array('value'=>'normal','label'=>'normal'),
                              array('value'=>'bold','label'=>'bold'),
                              array('value'=>'bolder','label'=>'bolder'),
                              array('value'=>'lighter','label'=>'lighter'),
                              array('value'=>'100','label'=>'100'),
                              array('value'=>'200','label'=>'200'),
                              array('value'=>'300','label'=>'300'),
                              array('value'=>'400','label'=>'400'),
                              array('value'=>'500','label'=>'500'),
                              array('value'=>'600','label'=>'600'),
                              array('value'=>'700','label'=>'700'),
                              array('value'=>'800','label'=>'800'),
                              array('value'=>'900','label'=>'900'),
                              array('value'=>'initial','label'=>'initial'),
                              array('value'=>'inherit','label'=>'inherit'),
                  ),
      ));
   
	  
	  
	  Mage::getSingleton('core/session')->setBlockName('evolved_privacypolicy');
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
