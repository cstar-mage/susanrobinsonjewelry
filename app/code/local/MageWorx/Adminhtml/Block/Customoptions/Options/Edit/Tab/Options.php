<?php

/**
 * MageWorx
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MageWorx EULA that is bundled with
 * this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.mageworx.com/LICENSE-1.0.html
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@mageworx.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extension
 * to newer versions in the future. If you wish to customize the extension
 * for your needs please refer to http://www.mageworx.com/ for more information
 * or send an email to sales@mageworx.com
 *
 * @category   MageWorx
 * @package    MageWorx_Adminhtml
 * @copyright  Copyright (c) 2009 MageWorx (http://www.mageworx.com/)
 * @license    http://www.mageworx.com/LICENSE-1.0.html
 */

/**
 * MageWorx Adminhtml extension
 *
 * @category   MageWorx
 * @package    MageWorx_Adminhtml
 * @author     MageWorx Dev Team <dev@mageworx.com>
 */
class MageWorx_Adminhtml_Block_Customoptions_Options_Edit_Tab_Options extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Options {

    public function __construct() {
        parent::__construct();
        $this->setTemplate('customoptions/catalog-product-edit-options.phtml');
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();

        $this->setChild('general_box', $this->getLayout()->createBlock('mageworx/customoptions_options_edit_tab_general')
        );

        $this->setChild('options_box', $this->getLayout()->createBlock('mageworx/customoptions_options_edit_tab_options_option')
        );

        $this->getChild('options_box')->getChild('select_option_type')->setTemplate('customoptions/options-edit-tab-options-type-select.phtml');

        return $this;
    }

    public function getGroupBoxHtml() {
        return $this->getChildHtml('general_box');
    }

    public function isPredefinedOptions() {
        return false;
    }

}