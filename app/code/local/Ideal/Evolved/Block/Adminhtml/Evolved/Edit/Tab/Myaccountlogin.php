<?php

class Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Tab_Myaccountlogin extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('evolved_form_login', array('legend'=>Mage::helper('evolved')->__('Login Page')));
      
      $configSettings = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
      		array(
      				'add_images' => true,
      				'add_widgets' => true,
      				'add_variables' => true,
      				'files_browser_window_url'=> Mage::helper("adminhtml")->getUrl("adminhtml/cms_wysiwyg_images/index"),
      		));
      
      $fieldset->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));
     
      $fieldset->addField('login_text', 'text', array(
      		'label'     => Mage::helper('logo')->__('Main Title'),
      		'name'      => 'evolved_form_login[login_text]',
      ));
      
      $fieldset->addField('login_left_title', 'text', array(
      		'label'     => Mage::helper('logo')->__('Left Title'),
      		'name'      => 'evolved_form_login[login_left_title]',
      ));
      
      $fieldset->addField('login_right_title', 'text', array(
      		'label'     => Mage::helper('logo')->__('Right Title'),
      		'name'      => 'evolved_form_login[login_right_title]',
      ));
      
      $fieldset->addField('login_left_content', 'editor', array(
      		'label'     => Mage::helper('logo')->__('Left Content'),
      		'name'      => 'evolved_form_login[login_left_content]',
      		'config'    => $configSettings,
      ));
      
      $fieldset->addField('login_right_content', 'editor', array(
      		'label'     => Mage::helper('logo')->__('Right Content'),
      		'name'      => 'evolved_form_login[login_right_content]',
      		'config'    => $configSettings,
      ));
      
      $fieldset->addField('login_background_color', 'colorpicker', array(
          'label'     => Mage::helper('evolved')->__('Color, background:'),
          'name'      => 'evolved_form_login[login_background_color]',
      ));
      
      $fieldset->addField('login_background_image', 'image', array(
      		'label'     => Mage::helper('logo')->__('Image, background (optional)'),
      		'name'      => 'evolved_form_login[login_background_image]',
      ));
      
	   $fieldset1 = $form->addFieldset('evolved_form_login_left_sidebar', array('legend'=>Mage::helper('evolved')->__('Left Sidebar')));
	   $fieldset1->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));
	   
	   $fieldset1->addField('myaccount_sidebar_block_title_color', 'colorpicker', array(
	   		'label'     => Mage::helper('evolved')->__('Block ‐ Color, title:'),
	   		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_title_color]',
	   ));
	   
	   $fieldset1->addField('myaccount_sidebar_block_title_fontsize', 'text', array(
	   		'label'     => Mage::helper('evolved')->__('Block ‐ Color, title, size:'),
	   		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_title_fontsize]',
	   		'note' => Mage::helper('evolved')->__('Font size in PX'),
	   ));
	   
	   $fieldset1->addField('myaccount_sidebar_block_topborder_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Block ‐ Color, border, top:'),
      		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_topborder_color]',
      		'note' => Mage::helper('evolved')->__('Leave empty to use main color'),
      ));
	           
      $fieldset1->addField('myaccount_sidebar_block_background_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Block ‐ Color, background:'),
      		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_background_color]',
      ));  
      
      $fieldset1->addField('myaccount_sidebar_block_linkhover_background', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Block ‐ Color, background, link, hover:'),
      		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_linkhover_background]',
      ));
          
      $fieldset1->addField('myaccount_sidebar_block_link_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Block ‐ Color, link:'),
      		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_link_color]',
      ));
      
      $fieldset1->addField('myaccount_sidebar_block_linkhover_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Block ‐ Color, link, hover:'),
      		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_linkhover_color]',
      ));
      
	  $fieldset1->addField('myaccount_sidebar_block_activelink_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Block ‐ Color, link, active:'),
      		'name'      => 'evolved_form_login_left_sidebar[myaccount_sidebar_block_activelink_color]',
      ));
            
      /*$fieldset1->addField('myaccount_sidebar_button_textcolor', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Button text color:'),
      		'name'      => 'myaccount_sidebar_button_textcolor',
      ));
      
      $fieldset1->addField('myaccount_sidebar_button_background', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Button background color:'),
      		'name'      => 'myaccount_sidebar_button_background',
      		'note' => Mage::helper('evolved')->__('Leave empty to use main color'),
      ));
      
      $fieldset1->addField('myaccount_sidebar_button_text_hovercolor', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Button text hover color:'),
      		'name'      => 'myaccount_sidebar_button_text_hovercolor',
      ));
      
      $fieldset1->addField('myaccount_sidebar_button_background_hovercolor', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Button background hover color:'),
      		'name'      => 'myaccount_sidebar_button_background_hovercolor',
      ));*/
      
	  $fieldset2 = $form->addFieldset('evolved_form_login_right_sidebar', array('legend'=>Mage::helper('evolved')->__('Right Sidebar')));
	  $fieldset2->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color'));

	  $fieldset2->addField('myaccount_rightsidebar_text_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Color, text:'),
	  		'name'      => 'evolved_form_login_right_sidebar[myaccount_rightsidebar_text_color]',
	  ));
	  
	  $fieldset2->addField('myaccount_rightsidebar_link_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Color, link:'),
	  		'name'      => 'evolved_form_login_right_sidebar[myaccount_rightsidebar_link_color]',
	  ));
	  
	  $fieldset2->addField('myaccount_rightsidebar_title_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Color, title:'),
	  		'name'      => 'evolved_form_login_right_sidebar[myaccount_rightsidebar_title_color]',
	  ));
	  
	  $fieldset2->addField('myaccount_rightsidebar_subtitle_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Color, sub‐title:'),
	  		'name'      => 'evolved_form_login_right_sidebar[myaccount_rightsidebar_subtitle_color]',
	  ));
	  
	  
	   $fieldset3 = $form->addFieldset('evolved_form_account_menu_sidebar', array('legend'=>Mage::helper('evolved')->__('Acount page')));
	   $fieldset3->addType('colorpicker', Mage::getConfig()->getBlockClassName('Ideal_Evolved_Block_Adminhtml_Evolved_Edit_Renderer_Color')); 
	  
	  $fieldset3->addField('account_menu_sidebar', 'multiselect', array(
                  'label'     => Mage::helper('evolved')->__('Account Sidebar Menu Options'),
                  'name'      => 'evolved_form_account_menu_sidebar[account_menu_sidebar]',
                  'values' => array(
                                          array('value'=>'' , 'label' => 'Please Select'),
                                          array('value'=>'account_information' , 'label' => 'Account Information'),
                                          array('value'=>'address_book' , 'label' => 'Address Book'),
                                          array('value'=>'my_orders' , 'label' => 'My Orders'),
                                          array('value'=>'billing_agreements' , 'label' => 'Billing Agreements'),
                                          array('value'=>'recurring_profiles' , 'label' => 'Recurring Profiles'),
                                          array('value'=>'my_wishlist' , 'label' => 'My Wishlist'),
                                          array('value'=>'newsletter_subscriptions' , 'label' => 'Newsletter Subscriptions'),
                                          array('value'=>'saved_payment_information' , 'label' => 'Saved Payment Information')
                                          
                                          ),
      ));
      
      $fieldset3->addField('dashboard_intro', 'textarea', array(
      		'label'     => Mage::helper('evolved')->__('Dashboard introductions'),
      		'name'      => 'evolved_form_account_menu_sidebar[dashboard_intro]',
      ));
      
      $fieldset3->addField('account_sidemenu_selected_color', 'colorpicker', array(
      		'label'     => Mage::helper('evolved')->__('Color, Current page:'),
      		'name'      => 'evolved_form_account_menu_sidebar[account_sidemenu_selected_color]',
      ));
      
      $fieldset3->addField('account_sidemenu_selected_style', 'select', array(
      		'label'     => Mage::helper('evolved')->__(' Weight, text'),
      		'name'      => 'evolved_form_account_menu_sidebar[account_sidemenu_selected_style]',
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
      
      
      $fieldset3->addField('account_sidemenu_selected_descoration', 'select', array(
      		'label'     => Mage::helper('evolved')->__('Decoration, text'),
      		'name'      => 'evolved_form_account_menu_sidebar[account_sidemenu_selected_descoration]',
      		'values'    => array(
      				array('value'=>'','label'=>'Please Select'),
      				array('value'=>'underline','label'=>'underline'),
      				array('value'=>'inherit','label'=>'inherit'),
      				array('value'=>'bolder','label'=>'bolder'),
      				array('value'=>'inherit','label'=>'inherit'),
      				array('value'=>'initial','label'=>'initial'),
      				array('value'=>'line-through','label'=>'line-through'),
      				array('value'=>'none','label'=>'none'),
      				array('value'=>'overline','label'=>'overline'),      			
      		),
      ));
      
      

      
     
	  
	  //~ $fieldse3->addField('account_sidemenu_selected_style', 'select', array(
      		//~ 'label'     => Mage::helper('evolved')->__('Style, text'),
      		//~ 'name'      => 'evolved_form_account_menu_sidebar[account_sidemenu_selected_style]',
      		//~ 'values'    => array(
      				//~ array('value'=>'','label'=>'Please Select'),
      				//~ array('value'=>'normal','label'=>'normal'),
      				//~ array('value'=>'italic','label'=>'italic'),
      				//~ array('value'=>'oblique','label'=>'oblique'),
      				//~ array('value'=>'initial','label'=>'initial'),
      				//~ array('value'=>'inherit','label'=>'inherit'),
      		//~ ),
      //~ ));

	   
	   
	  /*$fieldset2->addField('myaccount_rightsidebar_button_background_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Button background color:'),
	  		'name'      => 'myaccount_rightsidebar_button_background_color',
	  ));
	  
	  $fieldset2->addField('myaccount_rightsidebar_button_text_color', 'colorpicker', array(
	  		'label'     => Mage::helper('evolved')->__('Button text color:'),
	  		'name'      => 'myaccount_rightsidebar_button_text_color',
	  ));*/
	  Mage::getSingleton('core/session')->setBlockName('evolved_myaccountlogin');
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
