<?php
/**
 *
 * Created by:  Milan Simek
 * Company:     Plugin Company
 *
 * LICENSE: http://plugin.company/docs/magento-extensions/magento-extension-license-agreement
 *
 * YOU WILL ALSO FIND A PDF COPY OF THE LICENSE IN THE DOWNLOADED ZIP FILE
 *
 * FOR QUESTIONS AND SUPPORT
 * PLEASE DON'T HESITATE TO CONTACT US AT:
 *
 * SUPPORT@PLUGIN.COMPANY
 *
 */

class Plugincompany_Cmsrevisions_Model_Resource_Page extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('plugincompany_cmsrevisions/page', 'plugincompany_cms_page_id');
    }

}