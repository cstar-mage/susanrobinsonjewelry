<?php 
class Ideal_UrlRewriteImporter_Block_Adminhtml_UrlRewriteImporter_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('customer_info_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('customer')->__('Url Rewrite Importer'));
    }

    protected function _beforeToHtml() {
        $this->addTab('account', array(
            'label' => Mage::helper('customer')->__('Importer'),
            'content' => $this->getLayout()->createBlock('ideal_urlrewriteimporter/adminhtml_UrlRewriteImporter_edit_tab_Import')->initForm()->toHtml(),
            'active' => true
        ));

        return parent::_beforeToHtml();
    }

}
