<?php
class Ideal_Evolved_Adminhtml_EvolvedController extends Mage_Adminhtml_Controller_action {
	protected function _initAction() {
		$this->loadLayout ()->_setActiveMenu ( 'evolved/settings' )->_addBreadcrumb ( Mage::helper ( 'adminhtml' )->__ ( 'Theme Options' ), Mage::helper ( 'adminhtml' )->__ ( 'Theme Options' ) );
		
		return $this;
	}
	public function indexAction() {
		$this->_initAction ()->renderLayout ();
	}
	public function cssAction() {
		$baseurl = preg_replace ( '#^https?:#', '', Mage::getBaseUrl ( Mage_Core_Model_Store::URL_TYPE_MEDIA ) );
		
		$theme = Ideal_Evolved_Block_Evolved::getConfig ();
		/*
		 * echo "<pre>";
		 * print_r($theme);
		 * exit;
		 */
		// echo $this->getSkinUrl();
		
		$fontallsarr = Mage::getModel ( 'evolved/Font' )->toOptionSearchArray ();
		$fontlist = array (
				'fonts_main',
				'fonts_title',
				'fonts_price',
				'fonts_footer_title',
				'fonts_footer_link',
				'fonts_navigation',
				'fonts_block_title',
				'fonts_product_title',
				'fonts_productdetails_price',
				// 'fonts_product_name',
				'contacts_appointment_font',
				'contacts_title_font',
				'contacts_content_font',
				'fonts_productpage',
				'checkout_step_title_font',
				'checkout_step_number_font',
				'shopping_cart_page_title_font',
				'shopping_discount_label_font',
				'shopping_cart_table_title_font' 
		);
		for($looscount = 1; $looscount <= 11; $looscount ++) {
			$fontlist [] = 'homepage_element_' . $looscount . '_diamondrow_style_font';
		}
		$alreadyarrfont = array ();
		foreach ( $fontlist as $fontlistdata ) {
			if ((! in_array ( $theme [$fontlistdata], $alreadyarrfont )) && ($theme [$fontlistdata] != "")) {
				$alreadyarrfont [] = $theme [$fontlistdata];
				$themecssfile [$fontlistdata] = $theme [$fontlistdata];
			}
			$theme [$fontlistdata] = array_search ( $theme [$fontlistdata], $fontallsarr );
		}
		$txt = "";
		foreach ( $themecssfile as $themecssfilekey => $themecssfilevalue ) {
			$txt = $txt . "@import url(//fonts.googleapis.com/css?family=" . str_replace ( " ", "+", $themecssfile [$themecssfilekey] ) . "); ";
		}
		
		/*
		 * $homepage_element_diamond_font_model = Mage::getModel('evolved/evolved');
		 * $homepage_element_diamond_font_collection = $homepage_element_diamond_font_model->getCollection();
		 * $homepage_element_diamond_font_collection->addFieldToFilter('field', array('like' => 'homepage_element_%_style_enable'));
		 * foreach($homepage_element_diamond_font_collection->getData() as $homepage_element_diamond_font_collection_key => $homepage_element_diamond_font_collection_value)
		 * {
		 * if($theme['homepage_element_'.$homepage_element_diamond_font_collection_key.'_diamondrow_style_font'])
		 * {
		 * //echo $theme['homepage_element_'.$homepage_element_diamond_font_collection_key.'_diamondrow_style_font']."<br />";
		 * $txt = $txt." @import url(//fonts.googleapis.com/css?family=". str_replace(" ","+",$theme['homepage_element_'.$homepage_element_diamond_font_collection_key.'_diamondrow_style_font']) ."); ";
		 * }
		 * }
		 */
		if ($theme ['fonts_main'] != "") {
			$txt = $txt . " body, button, input, select, table, textarea { font-family :" . $theme ['fonts_main'] . "; }";
			$txt = $txt . " .cms-page-view .std p, .cms-no-route .std p, .cms-page-view .std li, .cms-no-route .std li, .termsandcondition #sidebar nav li a, .termsandcondition .termsandconditionright .termsdescription span.title, .termsandcondition .termsandconditionright .termsdescription { font-family :" . $theme ['fonts_main'] . "; color: " . $theme ['content_text_color'] . "; }";
		} else {
			$txt = $txt . " .cms-page-view .std p, .cms-no-route .std p, .cms-page-view .std li, .cms-no-route .std li, .termsandcondition #sidebar nav li a, .termsandcondition .termsandconditionright .termsdescription span.title, .termsandcondition .termsandconditionright .termsdescription { color: " . $theme ['content_text_color'] . "; }";
		}
		$txt = $txt . " .cms-page-view .std a { color: " . $theme ['content_link_color'] . "; background:" . $theme ['content_link_background'] . "; }";
		$txt = $txt . " .cms-page-view .std a:hover { color: " . $theme ['content_linkhover_color'] . "; background:" . $theme ['content_linkhover_background'] . "; }";
		$txt = $txt . " .cms-page-view .page-title h1 { color: " . $theme ['content_title_color'] . "; }";
		$txt = $txt . " body, .wrapper, body .main-container .main, .home-main.featured-tabs, .home-main.featured-tabs > dl > dd { background-color:" . $theme ['general_main_color'] . "; }";
		$txt = $txt . " body .main-container .main { margin-top:" . $theme ['header_bottom_space'] . "px; } ";
		$txt = $txt . " .page-header{ height:" . $theme ['header_height'] . "px; ";
		if ($theme ['header_underline_color']) {
			$txt = $txt . " border-bottom: 1px solid " . $theme ['header_underline_color'] . ";";
		} else {
			$txt = $txt . " border-bottom: none; ";
		}
		if ($theme ['sticky_header_options'] == 'enable') {
			$txt = $txt . " position: relative;";
		} else {
			$txt = $txt . " position: relative;";
		}
		$txt = $txt . " }";
		if ($theme ['header_underline_color']) {
			$txt = $txt . " .banner.banner--clone.banner--stick { border-bottom: 1px solid " . $theme ['header_underline_color'] . "; }";
		} else {
			$txt = $txt . " .banner.banner--clone.banner--stick { border-bottom: none; }";
		}
		/*
		 * if($theme['sticky_header_options'] == 'enable'){
		 * $txt = $txt." .main-container{margin-top:".($theme['header_height']-2)."px; }";
		 * }
		 */
		$txt = $txt . " .page-header-container{ height:" . $theme ['header_height'] . "px; }";
		if ($theme ['fonts_product_title'] != "") {
			$txt = $txt . " .product-name h1, .product-name .h1{ ";
			// $txt = $txt." color:".$theme['general_title_color']." !important;";
			$txt = $txt . " font-family:'" . $theme ['fonts_product_title'] . "' !important; ";
			$txt = $txt . "}";
		}
		if ($theme ['fonts_title'] != "") {
			$txt = $txt . " h1,h2,h3,h4,h5,h6,.page-title h1,.page-title h2{ font-family: '" . $theme ['fonts_title'] . "'; }";
		}
		if ($theme ['fonts_price'] != "") {
			$txt = $txt . " .price-box .price, .price{ font-family: '" . $theme ['fonts_price'] . "'; }";
		}
		if ($theme ['fonts_productdetails_price'] != "") {
			$txt = $txt . " .product-view .price-box .price,.product-view .price{ font-family: '" . $theme ['fonts_productdetails_price'] . "' !important; }";
		}
		
		// $txt = $txt." .price-box .regular-price .price{ color: ".$theme['general_price_color']."; }";
		// $txt = $txt." .price-box .old-price .price{ color: ".$theme['general_oldprice_color']."; }";
		// $txt = $txt." .price-box .old-price .price-label, .price-box .special-price .price-label{ color: ".$theme['general_pricetext_color']."; }";
		// $txt = $txt." .price-box .special-price .price{ color: ".$theme['general_onsaleprice_color']."; }";
		$txt = $txt . " .main-container .buttons-set a, .main-container .buttons-set a span, .main-container .buttons-set button span, button span span{ color: " . $theme ['buttons_text_color'] . " !important; text-transform: " . $theme ['buttons_text_texttransform'] . "; font-style: " . $theme ['buttons_text_style'] . "; font-weight: " . $theme ['buttons_text_weight'] . "; }";
		if ($theme ['buttons_text_size']) {
			$txt = $txt . " .main-container .buttons-set a, .main-container .buttons-set a span, .main-container .buttons-set button span, button span span { font-size: " . $theme ['buttons_text_size'] . "px; } ";
		}
		$txt = $txt . " .skip-cart, .skip-account{ background-color: " . $theme ['header_topbar_background_color'] . "; color: " . $theme ['header_topbar_text_color'] . "; }";
		$txt = $txt . " .skip-search .label, .skip-search:hover .label{ color: " . $theme ['header_topbar_text_color'] . "; }";
		$txt = $txt . " .skip-cart:hover, .skip-account:hover{ background-color: " . $theme ['header_topbar_texthover_color'] . "; color: " . $theme ['header_topbar_texthover_background_color'] . "; }";
		$txt = $txt . " .main-container .buttons-set a, .main-container .buttons-set button, button{ background-color: " . $theme ['buttons_background_color'] . "; }";
		$txt = $txt . " .main-container .buttons-set a:hover, button:hover span span, .main-container .buttons-set a:hover span, .main-container .buttons-set button:hover span{ color: " . $theme ['buttons_texthover_color'] . "; }";
		$txt = $txt . " .main-container .buttons-set button:hover, button:hover{ background-color: " . $theme ['buttons_bghover_color'] . " !important; }";
		$txt = $txt . " .wrapper .button.btn-cart span span,.wrapper .button2 span,.wrapper .button2 span span{ color: " . $theme ['buttons_addto_text_color'] . "; text-transform: " . $theme ['buttons_addto_text_texttransform'] . "; font-style: " . $theme ['buttons_addto_text_style'] . "; font-weight: " . $theme ['buttons_addto_text_weight'] . ";  }";
		if ($theme ['buttons_addto_text_size']) {
			$txt = $txt . " .wrapper .button.btn-cart span span,.wrapper .button2 span,.wrapper .button2 span span { font-size: " . $theme ['buttons_addto_text_size'] . "px; }";
		}
		$txt = $txt . " .button.btn-cart:hover span span,.btn-checkout:hover span span{ color: " . $theme ['buttons_addto_texthover_color'] . "; }";
		$txt = $txt . " .catalog-product-view .button.btn-cart,.btn-checkout{ background-color: " . $theme ['buttons_addto_background_color'] . "; }";
		$txt = $txt . " .button.btn-cart:hover{ background-color: " . $theme ['buttons_addto_bghover_color'] . "; }";
		/**
		 * ******************** Start Shopping cart ****************************
		 */
		$txt = $txt . " .checkout-cart-index .btn-proceed-checkout, .checkout-cart-index button.button2, .checkout-cart-index .btn-continue, .checkout-cart-index .btn-update, .checkout-cart-index .btn-empty{ background-color: " . $theme ['buttons_shopping_background_color'] . "; }";
		$txt = $txt . " .checkout-cart-index .btn-proceed-checkout span, .checkout-cart-index button.button2 span, .checkout-cart-index .btn-continue span, .checkout-cart-index .btn-update span, .checkout-cart-index .btn-empty span{ text-transform: " . $theme ['buttons_shopping_text_texttransform'] . "; font-style: " . $theme ['buttons_shopping_text_style'] . "; font-weight: " . $theme ['buttons_shopping_text_weight'] . "; color: " . $theme ['buttons_shopping_text_color'] . "; }";
		if ($theme ['buttons_shopping_text_size']) {
			$txt = $txt . " .checkout-cart-index .btn-proceed-checkout span, .checkout-cart-index button.button2 span, .checkout-cart-index .btn-continue span, .checkout-cart-index .btn-update span, .checkout-cart-index .btn-empty span { font-size: " . $theme ['buttons_shopping_text_size'] . "px; } ";
		}
		$txt = $txt . " .checkout-cart-index .btn-proceed-checkout:hover span, .checkout-cart-index button.button2:hover span, .checkout-cart-index .btn-continue:hover span, .checkout-cart-index .btn-update:hover span, .checkout-cart-index .btn-empty:hover span{ color: " . $theme ['buttons_shopping_text_hover_color'] . "; }";
		$txt = $txt . " .checkout-cart-index .btn-proceed-checkout:hover, .checkout-cart-index button.button2:hover, .checkout-cart-index .btn-continue:hover, .checkout-cart-index .btn-update:hover, .checkout-cart-index .btn-empty:hover{ background-color: " . $theme ['buttons_shopping_bghover_color'] . " !important; }";
		$txt = $txt . " .checkout-cart-index h2.product-name a, .checkout-cart-index h3.product-name a, .checkout-cart-index h4.product-name a, .checkout-cart-index h5.product-name a, .checkout-cart-index p.product-name a{ color: " . $theme ['shopping_product_name_color'] . "; font-size:" . $theme ['shopping_product_name_size'] . "px; }";
		//$txt = $txt . " .checkout-cart-index #shopping-cart-totals-table .subtotal, .checkout-cart-index #shopping-cart-totals-table .subtotal_price .price { color: " . $theme ['shopping_subtotal_color'] . "; font-size:" . $theme ['shopping_subtotal_size'] . "px; } ";
		//$txt = $txt . " .checkout-cart-index #shopping-cart-totals-table .grand_total strong, .checkout-cart-index #shopping-cart-totals-table .grand_total_price strong .price { color: " . $theme ['shopping_grandtotal_color'] . "; font-size:" . $theme ['shopping_grandtotal_size'] . "px; } ";
		$txt = $txt . " .checkout-cart-index #shopping-cart-totals-table tbody tr:first-child .price { color: " . $theme ['shopping_subtotal_color'] . "; font-size:" . $theme ['shopping_subtotal_size'] . "px; } ";
		$txt = $txt . " .checkout-cart-index #shopping-cart-totals-table tfoot .price { color: " . $theme ['shopping_grandtotal_color'] . "; font-size:" . $theme ['shopping_grandtotal_size'] . "px; } ";
		if ($theme ['shopping_right_background_color']) {
			$txt = $txt . " .cart-totals, .cart-forms .discount, .cart-forms .giftcard, .cart-forms .shipping{ background-color: " . $theme ['shopping_right_background_color'] . "; }";
		} else {
			$txt = $txt . " .cart-totals, .cart-forms .discount, .cart-forms .giftcard, .cart-forms .shipping{ background-color: " . $theme ['general_main_color'] . "; }";
		}
		/**
		 * ******************** End Shopping cart ****************************
		 */

        /**
		 * ******************** Start Privacy Policy Page ****************************
		 */

		
		$txt = $txt . ".cms-privacy-policy .col-main .page-title h1{ text-transform: " . $theme ['privacypolicy_main_title_texttransform'] . "; font-style: " . $theme ['privacypolicy_main_title_style'] . "; font-weight: " . $theme ['privacypolicy_main_title_weight'] . "; color: " . $theme ['privacypolicy_main_title_color'] . "; font-size: " . $theme ['privacypolicy_main_title_fontsize'] . "px; }";
		
		$txt = $txt . ".cms-privacy-policy .col-main .std span.title{ text-transform: " . $theme ['privacypolicy_sub_title_texttransform'] . "; font-style: " . $theme ['privacypolicy_sub_title_style'] . "; font-weight: " . $theme ['privacypolicy_sub_title_weight'] . "; color: " . $theme ['privacypolicy_sub_title_color'] . "; font-size: " . $theme ['privacypolicy_sub_title_fontsize'] . "px; }";
		
		$txt = $txt . ".cms-privacy-policy .col-main .std p.newp{ text-transform: " . $theme ['privacypolicy_content_texttransform'] . "; font-style: " . $theme ['privacypolicy_content_style'] . "; font-weight: " . $theme ['privacypolicy_content_weight'] . "; color: " . $theme ['privacypolicy_content_color'] . "; font-size: " . $theme ['privacypolicy_content_fontsize'] . "px; }";

		$txt = $txt . ".cms-privacy-policy .col-main .std .firstprivacy{ text-transform: " . $theme ['privacypolicy_content_texttransform'] . "; font-style: " . $theme ['privacypolicy_content_style'] . "; font-weight: " . $theme ['privacypolicy_content_weight'] . "; color: " . $theme ['privacypolicy_content_color'] . "; font-size: " . $theme ['privacypolicy_content_fontsize'] . "px; }";

		$txt = $txt . ".cms-privacy-policy .col-main .std .firstprivacy li{ text-transform: " . $theme ['privacypolicy_content_texttransform'] . "; font-style: " . $theme ['privacypolicy_content_style'] . "; font-weight: " . $theme ['privacypolicy_content_weight'] . "; color: " . $theme ['privacypolicy_content_color'] . "; font-size: " . $theme ['privacypolicy_content_fontsize'] . "px; }";    
		
		/**
		 * ******************** Start Privacy Policy Page ****************************
		 */


		
		/**
		 * ******************** Start promo banner header ****************************
		 */
		 
		 
		 $txt = $txt . " .promo-module { background-color:" . $theme ['header_promo_bg_color'] . "; min-height:" . $theme ['header_promo_height'] ."px; padding: 2px 0; width: 100%; }";
		 $txt = $txt . " .promo-module p{ color:" . $theme ['header_promo_text_color'] . "; text-align: center;    text-transform: uppercase;    font-weight: bold;    font-size: 14px;}";
		 
		 $txt = $txt . "@media only screen and (max-width: 770px){ ";
		 $txt = $txt . ".promo-module {display:none;}"; 
		 $txt = $txt . "} ";

		/**
		 * ******************** Start promo banner header ****************************
		 */
 

		if ($theme ['header_background_color']) {
			$txt = $txt . " header{ background-color:" . $theme ['header_background_color'] . ";";
		} else {
			$txt = $txt . " header{ background-color:" . $theme ['general_main_color'] . ";";
		}
		if ($theme ['header_background_image']) {
			// $txt = $txt."border-bottom: 1px solid ".$theme['header_underline_color'].";";
			$txt = $txt . " background-image: url('" . $baseurl . $theme ['header_background_image'] . "');";
			$txt = $txt . " background-repeat: " . $theme ['header_background_image_repeat'] . ";";
			$txt = $txt . " background-position: top " . $theme ['header_background_image_position'] . ";";
		} else {
			$txt = $txt . " background-image: none ;";
		}
		$txt = $txt . " }";
		
		if ($theme ['header_search_enable'] == "clickable") {
			$txt = $txt . "@media only screen and (min-width: 771px) { #header-search {display : none; } } ";
		} else if ($theme ['header_search_enable'] == "enable") {
			$txt = $txt . "@media only screen and (min-width: 771px) { #header-search {display : block !important; } } ";
		}
		$txt = $txt . " .logo{ background-color: " . $theme ['header_logo_background_color'] . "; }";
		$txt = $txt . " .skip-search{ background-color: " . $theme ['header_search_background'] . "; }";
		$txt = $txt . " #search{ color: " . $theme ['header_search_text_color'] . "; }";
		$txt = $txt . " #search::-webkit-input-placeholder{ color: " . $theme ['header_search_text_color'] . "; }";
		$txt = $txt . " #search:-moz-placeholder{ color: " . $theme ['header_search_text_color'] . "; }";
		$txt = $txt . " #search::-moz-placeholder{ color: " . $theme ['header_search_text_color'] . "; }";
		$txt = $txt . " #search:-ms-input-placeholder{ color: " . $theme ['header_search_text_color'] . "; }";
		$txt = $txt . " .dropdowntoplink{ margin-top: " . $theme ['header_dropdown_toplink_margintop'] . "px;  " . $theme ['toplinks_underline_color'] ."; background: " . $theme ['header_topbar_background_color'] . "; }";
		$txt = $txt . " .dropdowntoplink .links{ text-align: " . $theme ['header_dropdown_toplink_alignment'] . "; }";
		if ($theme ['fonts_navigation'] != "") {
			$txt = $txt . " .dropdowntoplink .links li a{ text-transform: " . $theme ['header_topbar_text_texttransform'] . "; font-style: " . $theme ['header_topbar_text_style'] . "; font-weight: " . $theme ['header_topbar_text_weight'] . "; font-family: '" . $theme ['fonts_navigation'] . "'; color: " . $theme ['header_topbar_text_color'] . "; font-size: " . $theme ['header_dropdown_toplink_fontsize'] . "px; }";
		} else {
			$txt = $txt . " .dropdowntoplink .links li a{ text-transform: " . $theme ['header_topbar_text_texttransform'] . "; font-style: " . $theme ['header_topbar_text_style'] . "; font-weight: " . $theme ['header_topbar_text_weight'] . "; color: " . $theme ['header_topbar_text_color'] . "; font-size: " . $theme ['header_dropdown_toplink_fontsize'] . "px; }";
		}
		
		$txt = $txt . " .dropdowntoplink .links li a:hover{ color: " . $theme ['header_topbar_texthover_color'] . "; background: " . $theme ['header_topbar_texthover_background_color'] . "; }";
		if ($theme ['header_dropdown_toplink_option'] == "simple") {
			$txt = $txt . " .search_main, .button.search-button{ display: block !important; } #header-search{ top: 42px; }";
		}
		// $txt = $txt." .header-minicart .skip-link .icon, .skip-account .icon, .skip-search .icon, .skip-nav .icon{ background: url('".Mage::getBaseUrl('skin').'frontend/evolved/default/images/icon_sprite_back_blue.png'."');}";
		/*
		 * $txt = $txt." .skip-nav .icon { ";
		 * if($theme['header_icon_color'] == "black"){ $txt = $txt." background-position: 0 5px; "; }
		 * else{ $txt = $txt." background-position: 51px 5px; "; }
		 * $txt = $txt." }";
		 * $txt = $txt." .header-minicart .skip-link .icon { ";
		 * if($theme['header_icon_color'] == "black"){ $txt = $txt." background-position: 0 -95px; "; }
		 * else{ $txt = $txt." background-position: -51px -95px; "; }
		 * $txt = $txt." }";
		 * $txt = $txt." .skip-account .icon { ";
		 * if($theme['header_icon_color'] == "black"){ $txt = $txt." background-position: 4px -44px; "; }
		 * else{ $txt = $txt." background-position: -45px -44px; "; }
		 * $txt = $txt." }";
		 * $txt = $txt." .skip-search .icon { ";
		 * if($theme['header_icon_color'] == "black"){
		 * $txt = $txt." background-position: 4px -146px; ";
		 * }
		 * else{ $txt = $txt." background-position: -45px -146px; ";
		 * }
		 * $txt = $txt." }";
		 */ 
		 $txt = $txt . ".block-account li.current a strong{ color: " . $theme ['account_sidemenu_selected_color'] . "; font-weight:". $theme ['account_sidemenu_selected_style'] . "; text-decoration:".$theme ['account_sidemenu_selected_descoration'].";}";
		  
		$txt = $txt . " .minicart-wrapper, .header-minicart .subtotal, #header-account.skip-active{ background-color: " . $theme ['header_dropdown_background_color'] . "; }";
		$txt = $txt . " .minicart-wrapper:hover, .minicart-wrapper:hover .subtotal, #header-account.skip-active:hover{ background-color: " . $theme ['header_dropdown_background_hover'] . "; }";
		$txt = $txt . " .minicart-wrapper #cart-sidebar .item{ background-color: " . $theme ['header_dropdown_item_background_color'] . "; }";
		$txt = $txt . " .minicart-wrapper #cart-sidebar .item .btn-edit, .minicart-wrapper #cart-sidebar .item .remove{ background-color: " . $theme ['header_dropdown_editremove_background'] . "; }";
		$txt = $txt . " .minicart-wrapper #cart-sidebar span, .minicart-wrapper #cart-sidebar label, .minicart-wrapper #cart-sidebar th, .minicart-wrapper #cart-sidebar td, .minicart-wrapper #cart-sidebar a, .header-minicart .subtotal .label, .header-minicart .minicart-actions .cart-link, .header-minicart #header-cart .block-subtitle, .header-minicart #header-cart p, #header-account.skip-active a{ color: " . $theme ['header_dropdown_text_color'] . "; }";
		$txt = $txt . " #header-cart:hover .block-subtitle, #header-cart:hover p, #header-cart:hover .subtotal .label{ color: " . $theme ['header_dropdown_background_hover_text_color'] . " !important; }";
		$txt = $txt . " .minicart-wrapper #cart-sidebar a:hover, #header-cart:hover .minicart-actions .cart-link:hover,	 #header-account.skip-active a:hover{ color: " . $theme ['header_dropdown_texthover_color'] . "; }";
		$txt = $txt . " .nav-primary{ text-align: " . $theme ['navigation_menu_alignment'] . "; }";
		$txt = $txt . " .nav-primary li.level0:not(.header_search_last) { ";
		if ($theme ['header_navigation_margin_between_links']) {
			$txt = $txt . " margin-left: " . $theme ['header_navigation_margin_between_links'] . "px; ";
		}
		if ($theme ['header_navigation_margin_below_links']) {
			$txt = $txt . " margin-bottom: " . $theme ['header_navigation_margin_below_links'] . "px; ";
		}
		if ($theme ['header_navigation_padding_abovebelow_text']) {
			$txt = $txt . " padding-top: " . $theme ['header_navigation_padding_abovebelow_text'] . "px; ";
			$txt = $txt . " padding-bottom: " . $theme ['header_navigation_padding_abovebelow_text'] . "px; ";
		}
		if ($theme ['header_navigation_padding_side_text']) {
			$txt = $txt . " padding-left: " . $theme ['header_navigation_padding_side_text'] . "px; ";
			$txt = $txt . " padding-right: " . $theme ['header_navigation_padding_side_text'] . "px; ";
		} elseif ($theme ['header_navigation_padding_side_text'] == 0) {
			$txt = $txt . " padding-left: " . $theme ['header_navigation_padding_side_text'] . "px; ";
			$txt = $txt . " padding-right: " . $theme ['header_navigation_padding_side_text'] . "px; ";
		}
		if ($theme ['header_navigation_border_top_color']) {
			if ($theme ['header_navigation_border_top_size']) {
				$txt = $txt . " border-top: " . $theme ['header_navigation_border_top_size'] . "px solid " . $theme ['header_navigation_border_top_color'] . "; ";
			} else {
				$txt = $txt . " border-top: 1px solid " . $theme ['header_navigation_border_top_color'] . "; ";
			}
		}
		if ($theme ['header_navigation_border_bottom_color']) {
			if ($theme ['header_navigation_border_bottom_size']) {
				$txt = $txt . " border-bottom: " . $theme ['header_navigation_border_bottom_size'] . "px solid " . $theme ['header_navigation_border_bottom_color'] . "; ";
			} else {
				$txt = $txt . " border-bottom: 1px solid " . $theme ['header_navigation_border_bottom_color'] . "; ";
			}
		}
		$txt = $txt . " } ";
		
		// $txt = $txt." .nav-primary li.level0 li.parent > a:after{ border-color:transparent -moz-use-text-color transparent: ".$theme['navigation_sub_icon_color']."; border-left: 4px solid ".$theme['navigation_sub_icon_color']." }";
		if ($theme ['fonts_navigation'] != "") {
			$txt = $txt . " .nav-primary a.level0{ text-transform: " . $theme ['navigation_top_text_texttransform'] . "; font-style: " . $theme ['navigation_top_text_style'] . "; font-weight: " . $theme ['navigation_top_text_weight'] . "; color: " . $theme ['navigation_top_color'] . "; font-size: " . $theme ['navigation_top_font_size'] . "px; font-family: '" . $theme ['fonts_navigation'] . "'; }";
		} else {
			$txt = $txt . " .nav-primary a.level0{ text-transform: " . $theme ['navigation_top_text_texttransform'] . "; font-style: " . $theme ['navigation_top_text_style'] . "; font-weight: " . $theme ['navigation_top_text_weight'] . "; color: " . $theme ['navigation_top_color'] . "; font-size: " . $theme ['navigation_top_font_size'] . "px; }";
		}
		
		$txt = $txt . " .nav-primary a.level0:hover{ color: " . $theme ['navigation_top_hover_color'] . "; }";
		$txt = $txt . " .nav-primary li.level0:hover{ background-color: " . $theme ['navigation_top_hover_background_color'] . "; }";
		$txt = $txt . " #header-nav{ background-color: " . $theme ['navigation_top_background_color'] . "; }";
		$txt = $txt . " .nav-primary li.level0 ul{ background-color: " . $theme ['navigation_sub_container_background'] . "; ";
		if ($theme ['navigation_megamenu_border_color']) {
			$txt = $txt . " border:1px solid " . $theme ['navigation_megamenu_border_color'] . "; ";
		}
		$txt = $txt . " }";
		$txt = $txt . " .nav-primary ul.level0 li.parent a{ color: " . $theme ['navigation_sub_text_color'] . "; font-size: " . $theme ['navigation_menu_font_size'] . "px; }";
		$txt = $txt . " .nav-primary ul.level0 li:not(.parent) a{ text-transform: " . $theme ['navigation_menu_text_texttransform'] . "; font-style: " . $theme ['navigation_menu_text_style'] . "; font-weight: " . $theme ['navigation_menu_text_weight'] . "; color: " . $theme ['navigation_sub_link_color'] . "; font-size: " . $theme ['navigation_menu_font_size'] . "px; }";
		$txt = $txt . " .nav-primary ul.level0 li:hover{ background-color: " . $theme ['navigation_sub_link_hover_background'] . "; }";
		$txt = $txt . " .nav-primary ul.level0 li a:hover{ color: " . $theme ['navigation_sub_link_hover_color'] . "; }";
		if ($theme ['header_dropdown_toplink_option'] == "simple") {
			$txt = $txt . " .skip-links{ display: none; }";
		} else {
			$txt = $txt . " .dropdowntoplink{ display: block; }";
		}
		if ($theme ['footer_background_color']) {
			$txt = $txt . " .footer-container{ background-color: " . $theme ['footer_background_color'] . "; margin-top: " . $theme ['footer_above_space'] . "px; }";
		} else {
			$txt = $txt . " .footer-container{ background-color: " . $theme ['general_main_color'] . "; margin-top: " . $theme ['footer_above_space'] . "px; }";
		}
		
		if ($theme ['fonts_block_title'] != "") {
			$txt = $txt . " .block-title{ font-family: '" . $theme ['fonts_block_title'] . "'; }";
		}
		// $txt = $txt." .footer-container, .footer p, .footer ul li a, .footer .form-subscribe-header label{ color: ".$theme['footer_text_color']."; font-family:".$theme['fonts_main']."; }";
		if ($theme ['fonts_main'] != "") {
			$txt = $txt . " .footer-container, .footer p, .footer .form-subscribe-header label{ color: " . $theme ['footer_text_color'] . "; font-family:" . $theme ['fonts_main'] . "; }";
		} else {
			$txt = $txt . " .footer-container, .footer p, .footer .form-subscribe-header label{ color: " . $theme ['footer_text_color'] . "; }";
		}
		if ($theme ['footer_border_color']) {
			$txt = $txt . " .footer-container .footer .block-title{ border-bottom: 2px solid " . $theme ['footer_border_color'] . "; border-top: 2px solid " . $theme ['footer_border_color'] . "; }";
		}
		if ($theme ['fonts_footer_title'] != "") {
			$txt = $txt . " .footer .block-title strong{ text-transform: " . $theme ['footer_title_texttransform'] . "; font-style: " . $theme ['footer_title_style'] . "; font-weight: " . $theme ['footer_title_weight'] . "; color: " . $theme ['footer_title_color'] . "; font-family:'" . $theme ['fonts_footer_title'] . "'; }";
		} else {
			$txt = $txt . " .footer .block-title strong{ text-transform: " . $theme ['footer_title_texttransform'] . "; font-style: " . $theme ['footer_title_style'] . "; font-weight: " . $theme ['footer_title_weight'] . "; color: " . $theme ['footer_title_color'] . "; }";
		}
		
		if ($theme ['fonts_footer_link'] != "") {
			$txt = $txt . " .footer .links a{ color: " . $theme ['footer_link_color'] . "; font-family:" . $theme ['fonts_footer_link'] . "; }";
		} else {
			if ($theme ['fonts_main'] != "") {
				$txt = $txt . " .footer .links a{ color: " . $theme ['footer_link_color'] . "; font-family:" . $theme ['fonts_main'] . "; }";
			} else {
				$txt = $txt . " .footer .links a{ color: " . $theme ['footer_link_color'] . "; }";
			}
		}
		$txt = $txt . " .footer .links a:hover{ color: " . $theme ['footer_linkhover_color'] . "; background-color:" . $theme ['footer_linkhover_background'] . "; }";
		if ($theme ['footer_newsletter_background']) {
			$txt = $txt . " .footer .lin-k{ background-color: " . $theme ['footer_newsletter_background'] . "; }";
		} else {
			if ($theme ['footer_background_color']) {
				$txt = $txt . " .footer .lin-k{ background-color: " . $theme ['footer_background_color'] . "; }";
			} else {
				$txt = $txt . " .footer .lin-k{ background-color: " . $theme ['general_main_color'] . "; }";
			}
		}
		$txt = $txt . " .footer .block-title strong, .footer p, .footer ul li a { font-size: " . $theme ['footer_all_text_size'] . "px; }";
		$txt = $txt . " .footer .lin-k{ background-color: " . $theme ['footer_newsletter_background'] . "; }";
		$txt = $txt . " .footer button span span{ color: " . $theme ['footer_button_text_color'] . "; text-transform: " . $theme ['footer_button_text_texttransform'] . "; font-style: " . $theme ['footer_button_text_style'] . "; font-weight: " . $theme ['footer_button_text_weight'] . ";  }";
		if ($theme ['footer_button_text_size']) {
			$txt = $txt . " .footer button span span { font-size: " . $theme ['footer_button_text_size'] . "px; }";
		}
		$txt = $txt . " .footer button{ background-color: " . $theme ['footer_button_background'] . " !important; }";
		$txt = $txt . " .footer button:hover span span{ color: " . $theme ['footer_button_text_hover'] . "; }";
		$txt = $txt . " .footer button:hover{ background-color: " . $theme ['footer_button_hover_background'] . " !important; }";
		if ($theme ['footer_copyright_background_color']) {
			$txt = $txt . " .footer-container .copyrights{ background-color: " . $theme ['footer_copyright_background_color'] . "; }";
		} else {
			$txt = $txt . " .footer-container .copyrights{ background-color: " . $theme ['general_main_color'] . "; }";
		}
		
		if ($theme ['fonts_main'] != "") {
			$txt = $txt . " .footer-container .copyrights address{ text-transform: " . $theme ['footer_copyright_text_texttransform'] . "; font-style: " . $theme ['footer_copyright_text_style'] . "; font-weight: " . $theme ['footer_copyright_text_weight'] . "; color: " . $theme ['footer_copyright_text_color'] . "; font-family:" . $theme ['fonts_main'] . "; font-size:" . $theme ['footer_copyright_text_size'] . "px; }";
		} else {
			$txt = $txt . " .footer-container .copyrights address{ text-transform: " . $theme ['footer_copyright_text_texttransform'] . "; font-style: " . $theme ['footer_copyright_text_style'] . "; font-weight: " . $theme ['footer_copyright_text_weight'] . "; color: " . $theme ['footer_copyright_text_color'] . "; font-size:" . $theme ['footer_copyright_text_size'] . "px; }";
		}
		
		$txt = $txt . " .footer-container .copyrights address a{ color: " . $theme ['footer_copyright_link_color'] . "; }";
		$txt = $txt . " .footer-container .copyrights address a:hover{ color: " . $theme ['footer_copyright_linkhover_color'] . "; background-color:" . $theme ['footer_copyright_linkhover_background'] . "; }";
		$txt = $txt . " .main-container .main{ background-color: " . $theme ['content_background_color'] . "; ";
		// if($theme['content_border_color']){ $txt = $txt." border: 1px solid ".$theme['content_border_color']."; "; }
		$txt = $txt . " }";
		$txt = $txt . " .home-main.featured-tabs .toggle-tabs { background: " . $theme ['content_background_color'] . ";  }";
		/**
		 * ****************** Start Footer dropdown responsive *******************
		 */
		$txt = $txt . "@media only screen and (max-width: 770px){ ";
		if ($theme ['footer_border_color']) {
			$txt = $txt . " .footerdropdownresponsive .footer .links .block-title { background-color: " . $theme ['footer_responsive_dropdown_background_color_title'] . "; border-bottom: 1px solid " . $theme ['footer_border_color'] . "; border-top: 1px solid " . $theme ['footer_border_color'] . "; }";
		} else {
			$txt = $txt . " .footerdropdownresponsive .footer .links .block-title { background-color: " . $theme ['footer_responsive_dropdown_background_color_title'] . "; }";
		}
		$txt = $txt . " .footerdropdownresponsive .footer .links .content { background-color: " . $theme ['footer_responsive_dropdown_background_color_link_sublevel'] . "; }";
		if ($theme ['footer_responsive_dropdown_color_title']) {
			$txt = $txt . " .footerdropdownresponsive .footer .block-title strong { color: " . $theme ['footer_responsive_dropdown_color_title'] . "; }";
		}
		$txt = $txt . " .footerdropdownresponsive .footer .block-title strong, .footerdropdownresponsive .footer .block-title { text-transform: " . $theme ['footer_responsive_dropdown_texttransform_title'] . "; font-style: " . $theme ['footer_responsive_dropdown_style_title'] . "; font-weight: " . $theme ['footer_responsive_dropdown_weight_title'] . "; }";
		if ($theme ['footer_responsive_dropdown_size_title']) {
			$txt = $txt . " .footerdropdownresponsive .footer .block-title strong, .footerdropdownresponsive .footer .block-title { font-size: " . $theme ['footer_responsive_dropdown_size_title'] . "px; }";
		}
		$txt = $txt . " } ";
		/**
		 * ****************** End Footer dropdown responsive *********************
		 */
		if ($theme ['fonts_main'] != "") {
			$txt = $txt . " .main-container .main span, .main-container .main label, th, td{ color: " . $theme ['content_text_color'] . "; font-family:'" . $theme ['fonts_main'] . "'; }";
		} else {
			$txt = $txt . " .main-container .main span, .main-container .main label, th, td{ color: " . $theme ['content_text_color'] . "; }";
		}
		
		$txt = $txt . " .main-container .main a{ background-color: " . $theme ['content_link_background'] . "; color:" . $theme ['content_link_color'] . "; }";
		$txt = $txt . " .main-container .main a:hover{ background-color: " . $theme ['content_linkhover_background'] . "; color:" . $theme ['content_linkhover_color'] . "; }";
		if ($theme ['login_background_image']) {
			$txt = $txt . " .account-login{ background-color: " . $theme ['login_background_color'] . "; background-image: url('" . $baseurl . $theme ['login_background_image'] . "'); }";
		}
		
		/*
		 * if($theme['homepage_textrow_font'] != "")
		 * {
		 * $txt = $txt." .home-info{ color: ".$theme['homepage_textrow_fontcolor']."; background-color:".$theme['homepage_textrow_background']."; font-family: '".$theme['homepage_textrow_font']."'; }";
		 * }
		 * else
		 * {
		 * $txt = $txt." .home-info{ color: ".$theme['homepage_textrow_fontcolor']."; background-color:".$theme['homepage_textrow_background']."; }";
		 * }
		 */
		
		/**
		 * ******************* Start education Slider ******************************
		 */
		$txt = $txt . " .std #accordion1 .slide_handle{ background: " . $theme ['de_tab_bg_color'] . ";";
		if ($theme ['de_tab_border_color']) {
			$txt = $txt . " border: 1px solid " . $theme ['de_tab_border_color'] . "; ";
		}
		$txt = $txt . " }";
		/*
		 * if($theme['de_tab_border_color'])
		 * {
		 * $txt = $txt." @media only screen and (max-width: 786px) {";
		 * $txt = $txt." .z-accordion.transition.vertical.z-grouped.z-bordered>section>.z-content, .z-accordion.transition.vertical.z-ungrouped.z-bordered>section>.z-content { ";
		 * $txt = $txt."border: 1px solid ".$theme['de_tab_border_color']."";
		 * $txt = $txt."}";
		 * " }";
		 * }
		 */
		$txt = $txt . " .std #accordion1 .slide_handle div{ text-transform: " . $theme ['de_tab_title_texttransform'] . "; font-style: " . $theme ['de_tab_title_style'] . "; font-weight: " . $theme ['de_tab_title_weight'] . "; color: " . $theme ['de_tab_title_color'] . "; }";
		if ($theme ['de_tab_title_size']) {
			$txt = $txt . " .std #accordion1 .slide_handle div { font-size: " . $theme ['de_tab_title_size'] . "px; } ";
		}
		$txt = $txt . " .std #accordion1 .slide_content h3,.std #accordion1 .slide_content h4{ color: " . $theme ['de_tab_content_title_color'] . "; }";
		$txt = $txt . " .std #accordion1 .slide_content p{ color: " . $theme ['de_tab_content_color'] . "; }";
		
		/**
		 * ***************new Slider ******************
		 */
		
		$txt = $txt . " .z-accordion.vertical.z-grouped.z-bordered > section > h3, .z-accordion.black.z-bordered, .z-accordion.black.z-bordered > section > h3, .z-accordion.black.z-bordered > section > h3 > .z-title { background: " . $theme ['de_tab_bg_color'] . "; color: " . $theme ['de_tab_title_color'] . ";";
		if ($theme ['de_tab_border_color']) {
			$txt = $txt . " border: 1px solid " . $theme ['de_tab_border_color'] . "; ";
		}
		$txt = $txt . " }";
		
		$txt = $txt . " .z-slider-wrapper .z-accordion.black.z-bordered > section > h3 > .z-title { text-transform: " . $theme ['de_tab_title_texttransform'] . "; font-style: " . $theme ['de_tab_title_style'] . "; font-weight: " . $theme ['de_tab_title_weight'] . "; }";
		if ($theme ['de_tab_title_size']) {
			$txt = $txt . " .z-slider-wrapper .z-accordion.vertical.z-grouped.z-bordered > section > h3, .z-slider-wrapper .z-accordion.black.z-bordered, .z-slider-wrapper .z-accordion.black.z-bordered > section > h3, .z-slider-wrapper .z-accordion.black.z-bordered > section > h3 > .z-title { font-size: " . $theme ['de_tab_title_size'] . "px; } ";
		}
		$txt = $txt . " .std #accordion1 .slide_content h3,.std #accordion1 .slide_content h4{ color: " . $theme ['de_tab_content_title_color'] . "; }";
		$txt = $txt . " .std #accordion1 .slide_content p { color: " . $theme ['de_tab_content_color'] . "; }";
		
		/**
		 * ******************* End education Slider ******************************
		 */
		
		$txt = $txt . " .toolbar{ background-color: " . $theme ['toolbar_background_color'] . "; }";
		if ($theme ['toolbar_dropdown_arrow_color']) {
			$txt = $txt . " .toolbar .sbHolder .sbToggle { border-top-color : " . $theme ['toolbar_dropdown_arrow_color'] . "; }";
		}
		$txt = $txt . " .toolbar, .toolbar .pager, .toolbar .pager label{ text-transform: " . $theme ['toolbar_text_texttransform'] . "; font-style: " . $theme ['toolbar_text_style'] . "; font-weight: " . $theme ['toolbar_text_weight'] . "; color: " . $theme ['toolbar_text_color'] . " !important; }";
		$txt = $txt . " .toolbar .sort-by > select, .toolbar .sbHolder .sbOptions{ background-color: " . $theme ['toolbar_dropdown_background'] . "; color:" . $theme ['toolbar_dropdown_textcolor'] . "; }";
		$txt = $txt . " .toolbar .sbHolder .sbOptions li a { color: " . $theme ['toolbar_dropdown_textcolor'] . "}";
		$txt = $txt . " .toolbar .pager .limiter > label{ text-transform: " . $theme ['toolbar_text_texttransform'] . "; font-style: " . $theme ['toolbar_text_style'] . "; font-weight: " . $theme ['toolbar_text_weight'] . "; color: " . $theme ['toolbar_text_color'] . " !important; }";
		if ($theme ['toolbar_text_size']) {
			$txt = $txt . " .toolbar, .toolbar .pager, .toolbar .pager label, .toolbar .pager .limiter > label { font-size: " . $theme ['toolbar_text_size'] . "px; } ";
		}
		$txt = $txt . " .toolbar .pages ol li{ background-color: " . $theme ['toolbar_pages_links_background'] . "; }";
		$txt = $txt . " .toolbar .pages ol li:hover{ background-color: " . $theme ['toolbar_pages_links_hover_background'] . "; }";
		$txt = $txt . " .toolbar .pages ol li a{ color: " . $theme ['toolbar_pages_links_textcolor'] . " !important; }";
		$txt = $txt . " .toolbar .pages ol li a:hover{ color: " . $theme ['toolbar_pages_links_hover_text'] . " !important; }";
		$txt = $txt . " .toolbar .limiter select{ background-color: " . $theme ['toolbar_dropdown_background'] . "; color:" . $theme ['toolbar_dropdown_textcolor'] . "; }";
		if ($theme ['breadcrumbs_background_color']) {
			$txt = $txt . " .wrapper .breadcrumbs{ background: " . $theme ['breadcrumbs_background_color'] . ";  margin: 0 0 " . $theme ['breadcrumbs_margin_below'] . "px; }";
		} else {
			$txt = $txt . " .wrapper .breadcrumbs{ background: none;  margin: 0 0 " . $theme ['breadcrumbs_margin_below'] . "px; }";
		}
		$txt = $txt . " .wrapper .breadcrumbs ul li{ text-transform: " . $theme ['breadcrumbs_text_texttransform'] . "; font-style: " . $theme ['breadcrumbs_text_style'] . "; font-weight: " . $theme ['breadcrumbs_text_weight'] . "; line-height: " . $theme ['breadcrumbs_text_size'] . "px; font-size:" . $theme ['breadcrumbs_text_size'] . "px; }";
		$txt = $txt . " .wrapper .breadcrumbs ul li a, .wrapper .breadcrumbs ul li span{ text-transform: " . $theme ['breadcrumbs_text_texttransform'] . "; font-style: " . $theme ['breadcrumbs_text_style'] . "; font-weight: " . $theme ['breadcrumbs_text_weight'] . "; color: " . $theme ['breadcrumbs_link_color'] . "; font-size:" . $theme ['breadcrumbs_text_size'] . "px; }";
		$txt = $txt . " .wrapper .breadcrumbs ul li a:hover{ color: " . $theme ['breadcrumbs_link_hover_color'] . "; }";
		$txt = $txt . " .wrapper .breadcrumbs ul li strong{ text-transform: " . $theme ['breadcrumbs_text_texttransform'] . "; font-style: " . $theme ['breadcrumbs_text_style'] . "; font-weight: " . $theme ['breadcrumbs_text_weight'] . "; color: " . $theme ['breadcrumbs_link_color'] . "; font-size:" . $theme ['breadcrumbs_text_size'] . "px; }";
		if ($theme ['productlist_block_topborder_color']) {
			$txt = $txt . " .catalog-category-view .col-left{ border-top: 1px solid " . $theme ['productlist_block_topborder_color'] . "; } ";
		}
		if ($theme ['productlist_block_padding_leftright']) {
			$sidepadding = " padding : 0 " . $theme ['productlist_block_padding_leftright'] . "px ;";
		}
		if ($theme ['productlist_margin_below_header']) {
			$txt = $txt . " .catalog-category-view .page-header { margin: 0 0 " . $theme ['productlist_margin_below_header'] . "px; }";
		}
		$txt = $txt . " .catalog-category-view .col-left{ background: " . $theme ['productlist_block_background_color'] . ";";
		if ($theme ['productlist_block_itemsborder_color']) {
			$txt = $txt . " border-top: 1px solid " . $theme ['productlist_block_itemsborder_color'] . "; ";
		}
		$txt = $txt . $sidepadding . "  }";
		if ($theme ['productlist_block_title_below_border_size']) {
			$lefttitlebordersize = $theme ['productlist_block_title_below_border_size'];
		} else {
			$lefttitlebordersize = 0;
		}
		$txt = $txt . " .block-layered-nav #narrow-by-list dt { border-bottom : " . $lefttitlebordersize . "px solid " . $theme ['productlist_block_title_below_border_color'] . " !important; }";
		$txt = $txt . " .catalog-category-view .col-left .block .block-title span{ color: " . $theme ['productlist_block_title_color'] . "; font-size:" . $theme ['productlist_block_title_fontsize'] . "px; }";
		//$txt = $txt . " .catalog-category-view .col-left .block .block-content dt .filter-name{ color: " . $theme ['productlist_block_text_color'] . "; }";
		$txt = $txt . " .catalog-category-view .col-left .block .block-content dt .filter-name{ color: " . $theme ['productlist_block_title_color'] . "; }";
		$txt = $txt . " .catalog-category-view .col-left .block .block-content dd ol li a, .catalog-category-view .col-left .block .block-content dd ol li .count, .catalog-category-view .col-left .block .block-content dd ol li .price{ color: " . $theme ['productlist_block_link_color'] . "; }";
		$txt = $txt . " .catalog-category-view .col-left .block .block-content dd ol li a:hover, .catalog-category-view .col-left .block .block-content dd ol li:hover .count, .catalog-category-view .col-left .block .block-content dd ol li:hover .price{ color: " . $theme ['productlist_block_linkhover_color'] . "; background-color:" . $theme ['productlist_block_linkhover_background'] . " !important; }";
		$txt = $txt . " .catalog-category-view .col-left .block .block-content .button span{ color: " . $theme ['productlist_block_button_textcolor'] . "; background:" . $theme ['productlist_block_button_background'] . "; text-transform: " . $theme ['productlist_block_button_text_texttransform'] . "; font-style: " . $theme ['productlist_block_button_text_style'] . "; font-weight: " . $theme ['productlist_block_button_text_weight'] . "; }";
		if ($theme ['productlist_block_button_text_size']) {
			$txt = $txt . " .catalog-category-view .col-left .block .block-content .button span { font-size: " . $theme ['productlist_block_button_text_size'] . "px; }";
		}
		$txt = $txt . " .catalog-category-view .col-left .block .block-content .button:hover span{ color: " . $theme ['productlist_block_button_text_hovercolor'] . "; background:" . $theme ['productlist_block_button_background_hovercolor'] . "; }";
		$txt = $txt . " .category-products h2.product-name a{ text-transform: " . $theme ['productlist_product_name_texttransform'] . "; font-style: " . $theme ['productlist_product_name_style'] . "; font-weight: " . $theme ['productlist_product_name_weight'] . "; color: " . $theme ['productlist_product_name_color'] . "; font-size:" . $theme ['productlist_product_name_fontsize'] . "px; }";
		$txt = $txt . " .category-products .product-name a:hover{ color: " . $theme ['productlist_producttitle_hover_color'] . "; background-color:" . $theme ['productlist_producttitle_hover_background'] . "; }";
		if (($theme ['productlist_productlist_proimage_border_color']) && ($theme ['productlist_productlist_prodescription'] != "hover")) {
			($theme ['productlist_productlist_proimage_border_size']) ? $imagebordersize = $theme ['productlist_productlist_proimage_border_size'] : $imagebordersize = 1;
			$txt = $txt . " .products-grid .product-image img { border: " . $imagebordersize . "px solid " . $theme ['productlist_productlist_proimage_border_color'] . "; }";
		}
		if (($theme ['productlist_productlist_proimage_border_color']) && ($theme ['productlist_productlist_prodescription'] == "hover")) {
			($theme ['productlist_productlist_proimage_border_size']) ? $imagebordersize = $theme ['productlist_productlist_proimage_border_size'] : $imagebordersize = 1;
			$txt = $txt . " .products-grid > li { border: " . $imagebordersize . "px solid " . $theme ['productlist_productlist_proimage_border_color'] . "; }";
		}
		$txt = $txt . " .products-grid > li .product-info { background: " . $theme ['productlist_productlist_prodescription_background_color'] . "; }";
		$txt = $txt . " .products-grid > li .product-info .price-box .price, .products-grid > li .product-info .out-of-stock, .products-grid > li .product-info .sku .skulabel, .products-grid > li .product-info .sku .skuvalue ,.products-grid > li .product-info .actions .add-to-links a  { color: " . $theme ['productlist_productlist_prodescription_text_color'] . "; }";
		if ($theme ['productlist_productlist_prodescription_background_opacity']) {
			$txt = $txt . " .products-grid > li .product-info, .products-grid > li:hover .product-info.hover { opacity: " . $theme ['productlist_productlist_prodescription_background_opacity'] . ";  }";
		}
		// $txt = $txt." .category-products .price-box .price:hover{ color: ".$theme['productlist_productprice_hover_color']."; }";
		// $txt = $txt." .category-products .button, .category-products .add-to-links a{ color: ".$theme['productlist_addto_textcolor']."; background-color:". $theme['productlist_grid_addto_background'] ."; }";
		// $txt = $txt." .category-products .button:hover span{ color:". $theme['productlist_addto_texthover'] ." !important; }";
		// $txt = $txt." .category-products .add-to-links a:hover{ color:". $theme['productlist_addto_texthover'] ."; }";
		// $txt = $txt." .category-products .products-grid .add-to-links a:hover, .category-products .products-grid .button:hover{ background-color:". $theme['productlist_grid_addto_hover_background'] ."; }";
		
		// $txt = $txt." .category-products .products-list .button:hover{ background-color:". $theme['productlist_list_addto_hover_background'] ."; }";
		$txt = $txt . " .products-list .desc.std:hover { color:" . $theme ['productlist_description_texthover'] . "; }";
		
		$txt = $txt . " .product-view .product-name .h1{ color:" . $theme ['productdetails_title_color'] . "; }";
		//$txt = $txt . " .product-view .short-description .std, .product-view .sharing-links li{ color:" . $theme ['productdetails_text_color'] . "; }";
		$txt = $txt . " .product-view  #recently-viewed-items span, .product-view  #recently-viewed-items p { color:" . $theme ['productdetails_text_color'] . "; }";
		//$txt = $txt . " .product-view a,.product-view a.link-wishlist{ color:" . $theme ['productdetails_link_color'] . " !important; background-color:" . $theme ['productdetails_link_background_color'] . " !important; }";
		$txt = $txt . " .product-view #recently-viewed-items a{ color:" . $theme ['productdetails_link_color'] . " !important; background-color:" . $theme ['productdetails_link_background_color'] . " !important; }";
		// $txt = $txt." .product-view a.link-wishlist{ background: url('". Mage::getBaseUrl('skin')."frontend/evolved/default/images/wishlist.jpg') no-repeat scroll left rgba(0, 0, 0, 0); }";
		//$txt = $txt . " .product-view a:hover, .product-view a.link-wishlist:hover{ color:" . $theme ['productdetails_linkhover_color'] . " !important; background-color:" . $theme ['productdetails_linkhover_background'] . " !important; }";
		$txt = $txt . " .product-view #recently-viewed-items a:hover { color:" . $theme ['productdetails_linkhover_color'] . " !important; background-color:" . $theme ['productdetails_linkhover_background'] . " !important; }";
		$txt = $txt . " .product-view .price-box .price, .product-view .price{ color:" . $theme ['productdetails_price_color'] . "; }";
		$txt = $txt . " .product-view .price-box .old-price .price, .product-view .old-price .price{ color:" . $theme ['productdetails_oldprice_color'] . "; }";
		$txt = $txt . " .product-view .price-label{ color:" . $theme ['productdetails_price_textcolor'] . " !important; }";
		if ($theme ['productdetails_attribute_border_color']) {
			$txt = $txt . " #product-attribute-specs-table tbody th{ border-bottom: 1px solid " . $theme ['productdetails_attribute_border_color'] . "; border-right: 1px solid " . $theme ['productdetails_attribute_border_color'] . "; }";
		}
		if ($theme ['productdetails_attribute_border_color']) {
			$txt = $txt . " #product-attribute-specs-table tbody td{ border-bottom: 1px solid " . $theme ['productdetails_attribute_border_color'] . "; }";
		}
		$txt = $txt . " #product-attribute-specs-table tbody th, #product-attribute-specs-table tbody td{ font-size:" . $theme ['productdetails_attribute_fontsize'] . "px; }";
		$txt = $txt . " #product-attribute-specs-table tbody tr.odd th, #product-attribute-specs-table tbody tr.odd td{ background:" . $theme ['productdetails_attribute_odd_background_color'] . "; color:" . $theme ['productdetails_attribute_odd_text_color'] . " !important; }";
		$txt = $txt . " #product-attribute-specs-table tbody tr.even th, #product-attribute-specs-table tbody tr.even td{ background:" . $theme ['productdetails_attribute_even_background_color'] . "; color:" . $theme ['productdetails_attribute_even_text_color'] . " !important; }";
		// $txt = $txt." .catalog-product-view .product-collateral .toggle-tabs{ background-color:". $theme['productdetails_tabhead_background'] ."; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li{ background-color: " . $theme ['productdetails_tabhead_background'] . ";";
		if ($theme ['productdetails_tabhead_border_color']) {
			$txt = $txt . " border: 1px solid " . $theme ['productdetails_tabhead_border_color'] . ";";
		}
		$txt = $txt . " }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt{ background-color: " . $theme ['productdetails_tabhead_background'] . ";";
		if ($theme ['productdetails_tabhead_border_color']) {
			$txt = $txt . " border: 1px solid " . $theme ['productdetails_tabhead_border_color'] . ";";
		}
		$txt = $txt . " }";
		
		if ($theme ['productdetails_tabhead_border_color']) {
			$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li:first-child{ border: 1px solid " . $theme ['productdetails_tabhead_border_color'] . "; }";
			$txt = $txt . " .catalog-product-view .product-collateral dl dt:first-child{ border: 1px solid " . $theme ['productdetails_tabhead_border_color'] . "; }";
		}
		if ($theme ['productdetails_tabhead_border_color']) {
			$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li:last-child{ border: 1px solid " . $theme ['productdetails_tabhead_border_color'] . "; }";
			$txt = $txt . "  .catalog-product-view .product-collateral dl dt:last-child{ border: 1px solid " . $theme ['productdetails_tabhead_border_color'] . "; }";
		}
		if ($theme ['productdetails_tabcontent_border_color']) {
			$txt = $txt . " .catalog-product-view #collateral-tabs{ border: 1px solid " . $theme ['productdetails_tabcontent_border_color'] . "; }";
			$txt = $txt . " .catalog-product-view .product-collateral > dl > dd{ border: 1px solid " . $theme ['productdetails_tabcontent_border_color'] . "; }";
		}
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li{ background-color: " . $theme ['productdetails_tabhead_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt{ background-color: " . $theme ['productdetails_tabhead_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li:hover{ background-color: " . $theme ['productdetails_tabhead_hover_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt:hover{ background-color: " . $theme ['productdetails_tabhead_hover_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li > span{ color: " . $theme ['productdetails_tabhead_textcolor'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt > span{ color: " . $theme ['productdetails_tabhead_textcolor'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li:hover span{ color: " . $theme ['productdetails_tabhead_texthover_color'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt:hover span{ color: " . $theme ['productdetails_tabhead_texthover_color'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li:hover{ background-color: " . $theme ['productdetails_tab_hover_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt:hover{ background-color: " . $theme ['productdetails_tab_hover_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li.current{ background-color: " . $theme ['productdetails_active_tabhead_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt.current{ background-color: " . $theme ['productdetails_active_tabhead_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li.current span{ color: " . $theme ['productdetails_active_tabhead_text_color'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt.current span{ color: " . $theme ['productdetails_active_tabhead_text_color'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li.current:hover{ background-color: " . $theme ['productdetails_active_tabhead_hover_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt.current:hover{ background-color: " . $theme ['productdetails_active_tabhead_hover_background'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li.current:hover span{ color: " . $theme ['productdetails_active_tabhead_hover_text_color'] . "; }";
		$txt = $txt . " .catalog-product-view .product-collateral dl dt.current:hover span{ color: " . $theme ['productdetails_active_tabhead_hover_text_color'] . "; }";
		$txt = $txt . " .catalog-product-view .collateral-tabs, .catalog-product-view .collateral-tabs .data-table td, .catalog-product-view .collateral-tabs .data-table th{ color: " . $theme ['productdetails_tabcontent_textcolor'] . " !important; background-color:" . $theme ['productdetails_tabcontent_background'] . "; }";
		$txt = $txt . " .catalog-product-view .tab-content .data-table th{ background-color: " . $theme ['productdetails_attribute_table_heading_background'] . "; }";
		$txt = $txt . " .catalog-product-view .tab-content a{ background-color: " . $theme ['productdetails_tabcontent_link_background'] . " !important; color: " . $theme ['productdetails_tabcontent_link_color'] . " !important; }";
		$txt = $txt . " .catalog-product-view .tab-content a:hover{ background-color: " . $theme ['productdetails_tabcontent_linkhover_background'] . " !important; color: " . $theme ['productdetails_tabcontent_linkhover_color'] . " !important; }";
		// Start social theme 1 //
		// echo $theme['social_icons_size']."<br />";
		// echo $theme['social_icons_theme']."<br />"; exit;
		$colorscroll = 'filter:';
		if ($theme ['social_color_deg'] != "") {
			$colorscrollcss .= " hue-rotate(" . $theme ['social_color_deg'] . "deg) ";
			// $huetotate = "filter:hue-rotate(".$theme['social_color_deg']."deg); -webkit-filter:hue-rotate(".$theme['social_color_deg']."deg);";
		}
		if ($theme ['social_color_saturate_deg'] != "") {
			$colorscrollcss .= " saturate(" . $theme ['social_color_saturate_deg'] . ") ";
			// $huetotate = "filter:hue-rotate(".$theme['social_color_deg']."deg); -webkit-filter:hue-rotate(".$theme['social_color_deg']."deg);";
		}
		if ($theme ['social_color_brightness_deg'] != "") {
			$colorscrollcss .= " brightness(" . $theme ['social_color_brightness_deg'] . ") ";
			// $huetotate = "filter:hue-rotate(".$theme['social_color_deg']."deg); -webkit-filter:hue-rotate(".$theme['social_color_deg']."deg);";
		}
		if ($colorscrollcss == "") {
			$colorscrollcss .= " hue-rotate(0deg) ";
			$colorscrollcss .= " saturate(1) ";
			$colorscrollcss .= " brightness(1) ";
		}
		
		$colorscroll = $colorscroll . $colorscrollcss . ";";
		$webkit_colorscroll = str_replace ( "filter", "-webkit-filter", $colorscroll );
		$socialexplode = explode ( "/", $theme ['social_icons_theme'] );
		$socialexplodearr = explode ( ".", $socialexplode [1] );
		$socialtheme = explode ( "_", $socialexplodearr [0] );
		$huetotate = $colorscroll . " " . $webkit_colorscroll;
		/**
		 * ****************** start Sixteen social theme *******************************
		 */
		// echo $socialexplode[0]; exit;
		if ($socialexplode [0] == 16) {
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .facebook{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .twitter{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -16px 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .pinterest{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -32px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .instagram{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .foursquare{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -16px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .fancy{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -16px -16px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .polyvore{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -32px -16px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .yelp{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px -16px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .youtube{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .gplus{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -16px -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .linkedin{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -32px -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_16 .tumbler{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
		} else if ($socialexplode [0] == 24) {
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .facebook{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .twitter{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -24px 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .pinterest{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .instagram{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -72px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .foursquare{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -24px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .fancy{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -24px -24px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .polyvore{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px -24px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .yelp{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -72px -24px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .youtube{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .gplus{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -24px -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .linkedin{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_24 .tumbler{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -72px -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
		} else if ($socialexplode [0] == 32) {
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .facebook{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .twitter{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -32px 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .pinterest{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -64px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .instagram{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -96px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .foursquare{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .fancy{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -32px -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .polyvore{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -64px -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .yelp{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -96px -32px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .youtube{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -64px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .gplus{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -32px -64px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .linkedin{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -64px -64px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_32 .tumbler{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -96px -64px rgba(0, 0, 0, 0); " . $huetotate . " }";
		} else if ($socialexplode [0] == 48) {
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .facebook{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .twitter{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px 0 rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .pinterest{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -96px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .instagram{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -144px 0px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .foursquare{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .fancy{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .polyvore{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -96px -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .yelp{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -144px -48px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .youtube{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll 0 -96px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .gplus{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -48px -96px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .linkedin{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -96px -96px rgba(0, 0, 0, 0); " . $huetotate . " }";
			$txt = $txt . " .social_icons_" . $socialtheme [0] . "_48 .tumbler{ background: url('" . $baseurl . "evolved/social/" . $theme ['social_icons_theme'] . "') no-repeat scroll -144px -96px rgba(0, 0, 0, 0); " . $huetotate . " }";
		}
		
		/**
		 * ****************** end Sixteen social theme *******************************
		 */
		// start contact//
		if ($theme ['contacts_title_font'] != "") {
			$txt = $txt . " #contactForm h2.legend{ text-transform: " . $theme ['contacts_title_texttransform'] . "; font-style: " . $theme ['contacts_title_style'] . "; font-weight: " . $theme ['contacts_title_weight'] . " !important; font-family: '" . $theme ['contacts_title_font'] . "'; color: " . $theme ['contacts_title_fontcolor'] . "; }";
		} else {
			$txt = $txt . " #contactForm h2.legend{ text-transform: " . $theme ['contacts_title_texttransform'] . "; font-style: " . $theme ['contacts_title_style'] . "; font-weight: " . $theme ['contacts_title_weight'] . " !important; color: " . $theme ['contacts_title_fontcolor'] . "; }";
		}
		if ($theme ['contacts_title_size']) {
			$txt = $txt . " #contactForm h2.legend{ font-size: " . $theme ['contacts_title_size'] . "px; }";
		}
		if ($theme ['contacts_content_font'] != "") {
			$txt = $txt . " .Contct_Addrress .cnt-addrs .cnt-adres-text, .Contct_Addrress .cnt-addrs .cnt-title, #contactForm .fieldset .fields label{ font-family: '" . $theme ['contacts_content_font'] . "'; color: " . $theme ['contacts_content_fontcolor'] . "; }";
		} else {
			$txt = $txt . " .Contct_Addrress .cnt-addrs .cnt-adres-text, .Contct_Addrress .cnt-addrs .cnt-title, #contactForm .fieldset .fields label{ color: " . $theme ['contacts_content_fontcolor'] . "; }";
		}
		
		if ($theme ['contacts_appointment_font'] != "") {
			$txt = $txt . " .make-apointment .inline2.cboxElement, .make-apointment .inline2.cboxElement:hover{ font-family: '" . $theme ['contacts_appointment_font'] . "'; color: " . $theme ['contacts_appointment_fontcolor'] . "; background-color: " . $theme ['contacts_appointment_background'] . "; text-transform: " . $theme ['contacts_appointment_text_texttransform'] . "; font-style: " . $theme ['contacts_appointment_text_style'] . "; font-weight: " . $theme ['contacts_appointment_text_weight'] . "; }";
		} else {
			$txt = $txt . " .make-apointment .inline2.cboxElement, .make-apointment .inline2.cboxElement:hover{ color: " . $theme ['contacts_appointment_fontcolor'] . "; background-color: " . $theme ['contacts_appointment_background'] . "; text-transform: " . $theme ['contacts_appointment_text_texttransform'] . "; font-style: " . $theme ['contacts_appointment_text_style'] . "; font-weight: " . $theme ['contacts_appointment_text_weight'] . "; }";
		}
		
		if ($theme ['contacts_appointment_text_size']) {
			$txt = $txt . " .make-apointment .inline2.cboxElement, .make-apointment .inline2.cboxElement:hover { font-size: " . $theme ['contacts_appointment_text_size'] . "px; } ;";
		}
		// end contact//
		$txt = $txt . " .home-main.featured-tabs .toggle-tabs{ background: " . $theme ['general_main_color'] . "; }";
		if ($theme ['header_logo_placement'] == "center") {
			$txt = $txt . ".page-header-container { width: 100%; text-align: center; } ";
			$txt = $txt . ".logo { float: none; display: inline-table; margin: " . $theme ['margin_above_logo'] . "px auto 0; text-align: center; width:auto; } ";
			$txt = $txt . ".logo img { float: none; } ";
		} else {
			$txt = $txt . ".page-header-container { width: 100%; text-align: left; } ";
			$txt = $txt . ".logo { float: left; display: inline-table; margin: " . $theme ['margin_above_logo'] . "px auto 0; text-align: center; width:auto; } ";
			$txt = $txt . ".logo img { float: left; } ";
		}
		
		if ($theme ['navigation_menu_vertical_alignment'] == "center") {  
			$txt = $txt. ".page-header-container #header-nav {  position: absolute;  display: table;  width: 100%; }";
			$txt = $txt. ".page-header-container nav#nav {  display: table-cell;  vertical-align: middle;}";
			$txt = $txt. ".page-header-container ol.nav-primary { margin-top: 45px;}";
			} 
		if ($theme ['navigation_menu_vertical_alignment'] == "top") {  
			$txt = $txt. ".page-header-container #header-nav {  position: absolute;  display: table;  width: 100%;  }";
			$txt = $txt. ".page-header-container nav#nav {  display: table-cell;  vertical-align: top;}";
			$txt = $txt. ".page-header-container ol.nav-primary { margin-top: 45px;}";
		}
		if ($theme ['navigation_menu_vertical_alignment'] == "bottom") {  
			$txt = $txt. ".page-header-container #header-nav {  position: absolute;  display: table;  width: 100%; }";
			$txt = $txt. ".page-header-container nav#nav {  display: table-cell;  vertical-align: bottom;}";
		}

/*		if ($theme ['header_logo_vertical_alignment'] == "center") { 
			$txt = $txt.".page-header-container { overflow: hidden; }";
			$txt = $txt."@media only screen and (min-width: 770px){ .dummy { padding-top: 100%;} }";
			$txt = $txt."@media only screen and (min-width: 770px){ .logo { position: absolute;  top: 0;  bottom: 0;  display: flex;  justify-content: center;  align-items: center;  margin-top: 45px;} }";			
		}		
		if ($theme ['header_logo_vertical_alignment'] == "top") { 
			$txt = $txt.".page-header-container { overflow: hidden; }";
			$txt = $txt."@media only screen and (min-width: 770px){ .dummy { padding-top: 100%;}}";
			$txt = $txt."@media only screen and (min-width: 770px){ .logo { position: absolute;  top: 0; display: flex;  justify-content: center;  align-items: center;  margin-top: 45px;}}";			
		}
		if ($theme ['header_logo_vertical_alignment'] == "bottom") {
			$txt = $txt.".page-header-container { overflow: hidden; }";
			$txt = $txt."@media only screen and (min-width: 770px){ .dummy { padding-top: 100%;}}";
			$txt = $txt."@media only screen and (min-width: 770px){ .logo { position: absolute; bottom: 0;  display: flex;  justify-content: center;  align-items: center;  margin-top: 45px;} }";			
		} */
		
		
		
		/*
		 * $txt = $txt." .logo{ ";
		 * if($theme['header_logo_placement']=="center"){
		 * $txt = $txt." margin-left: 36%; margin-right: 38%; ";
		 * }
		 * else{ $txt = $txt." margin-left: 0; margin-right: 0; "; }
		 * $txt = $txt." margin-top: ".$theme['margin_above_logo']."px; ";
		 * $txt = $txt." } ";
		 * $txt = $txt." .logo img{ ";
		 * if($theme['header_logo_placement']=="center"){ $txt = $txt." float: none; "; }
		 * else{ $txt = $txt." float: left; "; }
		 * $txt = $txt." } ";
		 */
		// Start Media css //
		$txt = $txt . "@media only screen and (max-width: 770px){ ";
		// $txt = $txt." #nav .nav-primary li.parent.sub-menu-active > a:after, .nav-primary li.parent.menu-active > a:after{ border-color: ". $theme['navigation_sub_icon_color'] ." transparent -moz-use-text-color; color: ".$theme['contacts_appointment_fontcolor']."; border-top: 5px solid ".$theme['navigation_sub_icon_color']."; border-left: 5px solid Transparent; }";
		// $txt = $txt." #nav .nav-primary li.level0.parent.sub-menu-active > a:after, .nav-primary li.level0.parent.menu-active > a:after{ content: none; } ";
		if ($theme ['header_responsive_logo_placement'] == "center") {
			$txt = $txt . ".page-header-container { width: 100%; text-align: center; } ";
			$txt = $txt . ".logo { float: none; display: inline-table; margin: " . $theme ['margin_above_logo'] . "px auto 0; text-align: center; width:auto; } ";
			$txt = $txt . ".logo img { float: none; } ";
			$txt = $txt . ".banner.banner--clone.banner--stick { height: 105px !important; } ";
		} else {
			$txt = $txt . ".page-header-container { width: 100%; text-align: left; } ";
			$txt = $txt . ".logo { float: left; display: inline-table; margin: " . $theme ['margin_above_logo'] . "px auto 0px 10px; text-align: center; width:auto; } ";
			$txt = $txt . ".logo img { float: left; } ";
		}
		/*
		 * $txt = $txt." .logo{ ";
		 * if($theme['header_responsive_logo_placement']=="center"){ $txt = $txt." margin: ".$theme['margin_above_logo']."px auto 0; "; }
		 * else { $txt = $txt."margin: ".$theme['margin_above_logo']."px 0 0 20px; "; }
		 * $txt = $txt." } ";
		 * $txt = $txt." .logo img{ ";
		 * if($theme['header_logo_placement']=="center"){ $txt = $txt." float: none; "; }
		 * else{ $txt = $txt." float: left; "; }
		 * $txt = $txt." } ";
		 */
		$txt = $txt . " .nav-primary ul.level0 li a:hover{ background: " . $theme ['navigation_sub_link_hover_background'] . "; } ";
		$txt = $txt . " .skip-search{ background: " . $theme ['header_topbar_background_color'] . "; } ";
		$txt = $txt . " .skip-search:hover{ background: " . $theme ['header_topbar_texthover_background_color'] . "; } ";
		$txt = $txt . " .dropdowntoplink{ display: none; } ";
		$txt = $txt . " .skip-links{ display: block; } ";
		$txt = $txt . " } ";
		// End Media css //
		$txt = $txt . " .product-view .product-right .product-shop .product-name span.h1{ text-transform: " . $theme ['productdetails_title_texttransform'] . "; font-style: " . $theme ['productdetails_title_style'] . "; font-weight: " . $theme ['productdetails_title_weight'] . "; font-size: " . $theme ['productdetails_title_font_size'] . "px; } ";
		$txt = $txt . " .product-view .product-right .product-shop .product-sku span.h1{ text-transform: " . $theme ['productdetails_sku_texttransform'] . "; font-style: " . $theme ['productdetails_sku_style'] . "; font-weight: " . $theme ['productdetails_sku_weight'] . "; color: " . $theme ['productdetails_sku_color'] . " !important; } ";
		
		if ($theme ['fonts_productpage'] != "") {
			//$txt = $txt . " .product-view .product-right .product-shop .product-sku span.h1, .product-view .sharing-links li, .product-view .add-to-cart-wrapper span.or{ font-size: " . $theme ['productdetails_sku_font_size'] . "px; font-family: '" . $theme ['fonts_productpage'] . "'; } ";
			//$txt = $txt . " .product-view .product-right .product-shop .product-sku span.h1, .product-view .sharing-links li, .product-view .add-to-cart-wrapper span.or{ font-family: '" . $theme ['fonts_productpage'] . "'; } ";
			$txt = $txt . " .product-view .product-right .product-shop .product-sku span.h1 { font-size: " . $theme ['productdetails_sku_font_size'] . "px; } ";
			//$txt = $txt . " .product-view .product-shop .short-description { font-family: '" . $theme ['fonts_productpage'] . "'; } ";
			$txt = $txt . " .product-view .make-apointment .inline_2, .product-view .make-apointment .inline_2:hover{ text-transform: " . $theme ['productdetails_Inquire_text_texttransform'] . "; font-style: " . $theme ['productdetails_Inquire_text_style'] . "; font-weight: " . $theme ['productdetails_Inquire_text_weight'] . "; font-size: " . $theme ['productdetails_Inquire_font_size'] . "px; background-color: " . $theme ['productdetails_Inquire_background_color'] . " !important; color: " . $theme ['productdetails_Inquire_color'] . " !important; } ";
		} else {
			$txt = $txt . " .product-view .product-right .product-shop .product-sku span.h1 { font-size: " . $theme ['productdetails_sku_font_size'] . "px; } ";
			$txt = $txt . " .product-view .make-apointment .inline_2, .product-view .make-apointment .inline_2:hover{ text-transform: " . $theme ['productdetails_Inquire_text_texttransform'] . "; font-style: " . $theme ['productdetails_Inquire_text_style'] . "; font-weight: " . $theme ['productdetails_Inquire_text_weight'] . "; font-size: " . $theme ['productdetails_Inquire_font_size'] . "px; background-color: " . $theme ['productdetails_Inquire_background_color'] . " !important; color: " . $theme ['productdetails_Inquire_color'] . " !important; } ";
		}
		
		$txt = $txt . " .catalog-product-view  .block-title-recent span, .catalog-product-view  #recently-viewed-items .product-name a{ font-size: " . $theme ['productdetails_recently_product_font_size'] . "px; } ";
		$txt = $txt . " .catalog-product-view  #recently-viewed-items .product-name a{ text-transform: " . $theme ['productdetails_recently_product_title_texttransform'] . "; font-style: " . $theme ['productdetails_recently_product_title_style'] . "; font-weight: " . $theme ['productdetails_recently_product_title_weight'] . "; } ";
		
		/* if ($theme ['fonts_productpage'] != "") {
			$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li > span, #collateral-tabs .tab-content .std, #collateral-tabs .tab-content .data-table th, #collateral-tabs .tab-content .data-table td, #collateral-tabs .data-table tbody td, #collateral-tabs .data-table tfoot td{ font-family: '" . $theme ['fonts_productpage'] . "'; } ";
		} */
		if ($theme ['fonts_productpage'] != "") {
			$txt = $txt . " .catalog-product-view #recently-viewed-items .product-name a { font-family: '" . $theme ['fonts_productpage'] . "'; } ";
		}
		$txt = $txt . " .catalog-product-view .product-collateral .toggle-tabs li > span, .catalog-product-view #product-attribute-specs-table tbody th, .catalog-product-view #product-attribute-specs-table tbody td{ font-size: " . $theme ['productdetails_attribute_fontsize'] . "px; } ";
		// echo $txt;
		// my account start
		if ($theme ['fonts_main'] != "") {
			$txt = $txt . " .main-container .main span, .main-container .main label, th, td,.customer-account .my-account address,.customer-account .my-account .dashboard .welcome-msg > p,.customer-account .block-content a,.customer-account .back-link > a,.dashboard .box-account p,.customer-account .dashboard .box-account address,.customer-account .addresses-additional .item.empty > p { font-family: " . $theme ['fonts_main'] . "; }";
			$txt = $txt . " .customer-account .main .block .block-title span { font-family: " . $theme ['fonts_main'] . "; font-size:" . $theme ['myaccount_sidebar_block_title_fontsize'] . "px; color:" . $theme ['myaccount_sidebar_block_title_color'] . "; }";
		} else {
			$txt = $txt . " .customer-account .main .block .block-title span { font-size:" . $theme ['myaccount_sidebar_block_title_fontsize'] . "px; color:" . $theme ['myaccount_sidebar_block_title_color'] . "; }";
		}
		
		$txt = $txt . " .customer-account .block.block-account { background: " . $theme ['myaccount_sidebar_block_background_color'] . "; }";
		$txt = $txt . " .customer-account .sidebar .block { border-top: 2px solid " . $theme ['myaccount_sidebar_block_topborder_color'] . "; }";
		$txt = $txt . " .customer-account .sidebar .block a { color: " . $theme ['myaccount_sidebar_block_link_color'] . "; }";
		$txt = $txt . " .customer-account .sidebar .block a:hover,.customer-account .gan-list-checkbox a:hover span { color: " . $theme ['myaccount_sidebar_block_linkhover_color'] . " !important; }";
		$txt = $txt . " .customer-account .sidebar .block a:hover{ background: " . $theme ['myaccount_sidebar_block_linkhover_background'] . "; }";
		$txt = $txt . " .customer-account .block-account li strong, .customer-account .block-cms-menu li strong { color: " . $theme ['myaccount_sidebar_block_activelink_color'] . "; }";
		$txt = $txt . " .customer-account .col-main h1 { color: " . $theme ['myaccount_rightsidebar_title_color'] . "; }";
		$txt = $txt . " .customer-account .col-main h2,.customer-account .col-main h3 { color: " . $theme ['myaccount_rightsidebar_subtitle_color'] . "; }";
		$txt = $txt . " .customer-account .col-main p,.customer-account .col-main address { color: " . $theme ['myaccount_rightsidebar_text_color'] . "; }";
		$txt = $txt . " .customer-account .main-container .col-main a { color: " . $theme ['myaccount_rightsidebar_link_color'] . "; }";
		$txt = $txt . " .customer-account .main-container .col-main button { background-color: " . $theme ['myaccount_rightsidebar_button_background_color'] . "; }";
		$txt = $txt . " .customer-account .main-container .col-main button span { color: " . $theme ['myaccount_rightsidebar_button_text_color'] . "; text-transform: " . $theme ['myaccount_rightsidebar_button_text_texttransform'] . "; font-style: " . $theme ['myaccount_rightsidebar_button_text_style'] . "; font-weight: " . $theme ['myaccount_rightsidebar_button_text_weight'] . "; }";
		if ($theme ['myaccount_rightsidebar_button_text_size']) {
			$txt = $txt . " .customer-account .main-container .col-main button span { font-size: " . $theme ['myaccount_rightsidebar_button_text_size'] . "px; } ";
		}
		// $txt = $txt." .customer-account .main-container .col-main .buttons-set .back-link a { color: ".$theme['myaccount_rightsidebar_button_text_color']."; background-color: ".$theme['myaccount_rightsidebar_button_background_color']."; }";
		// my account end
		// start cart page button background image
		if ($theme ['button_background_image']) {
			$txt = $txt . " .product-view .make-apointment .inline_2, .product-view .make-apointment .inline_2:hover{  background-image: url('" . $baseurl . $theme ['button_background_image'] . "') !important; }";
		}
		if ($theme ['button_addto_background_image']) {
			$txt = $txt . " .catalog-product-view .add-to-cart .button.btn-cart{  background-image: url('" . $baseurl . $theme ['button_addto_background_image'] . "'); }";
		}
		if ($theme ['shoppingcart_update_cart_button_background_image']) {
			$txt = $txt . " .checkout-cart-index .button2.btn-update{  background-image: url('" . $baseurl . $theme ['shoppingcart_update_cart_button_background_image'] . "'); }";
		}
		if ($theme ['shoppingcart_continue_shopping_cart_button_background_image']) {
			$txt = $txt . " .checkout-cart-index .button2.btn-continue{  background-image: url('" . $baseurl . $theme ['shoppingcart_continue_shopping_cart_button_background_image'] . "') ; }";
		}
		if ($theme ['shoppingcart_empty_cart_button_background_image']) {
			$txt = $txt . " .checkout-cart-index .button2.btn-empty{  background-image: url('" . $baseurl . $theme ['shoppingcart_empty_cart_button_background_image'] . "') ; }";
		}
		if ($theme ['shoppingcart_processed_to_checkout_cart_button_background_image']) {
			$txt = $txt . " .checkout-cart-index .button.btn-proceed-checkout{  background-image: url('" . $baseurl . $theme ['shoppingcart_processed_to_checkout_cart_button_background_image'] . "') ; }";
		}
		if ($theme ['shoppingcart_discount_cart_button_background_image']) {
			$txt = $txt . " .checkout-cart-index #discount-coupon-form .button-wrapper .button2 {  background-image: url('" . $baseurl . $theme ['shoppingcart_discount_cart_button_background_image'] . "') ; }";
		}
		if ($theme ['shoppingcart_estimate_tax_button_background_image']) {
			$txt = $txt . " .checkout-cart-index #shipping-zip-form .buttons-set .button2 {  background-image: url('" . $baseurl . $theme ['shoppingcart_estimate_tax_button_background_image'] . "') ; }";
		}
		if ($theme ['shoppingcart_estimate_tax_Update_total_button_background_image']) {
			$txt = $txt . " .checkout-cart-index #co-shipping-method-form .buttons-set .button {  background-image: url('" . $baseurl . $theme ['shoppingcart_estimate_tax_Update_total_button_background_image'] . "') ; }";
		}
		// end cart page button background image
		
		// start checkout cart page
		if ($theme ['fonts_main'] != "") {
			$txt = $txt . " .checkout-onepage-index .block-progress .block-title span, .checkout-onepage-index .block-progress dt, .checkout-onepage-index .block-progress dd, .checkout-onepage-index h2.product-name, .checkout-onepage-index h3.product-name, .checkout-onepage-index h4.product-name, .checkout-onepage-index h5.product-name, .checkout-onepage-index p.product-name, .checkout-onepage-index .data-table tbody td, .checkout-onepage-index .data-table tfoot td { font-family: '" . $theme ['fonts_main'] . "' }";
		}
		if ($theme ['shopping_discount_label_font'] != "") {
			$txt = $txt . " #discount-coupon-form label { font-size:" . $theme ['shopping_discount_label_size'] . "px; color:" . $theme ['shopping_discount_label_color'] . "; font-family: " . $theme ['shopping_discount_label_font'] . "; }";
		} else {
			$txt = $txt . " #discount-coupon-form label { font-size:" . $theme ['shopping_discount_label_size'] . "px; color:" . $theme ['shopping_discount_label_color'] . "; }";
		}
		
		if ($theme ['shopping_cart_table_title_font'] != "") {
			$txt = $txt . " #shopping-cart-table thead th,#shopping-cart-table thead th span { font-size:" . $theme ['shopping_cart_table_title_size'] . "px; color:" . $theme ['shopping_cart_table_title_color'] . "; font-family: " . $theme ['shopping_cart_table_title_font'] . "; }";
		} else {
			$txt = $txt . " #shopping-cart-table thead th,#shopping-cart-table thead th span { font-size:" . $theme ['shopping_cart_table_title_size'] . "px; color:" . $theme ['shopping_cart_table_title_color'] . "; }";
		}
		if ($theme ['shopping_cart_page_title_font'] != "") {
			$txt = $txt . " .cart .page-title h1 { font-size:" . $theme ['shopping_cart_page_title_size'] . "px; color:" . $theme ['shopping_cart_page_title_color'] . "; font-family: " . $theme ['shopping_cart_page_title_font'] . "; }";
		} else {
			$txt = $txt . " .cart .page-title h1 { font-size:" . $theme ['shopping_cart_page_title_size'] . "px; color:" . $theme ['shopping_cart_page_title_color'] . "; }";
		}
		
		// end checkout cart page
		
		// start one step check out
		$txt = $txt . ".checkout-onepage-index .page-title h1 { color:" . $theme ['checkout_page_title_color'] . "; }";
		$txt = $txt . ".checkout-onepage-index .opc .section .step-title,.checkout-onepage-index .opc .section:hover .step-title  { background-color:" . $theme ['checkout_step_title_background_color'] . "; }";
		
		if ($theme ['checkout_step_title_font'] != "") {
			$txt = $txt . ".checkout-onepage-index .opc .section .step-title h2,.checkout-onepage-index .opc .section:hover .step-title h2 { text-transform: " . $theme ['checkout_step_title_texttransform'] . "; font-style: " . $theme ['checkout_step_title_style'] . "; font-weight: " . $theme ['checkout_step_title_weight'] . "; color:" . $theme ['checkout_step_title_color'] . "; font-size: " . $theme ['checkout_step_title_size'] . "px; font-family:" . $theme ['checkout_step_title_font'] . "; }";
		} else {
			$txt = $txt . ".checkout-onepage-index .opc .section .step-title h2,.checkout-onepage-index .opc .section:hover .step-title h2 { text-transform: " . $theme ['checkout_step_title_texttransform'] . "; font-style: " . $theme ['checkout_step_title_style'] . "; font-weight: " . $theme ['checkout_step_title_weight'] . "; color:" . $theme ['checkout_step_title_color'] . "; font-size: " . $theme ['checkout_step_title_size'] . "px; }";
		}
		
		$txt = $txt . ".checkout-onepage-index .opc .section.active .step-title,.checkout-onepage-index .opc .section.active:hover .step-title  { background-color:" . $theme ['checkout_step_title_active_background_color'] . "; }";
		$txt = $txt . ".checkout-onepage-index .opc .section.active .step-title h2,.checkout-onepage-index .opc .section.active:hover .step-title h2 { color:" . $theme ['checkout_step_title_active_color'] . "; }";
		
		if ($theme ['checkout_step_title_font'] != "") {
			$txt = $txt . ".checkout-onepage-index .opc .section .step-title .number, .checkout-onepage-index .opc .section:hover .step-title .number{ background-color:" . $theme ['checkout_step_number_background_color'] . " !important; color:" . $theme ['checkout_step_number_color'] . " !important; font-size: " . $theme ['checkout_step_number_size'] . "px; font-family:" . $theme ['checkout_step_title_font'] . "; }";
		} else {
			$txt = $txt . ".checkout-onepage-index .opc .section .step-title .number, .checkout-onepage-index .opc .section:hover .step-title .number{ background-color:" . $theme ['checkout_step_number_background_color'] . " !important; color:" . $theme ['checkout_step_number_color'] . " !important; font-size: " . $theme ['checkout_step_number_size'] . "px; }";
		}
		
		$txt = $txt . ".checkout-onepage-index .opc .section.active .step-title .number, .checkout-onepage-index .opc .section.active:hover .step-title .number{ background-color:" . $theme ['checkout_step_number_active_background'] . " !important; color:" . $theme ['checkout_step_number_active_color'] . " !important; }";
		
		$txt = $txt . ".checkout-onepage-index .opc .section.allow:not(.active) .step-title a{ color:" . $theme ['checkout_edit_color'] . "; }";
		$txt = $txt . ".checkout-onepage-index .opc .buttons-set button.button, .checkout-onepage-index #checkoutSteps.opc .buttons-set button.button { background-color:" . $theme ['checkout_button_background'] . "; }";
		$txt = $txt . ".checkout-onepage-index .opc .buttons-set button.button span span, .checkout-onepage-index #checkoutSteps.opc .buttons-set button.button span span { text-transform: " . $theme ['checkout_button_text_texttransform'] . "; font-style: " . $theme ['checkout_button_text_style'] . "; font-weight: " . $theme ['checkout_button_text_weight'] . "; color:" . $theme ['checkout_button_text_color'] . " !important; }";
		$txt = $txt . ".checkout-onepage-index .opc .buttons-set button.button:hover, .checkout-onepage-index #checkoutSteps.opc .buttons-set button.button:hover { background-color:" . $theme ['checkout_button_hover_background'] . "; }";
		$txt = $txt . ".checkout-onepage-index .opc .buttons-set button.button:hover span span, .checkout-onepage-index #checkoutSteps.opc .buttons-set button.button:hover span span { color:" . $theme ['checkout_button_hover_text_color'] . " !important; }";
		
		// end checkout cart page
		
		// start multishipping checkout
		$txt = $txt . ".multiple-checkout button.button{ background-color:" . $theme ['checkout_button_background'] . "; }";
		$txt = $txt . ".multiple-checkout button.button span span{ text-transform: " . $theme ['checkout_button_text_texttransform'] . "; font-style: " . $theme ['checkout_button_text_style'] . "; font-weight: " . $theme ['checkout_button_text_weight'] . "; color:" . $theme ['checkout_button_text_color'] . " !important; }";
		$txt = $txt . ".multiple-checkout button.button:hover{ background-color:" . $theme ['checkout_button_hover_background'] . "; }";
		$txt = $txt . ".multiple-checkout button.button:hover span span{ color:" . $theme ['checkout_button_hover_text_color'] . " !important; }";
		
		if ($theme ['checkout_button_text_size']) {
			$txt = $txt . ".checkout-onepage-index .opc .buttons-set button.button span span, .multiple-checkout button.button span span { font-size: " . $theme ['checkout_button_text_size'] . "px; }";
		}
		
		// end multishipping checkout
		// start textrow marker
		for($textrowcss = 1; $textrowcss <= 11; $textrowcss ++) {
			$txt = $txt . " .homepage_element_" . $textrowcss . "_textrow { background-color: " . $theme ['homepage_element_' . $textrowcss . '_textrow_style_background_color'] . " } ";
			$textrowmarkercheckbox = unserialize ( $theme ['homepage_element_' . $textrowcss . '_textrow_style_marker_checkbox'] );
			if ($theme ['homepage_element_' . $textrowcss . '_textrow_style_marker_image']) {
				if ($theme ['homepage_element_' . $textrowcss . '_textrow_style_marker_image']) {
					$txt = $txt . " #homepage_element_" . $textrowcss . "_textrow {";
					$txt = $txt . "  background-image: ";
					$textrow1 = 1;
					foreach ( $textrowmarkercheckbox as $textrowmarkercheckbox1 ) {
						if ($textrow1 == sizeof ( $textrowmarkercheckbox1 )) {
							$txt = $txt . " url('" . $baseurl . $theme ['homepage_element_' . $textrowcss . '_textrow_style_marker_image'] . "'), ";
						} else {
							$txt = $txt . " url('" . $baseurl . $theme ['homepage_element_' . $textrowcss . '_textrow_style_marker_image'] . "') ";
						}
						$textrow1 ++;
					}
					$txt = $txt . "; ";
					$textrow1 = 1;
					$txt = $txt . "  background-position: ";
					foreach ( $textrowmarkercheckbox as $textrowmarkercheckbox1 ) {
						if ($textrow1 == sizeof ( $textrowmarkercheckbox1 )) {
							if ($textrowmarkercheckbox1 == "left") {
								$textrowmarkercheckbox1 = "3%";
							} elseif ($textrowmarkercheckbox1 == "right") {
								$textrowmarkercheckbox1 = "97%";
							}
							$txt = $txt . $textrowmarkercheckbox1 . " center, ";
						} else {
							if ($textrowmarkercheckbox1 == "left") {
								$textrowmarkercheckbox1 = "3%";
							} elseif ($textrowmarkercheckbox1 == "right") {
								$textrowmarkercheckbox1 = "97%";
							}
							$txt = $txt . $textrowmarkercheckbox1 . " center ";
						}
						$textrow1 ++;
					}
					$txt = $txt . "; ";
					$txt = $txt . "  background-repeat: no-repeat; ";
					$txt = $txt . " }";
				}
			}
		}
		
		// end textrow marker
		// start loos diamond
		
		for($loosdiamondcss = 1; $loosdiamondcss <= 11; $loosdiamondcss ++) {		
			if($theme ['homepage_element_".$loosdiamondcss."_diamondrow_style_background_image'])
			{
				$loosbackimg = $baseurl . $theme ['homepage_element_".$loosdiamondcss."_diamondrow_style_background_image'];
			}
			$txt = $txt . " .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds {    background: url('" . $loosbackimg . "') repeat scroll 0px " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_background_color'] . "; }";
			if ($theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font'] != "") {
				$txt = $txt . " .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape  a, .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape a span {  color: " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font_color'] . "; font-family: '" . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font'] . "'; }";
				$txt = $txt . " .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape  p, .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape .titlediamond h2 span {  color: " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font_color'] . "; font-family: '" . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font'] . "'; }";
			} else {
				$txt = $txt . " .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape  a, .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape a span  {  color: " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font_color'] . "; }";
				$txt = $txt . " .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape  p, .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds .imageshape .titlediamond h2 span {  color: " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_font_color'] . "; }";
			}
			$txt = $txt . " .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds input[type='button'], .home-info.homepage_element_" . $loosdiamondcss . "_loosediamonds.homepage_loosediamonds input[type='submit'] {  color: " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_button_color'] . "; background-color: " . $theme ['homepage_element_' . $loosdiamondcss . '_diamondrow_style_button_backgroundcolor'] . "; }";
		}
		
		// end loos diamond row
		/**
		 * ******************* Start tesimonial ***********************
		 */
		if ($theme ['testimonials_review_border_color']) {
			$txt = $txt . " .customer-testimonials-content {     border-bottom: 1px solid " . $theme ['testimonials_review_border_color'] . "; }";
		}
		$txt = $txt . " .testimonial-source { color: " . $theme ['testimonials_namelocation_reviewer_text_color'] . "; }";
		/**
		 * ******************* End tesimonial *************************
		 */
		
		/**
		 * ******************* Start FooterBar ************************
		 */
		if ($theme ['footer_footerbar_background']) {
			$txt = $txt . " .footerbar { background-color: " . $theme ['footer_footerbar_background'] . "; }";
		}
		if ($theme ['footer_footerbar_text']) {
			$txt = $txt . " .footerbar .footerbar-container .html_only, .footerbar .footerbar-container .subscribe_and_social_media .center, .footerbar .footerbar-container .subscribe_and_social_media .center div,.footerbar .footerbar-container .subscribe_and_social_media .center p, .footerbar .footerbar-container .subscribe_only .left, .footerbar .footerbar-container .subscribe_only .left div,.footerbar .footerbar-container .subscribe_only .left p { color: " . $theme ['footer_footerbar_text'] . "; }";
		}
		if (($theme ['footer_footerbar_paddingtopbottom']) || ($theme ['footer_footerbar_paddingtopbottom'] == 0)) {
			$txt = $txt . " .footerbar .footerbar-container { padding: " . $theme ['footer_footerbar_paddingtopbottom'] . "px 10px; }";
		}
		/**
		 * ******************* End FooterBar **************************
		 */
		
		/**
		 * ******************** Start Designer ***********************
		 */
		if ($theme ['evolved_designer_style_border']) {
			if ($theme ['evolved_designer_style_border_color']) {
				$txt = $txt . " .designer ul li { border-bottom: 1px solid " . $theme ['evolved_designer_style_border_color'] . "; border-right: 1px solid " . $theme ['evolved_designer_style_border_color'] . ";  }";
				$txt = $txt . " .designer.square ul li, .designer.square ul li:nth-child(4n) { border: 1px solid " . $theme ['evolved_designer_style_border_color'] . "; }";
				$txt = $txt . " @media screen and (max-width: 770px){ ";
				$txt = $txt . ".cms-designer .designer.square ul li { border-right:1px solid " . $theme ['evolved_designer_style_border_color'] . "; }";
				$txt = $txt . " }";
			} else {
				$txt = $txt . " .designer ul li { border: none; }";
				$txt = $txt . " .designer.square ul li { border: none; }";
			}
		}
		if ($theme ['evolved_designer_style_hover']) {
			if ($theme ['evolved_designer_style_border_hover_color']) {
				$txt = $txt . " .designer ul li:hover { box-shadow: 1px 1px 1px 3px " . $theme ['evolved_designer_style_border_hover_color'] . "; }";
			} else {
				$txt = $txt . " .designer ul li:hover { box-shadow:none; }";
			}
		}
		
		/**
		 * ******************** End Designer *************************
		 */
		
		/**
		 * ******************** Start near by slider banner **********
		 */
		for($elementsslider = 1; $elementsslider <= 11; $elementsslider ++) {
			if ($theme ['homepage_element_' . $elementsslider . '_slideshow_banner_style_nearby_width']) {
				$txt = $txt . " @media only screen and (min-width: " . $theme ['homepage_element_' . $elementsslider . '_slideshow_banner_style_nearby_width'] . "px){ ";
				$txt = $txt . " .slider--home-main.royalSlider { width:" . $theme ['homepage_element_' . $elementsslider . '_slideshow_banner_style_nearby_width'] . "px !important;  }";
				$txt = $txt . " .max-width-min { max-width:" . $theme ['homepage_element_' . $elementsslider . '_slideshow_banner_style_nearby_width'] . "px !important;  }";
				/*
				 * if($theme['homepage_element_'.$elementsslider.'_slideshow_banner_style_nearby_height'])
				 * {
				 * $txt = $txt." #mainHomeSlider, .rsVisibleNearbyWrap, .rsVisibleNearbyWrap, .rsOverflow { height: ".$theme['homepage_element_'.$elementsslider.'_slideshow_banner_style_nearby_height']."px !important; }";
				 * }
				 */
				$txt = $txt . " } ";
			}
		}
		//echo $txt; exit;
		/**
		 * ******************** End near by slider banner ************
		 */
		
		$myfile = fopen ( "skin/frontend/evolved/default/css/evolved.css", "w" ) or die ( "Unable to open file!" );
		fwrite ( $myfile, $txt );
		fclose ( $myfile );
		Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Created Generate css File ' ) );
		Mage::app ()->getResponse ()->setRedirect ( $_SERVER ['HTTP_REFERER'] )->sendResponse ();
		exit ();
		// $this->_redirect('*/*/settings');
	}
	public function editAction() {
		$id = $this->getRequest ()->getParam ( 'id' );
		$model = Mage::getModel ( 'evolved/evolved' )->load ( $id );
		
		if ($model->getId () || $id == 0) {
			$data = Mage::getSingleton ( 'adminhtml/session' )->getFormData ( true );
			if (! empty ( $data )) {
				$model->setData ( $data );
			}
			
			$collection = $model->getCollection ();
			$formData = array ();
			// echo "<pre>";
			// print_r($collection->getData());
			// exit;
			foreach ( $collection as $row ) {
				$field = $row ['field'];
				$value = $row ['value'];
				$formData [$field] = $value;
			}
			/*
			 * echo "<pre>";
			 * print_r($formData);
			 * exit;
			 */
			// echo $formData['productdetails_social_enable'];
			$productdetailssocialenable = unserialize ( $formData ['productdetails_social_enable'] );
			$formData ['productdetails_social_enable'] = $productdetailssocialenable;
			// echo "<pre>"; print_r($sdata); exit;
			if ($formData ['top_links_option']) {
				$toplinkoption = explode ( "|", $formData ['top_links_option'] );
				$formData ['top_links_option'] = $toplinkoption;
				 //echo $formData['top_links_option'];
				 //exit;
			}
			
			if ($formData ['social_links_option']) {
				$sociallinksoption = explode ( "|", $formData ['social_links_option'] );
				$formData ['social_links_option'] = $sociallinksoption;
				//echo "<pre>"; print_r($headersocialoption);
				 //echo $formData['header_social_option'];
				 //exit;
			}
			if ($formData ['captcha_form_option']) {
				$captchaformoption = explode ( "|", $formData ['captcha_form_option'] );
				$formData ['captcha_form_option'] = $captchaformoption;
				//echo "<pre>"; print_r($headersocialoption);
				 //echo $formData['captcha_form_option'];
				 //exit;
			}
			if ($formData ['account_menu_sidebar']) {
				$accountmenusidebar = explode ( "|", $formData ['account_menu_sidebar'] );
				$formData ['account_menu_sidebar'] = $accountmenusidebar;
				//echo "<pre>"; print_r($headersocialoption);
				 //echo $formData['captcha_form_option'];
				 //exit;
			}
			
			if ($formData ['appointment_category']) {
				$toplinkoption = explode ( "|", $formData ['appointment_category'] );
				$formData ['appointment_category'] = $toplinkoption;
			}
			$formData ['general_store_information_name'] = Mage::getStoreConfig ( 'general/store_information/name' );
			$formData ['general_store_information_phone'] = Mage::getStoreConfig ( 'general/store_information/phone' );
			$formData ['general_store_information_address'] = Mage::getStoreConfig ( 'general/store_information/address' );
			// $formData['trans_email_ident_general_name'] = Mage::getStoreConfig('trans_email/ident_general/name');
			$formData ['trans_email_ident_general_email'] = Mage::getStoreConfig ( 'trans_email/ident_general/email' );
			// $formData['top_links_option'] = array("checkout/","wishlist/");
			$formData ['general_miscellaneous_head_scripts'] = Mage::getStoreConfig ( 'design/head/includes' );
			$formData ['general_miscellaneous_footer_html'] = Mage::getStoreConfig ( 'design/footer/absolute_footer' );
			Mage::register ( 'evolved_data', $formData );
			
			$this->loadLayout ();
			$this->_setActiveMenu ( 'evolved/settings' );
			
			$this->_addBreadcrumb ( Mage::helper ( 'adminhtml' )->__ ( 'Theme Options' ), Mage::helper ( 'adminhtml' )->__ ( 'Theme Options' ) );
			// $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
			
			$this->getLayout ()->getBlock ( 'head' )->setCanLoadTinyMce ( true );
			$this->getLayout ()->getBlock ( 'head' )->setCanLoadExtJs ( true );
			
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'mage/adminhtml/variables.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'mage/adminhtml/wysiwyg/widget.js' );
			//$this->getLayout ()->getBlock ( 'head' )->addJs ( 'lib/flex.js' );
			//$this->getLayout ()->getBlock ( 'head' )->addJs ( 'lib/FABridge.js' );
			//$this->getLayout ()->getBlock ( 'head' )->addJs ( 'mage/adminhtml/flexuploader.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'lib/uploader/flow.min.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'lib/uploader/fusty-flow.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'lib/uploader/fusty-flow-factory.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'mage/adminhtml/uploader/instance.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'mage/adminhtml/browser.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'prototype/window.js' );
			$this->getLayout ()->getBlock ( 'head' )->addJs ( 'prototype/windows/themes/default.css' );
			$this->getLayout ()->getBlock ( 'head' )->addCSS ( 'lib/prototype/windows/themes/magento.css' );
			
			// $this->getLayout()->getBlock('head')->addCSS('evolved/evolvedadmin.css');
			// $this->getLayout()->getBlock('head')->addCSS('evolved/colorScroll/jquery-ui.css');
			// $this->getLayout()->getBlock('head')->addJs('evolved/colorScroll/jquery-ui.js');
			
			// $this->getLayout()->getBlock('evolved_css')->addJs('evolved/jquery-1.8.3.min.js');
			// $this->getLayout()->getBlock('evolved_css')->addJs('evolved/jquery.noconflict.js');
			// $this->getLayout()->getBlock('evolved_css')->addJs('evolved/jquery.mColorPicker.min.js');
			// $this->getLayout()->getBlock('evolved_css')->addJs('evolved/evolved_setting.js');
			
			$this->_addContent ( $this->getLayout ()->createBlock ( 'evolved/adminhtml_evolved_edit' ) )->_addLeft ( $this->getLayout ()->createBlock ( 'evolved/adminhtml_evolved_edit_tabs' ) );
			
			$this->getLayout ()->getBlock ( 'head' )->setTitle ( $this->__ ( 'Evolved Settings' ) );
			
			$this->renderLayout ();
		} else {
			Mage::getSingleton ( 'adminhtml/session' )->addError ( Mage::helper ( 'evolved' )->__ ( 'Item does not exist' ) );
			$this->_redirect ( '*/*/' );
		}
	}
	public function newAction() {
		$this->_forward ( 'edit' );
	} 
	public function settingsAction() {		
		$this->_forward ( 'edit' );				
	}
	public function saveAction() {
		//echo $this->getRequest ()->getPost ( 'evolved_form_newsletter' )['config']['newsletter_popup_enable'];
		//echo "<pre>"; print_r($this->getRequest ()->getPost ()); exit;
		if (strpos ( $_SERVER ['HTTP_REFERER'], '/block/' ) !== false) {
			$explodeblock = explode ( '/block/', $_SERVER ['HTTP_REFERER'] );
			$explodeblocktype = explode ( '/', $explodeblock [1] );
			// echo $explodeblocktype[0]."<br />";
			// echo $_SERVER['HTTP_REFERER']; exit;
			if ($evolveddata = $this->getRequest ()->getPost ()) {
				
				$evolveddata = $this->getRequest ()->getPost ();
				$evolveddatatype = array();
				$configdata = array();
				foreach($evolveddata as $evolveddatakey => $evolveddatavalue)
				{
					foreach($evolveddatavalue as $datakey => $datavalue)
					{
						if($datakey == 'config')
						{
							foreach($datavalue as $datavaluekey => $datavaluevalue)
							{
								$evolveddatatype[$datavaluekey] = $evolveddatakey;
								$configdata[$datavaluekey] = $datavaluevalue;
								
								$data['config'][$datavaluekey] = $datavaluevalue;
							}
						} else {
							$evolveddatatype[$datakey] = $evolveddatakey;
							$data[$datakey] = $datavalue;
						}						
						
					}
				}
				//echo "<pre>"; print_r($data); exit;
				//$blockname = Mage::getSingleton('core/session')->getBlockName();
				$blockname = $explodeblocktype [0];
				$config = new Mage_Core_Model_Config ();
				$config->saveConfig ( 'evolved/breadcrumbs/enable', $data ['breadcrumbs_enable_option'], 'default', 0 );
				$config->saveConfig ( 'evolved/productlist_leftsidebar/enable', $data ['productlist_sidebar_enable'], 'default', 0 );
				$config->saveConfig ( 'evolved/contacts_custom_captcha/enable', $data ['contacts_custom_captcha'], 'default', 0 );
				
				if ($data ['termsandcondition_hidden'] == "1") {
					$termscollectionmodel = Mage::getModel ( 'evolved/evolved' );
					$termscollection = $termscollectionmodel->getCollection ();
					$termscollection->addFieldToFilter ( 'field', array (
							'like' => 'termsandcondition_form_%' 
					) );
					// echo "<pre>";
					foreach ( $termscollection as $termscollection_arr ) {
						// print_r($termscollection_arr->getData('evolved_id'));
						try {
							Mage::getModel ( 'evolved/evolved' )->load ( $termscollection_arr->getData ( 'evolved_id' ) )->delete ();
						} catch ( Exception $e ) {
							echo "Delete failed";
						}
					}
				}
				$data ['header_dropdown_toplink_option'] = "simple";
				// echo $data['aboutus_element_style_four_upload_banner']; exit;
				
				if ($blockname == "evolved_homepage") {
					
					for($elements = 1; $elements <= 11; $elements ++) {
						
						$data ['homepage_element_'.$elements.'_textrow_style_marker_checkbox'] = serialize ( $data ['homepage_element_'.$elements.'_textrow_style_marker_checkbox'] );
						
						if ($data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_row_count']) {
							for($shapeconut = 1; $shapeconut <= $data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_row_count']; $shapeconut ++) {
								if (isset ( $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] ) && $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] != '') {
									try {
										// $uploader = new Varien_File_Uploader ( 'homepage_element_'.$elementcount.'_show_textrow[homepage_element_'.$elementcount.'_textrow_style_marker_image]' );
										$uploader = new Varien_File_Uploader ( array (
												'name' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'],
												'type' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['type'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'],
												'tmp_name' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['tmp_name'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'],
												'error' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['error'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'],
												'size' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['size'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] 
										) );
										// Any extention would work
										$uploader->setAllowedExtensions ( array (
												'jpg',
												'jpeg',
												'gif',
												'png' 
										) );
										$uploader->setAllowRenameFiles ( false );
										// Set the file upload mode
										// false -> get the file directly in the specified folder
										// true -> get the file in the product like folders
										// (file.jpg will go in something like /media/f/i/file.jpg)
										$uploader->setFilesDispersion ( false );
										// We set media as the upload dir
										$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
										if (! is_dir ( $path )) {
											mkdir ( $path );
										}
										$uploader->save ( $path, $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] );
									} catch ( Exception $e ) {
									}
									// this way the name is saved in DB
									$data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] = "evolved/" . $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'];
								} else {
									if ($data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] ['delete'] == 1) {
										$data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] = "";
									} else {
										$data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] = $data ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] ['value'];
									}
								}
								$evolveddatatype ['homepage_element_' . $elements . '_diamondrow_dynamic_shape_table_image_row' . $shapeconut . '_image'] = 'homepage_element_' . $elements . '_show_diamondrow';
							}
						}
						
						if (isset ( $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'] ) && $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'] != '') {
							try {
						
								// $uploader = new Varien_File_Uploader ( 'homepage_element_'.$elements.'_show_diamondrow[homepage_element_'.$elements.'_diamondrow_style_background_image]' );
						
								$uploader = new Varien_File_Uploader ( array (
										'name' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'],
										'type' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['type'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'],
										'tmp_name' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['tmp_name'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'],
										'error' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['error'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'],
										'size' => $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['size'] ['homepage_element_' . $elements . '_diamondrow_style_background_image']
								) );
						
								// Any extention would work
								$uploader->setAllowedExtensions ( array (
										'jpg',
										'jpeg',
										'gif',
										'png'
								) );
								$uploader->setAllowRenameFiles ( false );
						
								// Set the file upload mode
								// false -> get the file directly in the specified folder
								// true -> get the file in the product like folders
								// (file.jpg will go in something like /media/f/i/file.jpg)
								$uploader->setFilesDispersion ( false );
						
								// We set media as the upload dir
								$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
								if (! is_dir ( $path )) {
									mkdir ( $path );
								}
								$uploader->save ( $path, $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'] );
							} catch ( Exception $e ) {
							}
							// this way the name is saved in DB
							$data ['homepage_element_' . $elements . '_diamondrow_style_background_image'] = "evolved/" . $_FILES ['homepage_element_' . $elements . '_show_diamondrow'] ['name'] ['homepage_element_' . $elements . '_diamondrow_style_background_image'];
						} else {
							if ($data ['homepage_element_' . $elements . '_diamondrow_style_background_image'] ['delete'] == 1) {
								$data ['homepage_element_' . $elements . '_diamondrow_style_background_image'] = "";
							} else {
								$data ['homepage_element_' . $elements . '_diamondrow_style_background_image'] = $data ['homepage_element_' . $elements . '_diamondrow_style_background_image'] ['value'];
							}
						}
						$evolveddatatype ['homepage_element_' . $elements . '_diamondrow_style_background_image'] = 'homepage_element_' . $elements . '_show_diamondrow';
						
						if (isset ( $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['name'] ['homepage_element_' . $elements . '_textrow_style_marker_image'] ) && $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['name'] ['homepage_element_' . $elements . '_textrow_style_marker_image'] != '') {
							try {
						
								// $uploader = new Varien_File_Uploader ( 'homepage_element_'.$elements.'_show_textrow[homepage_element_'.$elements.'_textrow_style_marker_image]' );
						
								$uploader = new Varien_File_Uploader ( array (
										'name' => $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['name'] ['homepage_element_' . $elements . '_textrow_style_marker_image'],
										'type' => $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['type'] ['homepage_element_' . $elements . '_textrow_style_marker_image'],
										'tmp_name' => $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['tmp_name'] ['homepage_element_' . $elements . '_textrow_style_marker_image'],
										'error' => $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['error'] ['homepage_element_' . $elements . '_textrow_style_marker_image'],
										'size' => $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['size'] ['homepage_element_' . $elements . '_textrow_style_marker_image']
								) );
						
								// Any extention would work
								$uploader->setAllowedExtensions ( array (
										'jpg',
										'jpeg',
										'gif',
										'png'
								) );
								$uploader->setAllowRenameFiles ( false );
						
								// Set the file upload mode
								// false -> get the file directly in the specified folder
								// true -> get the file in the product like folders
								// (file.jpg will go in something like /media/f/i/file.jpg)
								$uploader->setFilesDispersion ( false );
						
								// We set media as the upload dir
								$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
								if (! is_dir ( $path )) {
									mkdir ( $path );
								}
								$uploader->save ( $path, $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['name'] ['homepage_element_' . $elements . '_textrow_style_marker_image'] );
							} catch ( Exception $e ) {
							}
							// this way the name is saved in DB
							$data ['homepage_element_' . $elements . '_textrow_style_marker_image'] = "evolved/" . $_FILES ['homepage_element_' . $elements . '_show_textrow'] ['name'] ['homepage_element_' . $elements . '_textrow_style_marker_image'];
						} else {
							if ($data ['homepage_element_' . $elements . '_textrow_style_marker_image'] ['delete'] == 1) {
								$data ['homepage_element_' . $elements . '_textrow_style_marker_image'] = "";
							} else {
								$data ['homepage_element_' . $elements . '_textrow_style_marker_image'] = $data ['homepage_element_' . $elements . '_textrow_style_marker_image'] ['value'];
							}
						}
						$evolveddatatype ['homepage_element_' . $elements . '_textrow_style_marker_image'] = 'homepage_element_' . $elements . '_show_textrow';
					}
				}

				if ($blockname == 'evolved_myaccountlogin')
				{
					if (isset ( $_FILES ['evolved_form_login'] ['name'] ['login_background_image'] ) && $_FILES ['evolved_form_login'] ['name'] ['login_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_login'] ['name'] ['login_background_image'],
									'type' => $_FILES ['evolved_form_login'] ['type'] ['login_background_image'],
									'tmp_name' => $_FILES ['evolved_form_login'] ['tmp_name'] ['login_background_image'],
									'error' => $_FILES ['evolved_form_login'] ['error'] ['login_background_image'],
									'size' => $_FILES ['evolved_form_login'] ['size'] ['login_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );   
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_login'] ['name'] ['login_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['login_background_image'] = "evolved/" . $_FILES ['evolved_form_login'] ['name'] ['login_background_image'];
					} else {
						if ($data ['login_background_image'] ['delete'] == 1) {
							$data ['login_background_image'] = "";
						} else {
							$data ['login_background_image'] = $data ['login_background_image'] ['value'];
						} 
					}
					$evolveddatatype ['login_background_image'] = 'evolved_form_login';
				}
				// echo "<pre>";
				
			//echo "<pre>"; print_r($data); print_r($evolveddatatype); exit;	
				if ($blockname == "evolved_comingsoon")
				{
					if (isset ( $_FILES ['evolved_form_commingsoon'] ['name'] ['commingsoon_image'] ) && $_FILES ['evolved_form_commingsoon'] ['name'] ['commingsoon_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_commingsoon'] ['name'] ['commingsoon_image'],
									'type' => $_FILES ['evolved_form_commingsoon'] ['type'] ['commingsoon_image'],
									'tmp_name' => $_FILES ['evolved_form_commingsoon'] ['tmp_name'] ['commingsoon_image'],
									'error' => $_FILES ['evolved_form_commingsoon'] ['error'] ['commingsoon_image'],
									'size' => $_FILES ['evolved_form_commingsoon'] ['size'] ['commingsoon_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_commingsoon'] ['name'] ['commingsoon_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['commingsoon_image'] = "evolved/" . $_FILES ['evolved_form_commingsoon'] ['name'] ['commingsoon_image'];
					} else {
						if ($data ['commingsoon_image'] ['delete'] == 1) {
							$data ['commingsoon_image'] = "";
						} else {
							$data ['commingsoon_image'] = $data ['commingsoon_image'] ['value'];
						}
					}
					$evolveddatatype ['commingsoon_image'] = 'evolved_form_commingsoon';					
				}

				if ($blockname == "evolved_testimonials")
				{
					if (isset ( $_FILES ['evolved_homepage_testimonials'] ['name'] ['testimonials_page_upload_banner'] ) && $_FILES ['evolved_homepage_testimonials'] ['name'] ['testimonials_page_upload_banner'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_homepage_testimonials'] ['name'] ['testimonials_page_upload_banner'],
									'type' => $_FILES ['evolved_homepage_testimonials'] ['type'] ['testimonials_page_upload_banner'],
									'tmp_name' => $_FILES ['evolved_homepage_testimonials'] ['tmp_name'] ['testimonials_page_upload_banner'],
									'error' => $_FILES ['evolved_homepage_testimonials'] ['error'] ['testimonials_page_upload_banner'],
									'size' => $_FILES ['evolved_homepage_testimonials'] ['size'] ['testimonials_page_upload_banner']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_homepage_testimonials'] ['name'] ['testimonials_page_upload_banner'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['testimonials_page_upload_banner'] = "evolved/" . $_FILES ['evolved_homepage_testimonials'] ['name'] ['testimonials_page_upload_banner'];
					} else {
						if ($data ['testimonials_page_upload_banner'] ['delete'] == 1) {
							$data ['testimonials_page_upload_banner'] = "";
						} else {
							$data ['testimonials_page_upload_banner'] = $data ['testimonials_page_upload_banner'] ['value'];
						}
					}
					$evolveddatatype ['testimonials_page_upload_banner'] = 'evolved_homepage_testimonials';
				}

				if ($blockname == "evolved_aboutus")
				{
					if (isset ( $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_one_upload_banner'] ) && $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_one_upload_banner'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_one_upload_banner'],
									'type' => $_FILES ['evolved_homepage_aboutus'] ['type'] ['aboutus_element_style_one_upload_banner'],
									'tmp_name' => $_FILES ['evolved_homepage_aboutus'] ['tmp_name'] ['aboutus_element_style_one_upload_banner'],
									'error' => $_FILES ['evolved_homepage_aboutus'] ['error'] ['aboutus_element_style_one_upload_banner'],
									'size' => $_FILES ['evolved_homepage_aboutus'] ['size'] ['aboutus_element_style_one_upload_banner']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_one_upload_banner'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['aboutus_element_style_one_upload_banner'] = "evolved/" . $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_one_upload_banner'];
					} else {
						if ($data ['aboutus_element_style_one_upload_banner'] ['delete'] == 1) {
							$data ['aboutus_element_style_one_upload_banner'] = "";
						} else {
							$data ['aboutus_element_style_one_upload_banner'] = $data ['aboutus_element_style_one_upload_banner'] ['value'];
						}
					}
					$evolveddatatype ['aboutus_element_style_one_upload_banner'] = 'evolved_homepage_aboutus';
					
					if (isset ( $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_two_upload_banner'] ) && $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_two_upload_banner'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_two_upload_banner'],
									'type' => $_FILES ['evolved_homepage_aboutus'] ['type'] ['aboutus_element_style_two_upload_banner'],
									'tmp_name' => $_FILES ['evolved_homepage_aboutus'] ['tmp_name'] ['aboutus_element_style_two_upload_banner'],
									'error' => $_FILES ['evolved_homepage_aboutus'] ['error'] ['aboutus_element_style_two_upload_banner'],
									'size' => $_FILES ['evolved_homepage_aboutus'] ['size'] ['aboutus_element_style_two_upload_banner']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_two_upload_banner'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['aboutus_element_style_two_upload_banner'] = "evolved/" . $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_two_upload_banner'];
					} else {
						if ($data ['aboutus_element_style_two_upload_banner'] ['delete'] == 1) {
							$data ['aboutus_element_style_two_upload_banner'] = "";
						} else {
							$data ['aboutus_element_style_two_upload_banner'] = $data ['aboutus_element_style_two_upload_banner'] ['value'];
						}
					}
					$evolveddatatype ['aboutus_element_style_two_upload_banner'] = 'evolved_homepage_aboutus';
					
					if (isset ( $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_three_upload_banner'] ) && $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_three_upload_banner'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_three_upload_banner'],
									'type' => $_FILES ['evolved_homepage_aboutus'] ['type'] ['aboutus_element_style_three_upload_banner'],
									'tmp_name' => $_FILES ['evolved_homepage_aboutus'] ['tmp_name'] ['aboutus_element_style_three_upload_banner'],
									'error' => $_FILES ['evolved_homepage_aboutus'] ['error'] ['aboutus_element_style_three_upload_banner'],
									'size' => $_FILES ['evolved_homepage_aboutus'] ['size'] ['aboutus_element_style_three_upload_banner']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_three_upload_banner'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['aboutus_element_style_three_upload_banner'] = "evolved/" . $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_three_upload_banner'];
					} else {
						if ($data ['aboutus_element_style_three_upload_banner'] ['delete'] == 1) {
							$data ['aboutus_element_style_three_upload_banner'] = "";
						} else {
							$data ['aboutus_element_style_three_upload_banner'] = $data ['aboutus_element_style_three_upload_banner'] ['value'];
						}
					}
					$evolveddatatype ['aboutus_element_style_three_upload_banner'] = 'evolved_homepage_aboutus';
					
					if (isset ( $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_four_upload_banner'] ) && $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_four_upload_banner'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_four_upload_banner'],
									'type' => $_FILES ['evolved_homepage_aboutus'] ['type'] ['aboutus_element_style_four_upload_banner'],
									'tmp_name' => $_FILES ['evolved_homepage_aboutus'] ['tmp_name'] ['aboutus_element_style_four_upload_banner'],
									'error' => $_FILES ['evolved_homepage_aboutus'] ['error'] ['aboutus_element_style_four_upload_banner'],
									'size' => $_FILES ['evolved_homepage_aboutus'] ['size'] ['aboutus_element_style_four_upload_banner']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_four_upload_banner'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['aboutus_element_style_four_upload_banner'] = "evolved/" . $_FILES ['evolved_homepage_aboutus'] ['name'] ['aboutus_element_style_four_upload_banner'];
					} else {
						if ($data ['aboutus_element_style_four_upload_banner'] ['delete'] == 1) {
							$data ['aboutus_element_style_four_upload_banner'] = "";
						} else {
							$data ['aboutus_element_style_four_upload_banner'] = $data ['aboutus_element_style_four_upload_banner'] ['value'];
						}
					}
					$evolveddatatype ['aboutus_element_style_four_upload_banner'] = 'evolved_homepage_aboutus';
				}
				
				
				
				if ($blockname == "evolved_productdetails")
				{
					if (isset ( $_FILES ['evolved_form_productdetails_videoimage'] ['name'] ['evolved_form_productdetails_videoimage_product'] ) && $_FILES ['evolved_form_productdetails_videoimage'] ['name'] ['evolved_form_productdetails_videoimage_product'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_productdetails_videoimage'] ['name'] ['evolved_form_productdetails_videoimage_product'],
									'type' => $_FILES ['evolved_form_productdetails_videoimage'] ['type'] ['evolved_form_productdetails_videoimage_product'],
									'tmp_name' => $_FILES ['evolved_form_productdetails_videoimage'] ['tmp_name'] ['evolved_form_productdetails_videoimage_product'],
									'error' => $_FILES ['evolved_form_productdetails_videoimage'] ['error'] ['evolved_form_productdetails_videoimage_product'],
									'size' => $_FILES ['evolved_form_productdetails_videoimage'] ['size'] ['evolved_form_productdetails_videoimage_product']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_productdetails_videoimage'] ['name'] ['evolved_form_productdetails_videoimage_product'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['evolved_form_productdetails_videoimage_product'] = "evolved/" . $_FILES ['evolved_form_productdetails_videoimage'] ['name'] ['evolved_form_productdetails_videoimage_product'];
					} else {
						if ($data ['evolved_form_productdetails_videoimage_product'] ['delete'] == 1) {
							$data ['evolved_form_productdetails_videoimage_product'] = "";
						} else {
							$data ['evolved_form_productdetails_videoimage_product'] = $data ['evolved_form_productdetails_videoimage_product'] ['value'];
						}
					}
					$evolveddatatype ['evolved_form_productdetails_videoimage_product'] = 'evolved_form_productdetails_videoimage_product';
					
			 
			
			}
			
			
				
				if ($blockname == "evolved_buttons")
				{
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['button_background_image'];
					} else {
						if ($data ['button_background_image'] ['delete'] == 1) {
							$data ['button_background_image'] = "";
						} else {
							$data ['button_background_image'] = $data ['button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['button_background_image'] = 'evolved_form_buttons_img';
				
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['button_addto_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['button_addto_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['button_addto_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['button_addto_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['button_addto_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['button_addto_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['button_addto_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['button_addto_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['button_addto_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['button_addto_background_image'];
					} else {
						if ($data ['button_addto_background_image'] ['delete'] == 1) {
							$data ['button_addto_background_image'] = "";
						} else {
							$data ['button_addto_background_image'] = $data ['button_addto_background_image'] ['value'];
						}
					}
					$evolveddatatype ['button_addto_background_image'] = 'evolved_form_buttons_img';
					
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_update_cart_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_update_cart_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_update_cart_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_update_cart_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_update_cart_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_update_cart_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_update_cart_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_update_cart_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_update_cart_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_update_cart_button_background_image'];
					} else {
						if ($data ['shoppingcart_update_cart_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_update_cart_button_background_image'] = "";
						} else {
							$data ['shoppingcart_update_cart_button_background_image'] = $data ['shoppingcart_update_cart_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_update_cart_button_background_image'] = 'evolved_form_buttons_img';
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_continue_shopping_cart_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_continue_shopping_cart_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_continue_shopping_cart_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_continue_shopping_cart_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_continue_shopping_cart_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_continue_shopping_cart_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_continue_shopping_cart_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_continue_shopping_cart_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_continue_shopping_cart_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_continue_shopping_cart_button_background_image'];
					} else {
						if ($data ['shoppingcart_continue_shopping_cart_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_continue_shopping_cart_button_background_image'] = "";
						} else {
							$data ['shoppingcart_continue_shopping_cart_button_background_image'] = $data ['shoppingcart_continue_shopping_cart_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_continue_shopping_cart_button_background_image'] = 'evolved_form_buttons_img';
					
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_empty_cart_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_empty_cart_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_empty_cart_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_empty_cart_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_empty_cart_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_empty_cart_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_empty_cart_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_empty_cart_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_empty_cart_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_empty_cart_button_background_image'];
					} else {
						if ($data ['shoppingcart_empty_cart_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_empty_cart_button_background_image'] = "";
						} else {
							$data ['shoppingcart_empty_cart_button_background_image'] = $data ['shoppingcart_empty_cart_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_empty_cart_button_background_image'] = 'evolved_form_buttons_img';
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_processed_to_checkout_cart_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_processed_to_checkout_cart_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_processed_to_checkout_cart_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_processed_to_checkout_cart_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_processed_to_checkout_cart_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_processed_to_checkout_cart_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_processed_to_checkout_cart_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_processed_to_checkout_cart_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_processed_to_checkout_cart_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_processed_to_checkout_cart_button_background_image'];
					} else {
						if ($data ['shoppingcart_processed_to_checkout_cart_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_processed_to_checkout_cart_button_background_image'] = "";
						} else {
							$data ['shoppingcart_processed_to_checkout_cart_button_background_image'] = $data ['shoppingcart_processed_to_checkout_cart_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_processed_to_checkout_cart_button_background_image'] = 'evolved_form_buttons_img';
					
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_discount_cart_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_discount_cart_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_discount_cart_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_discount_cart_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_discount_cart_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'];
					} else {
						if ($data ['shoppingcart_discount_cart_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_discount_cart_button_background_image'] = "";
						} else {
							$data ['shoppingcart_discount_cart_button_background_image'] = $data ['shoppingcart_discount_cart_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_discount_cart_button_background_image'] = 'evolved_form_buttons_img';
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_discount_cart_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_discount_cart_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_discount_cart_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_discount_cart_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_discount_cart_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_discount_cart_button_background_image'];
					} else {
						if ($data ['shoppingcart_discount_cart_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_discount_cart_button_background_image'] = "";
						} else {
							$data ['shoppingcart_discount_cart_button_background_image'] = $data ['shoppingcart_discount_cart_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_discount_cart_button_background_image'] = 'evolved_form_buttons_img';
					
					if (isset ( $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_estimate_tax_Update_total_button_background_image'] ) && $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_estimate_tax_Update_total_button_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_estimate_tax_Update_total_button_background_image'],
									'type' => $_FILES ['evolved_form_buttons_img'] ['type'] ['shoppingcart_estimate_tax_Update_total_button_background_image'],
									'tmp_name' => $_FILES ['evolved_form_buttons_img'] ['tmp_name'] ['shoppingcart_estimate_tax_Update_total_button_background_image'],
									'error' => $_FILES ['evolved_form_buttons_img'] ['error'] ['shoppingcart_estimate_tax_Update_total_button_background_image'],
									'size' => $_FILES ['evolved_form_buttons_img'] ['size'] ['shoppingcart_estimate_tax_Update_total_button_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_estimate_tax_Update_total_button_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['shoppingcart_estimate_tax_Update_total_button_background_image'] = "evolved/" . $_FILES ['evolved_form_buttons_img'] ['name'] ['shoppingcart_estimate_tax_Update_total_button_background_image'];
					} else {
						if ($data ['shoppingcart_estimate_tax_Update_total_button_background_image'] ['delete'] == 1) {
							$data ['shoppingcart_estimate_tax_Update_total_button_background_image'] = "";
						} else {
							$data ['shoppingcart_estimate_tax_Update_total_button_background_image'] = $data ['shoppingcart_estimate_tax_Update_total_button_background_image'] ['value'];
						}
					}
					$evolveddatatype ['shoppingcart_estimate_tax_Update_total_button_background_image'] = 'evolved_form_buttons_img';
					
				}
				
				if ($blockname == "evolved_header")
				{
						
					$promoenable = $evolveddata['evolved_form_header_promo_banner']['header_promo_banner_onoff'];
						
					
					$config->saveConfig ('evolved/header_promo_banner/enable', $promoenable, 'default', 0 );
							
					
					
					
					if (isset ( $_FILES ['evolved_form_header']['name']['header_search_icon'] ) && $_FILES ['evolved_form_header']['name']['header_search_icon'] != '') {
						try {
								
							//$uploader = new Varien_File_Uploader ( 'evolved_form_header[header_search_icon]' );
								
							$uploader = new Varien_File_Uploader (array(
									'name' => $_FILES['evolved_form_header']['name']['header_search_icon'],
									'type' => $_FILES['evolved_form_header']['type']['header_search_icon'],
									'tmp_name' => $_FILES['evolved_form_header']['tmp_name']['header_search_icon'],
									'error' => $_FILES['evolved_form_header']['error']['header_search_icon'],
									'size' => $_FILES['evolved_form_header']['size']['header_search_icon']
							));
								
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
								
							// Set the file upload mode
							// false -> get the file directly in the specified folder
							// true -> get the file in the product like folders
							// (file.jpg will go in something like /media/f/i/file.jpg)
							$uploader->setFilesDispersion ( false );
								
							// We set media as the upload dir
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_header']['name']['header_search_icon'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['header_search_icon'] = "evolved/" . $_FILES ['evolved_form_header']['name']['header_search_icon'];
					} else {
						if ($data ['header_search_icon'] ['delete'] == 1) {
							$data ['header_search_icon'] = "";
						} else {
							$data ['header_search_icon'] = $data ['header_search_icon'] ['value'];
						}
					}
					$evolveddatatype['header_search_icon'] = 'evolved_form_header';
					
					if (isset ( $_FILES ['evolved_form_header_general'] ['name'] ['header_background_image'] ) && $_FILES ['evolved_form_header_general'] ['name'] ['header_background_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_header_general'] ['name'] ['header_background_image'],
									'type' => $_FILES ['evolved_form_header_general'] ['type'] ['header_background_image'],
									'tmp_name' => $_FILES ['evolved_form_header_general'] ['tmp_name'] ['header_background_image'],
									'error' => $_FILES ['evolved_form_header_general'] ['error'] ['header_background_image'],
									'size' => $_FILES ['evolved_form_header_general'] ['size'] ['header_background_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_header_general'] ['name'] ['header_background_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['header_background_image'] = "evolved/" . $_FILES ['evolved_form_header_general'] ['name'] ['header_background_image'];
					} else {
						if ($data ['header_background_image'] ['delete'] == 1) {
							$data ['header_background_image'] = "";
						} else {
							$data ['header_background_image'] = $data ['header_background_image'] ['value'];
						}
					}
					$evolveddatatype ['header_background_image'] = 'evolved_form_header_general';
				}

               				
				if ($blockname == "evolved_newsletter")
				{
					if (isset ( $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_desktop'] ) && $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_desktop'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_desktop'],
									'type' => $_FILES ['evolved_form_newsletter'] ['type'] ['newsletter_background_image_desktop'],
									'tmp_name' => $_FILES ['evolved_form_newsletter'] ['tmp_name'] ['newsletter_background_image_desktop'],
									'error' => $_FILES ['evolved_form_newsletter'] ['error'] ['newsletter_background_image_desktop'],
									'size' => $_FILES ['evolved_form_newsletter'] ['size'] ['newsletter_background_image_desktop']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_desktop'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['newsletter_background_image_desktop'] = "evolved/" . $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_desktop'];
					} else {
						if ($data ['newsletter_background_image_desktop'] ['delete'] == 1) {
							$data ['newsletter_background_image_desktop'] = "";
						} else {
							$data ['newsletter_background_image_desktop'] = $data ['newsletter_background_image_desktop'] ['value'];
						}
					}
					$evolveddatatype ['newsletter_background_image_desktop'] = 'evolved_form_newsletter';
					
					if (isset ( $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_mobile'] ) && $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_mobile'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_mobile'],
									'type' => $_FILES ['evolved_form_newsletter'] ['type'] ['newsletter_background_image_mobile'],
									'tmp_name' => $_FILES ['evolved_form_newsletter'] ['tmp_name'] ['newsletter_background_image_mobile'],
									'error' => $_FILES ['evolved_form_newsletter'] ['error'] ['newsletter_background_image_mobile'],
									'size' => $_FILES ['evolved_form_newsletter'] ['size'] ['newsletter_background_image_mobile']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_mobile'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['newsletter_background_image_mobile'] = "evolved/" . $_FILES ['evolved_form_newsletter'] ['name'] ['newsletter_background_image_mobile'];
					} else {
						if ($data ['newsletter_background_image_mobile'] ['delete'] == 1) {
							$data ['newsletter_background_image_mobile'] = "";
						} else {
							$data ['newsletter_background_image_mobile'] = $data ['newsletter_background_image_mobile'] ['value'];
						}
					}
					$evolveddatatype ['newsletter_background_image_mobile'] = 'evolved_form_newsletter';
				}
				
				
				
				// echo $data['contacts_title'];
				if (is_array ( $data ['top_links_option'] )) {
					if ($data ['top_links_option']) {
						$toplinkoption = implode ( "|", $data ['top_links_option'] );
						$data ['top_links_option'] = $toplinkoption;
					} else {
						$data ['top_links_option'] = 0;
					}
				}
				
				if (is_array ( $data ['social_links_option'] )) {
					if ($data ['social_links_option']) {
						$sociallinksoption = implode ( "|", $data ['social_links_option'] );
						$data ['social_links_option'] = $sociallinksoption;
					} else {
						$data ['social_links_option'] = 0;
					}
				}
				
				if (is_array ( $data ['account_menu_sidebar'] )) {
					if ($data ['account_menu_sidebar']) {
						$accountmenusidebar = implode ( "|", $data ['account_menu_sidebar'] );
						$data ['account_menu_sidebar'] = $accountmenusidebar;
					} else {
						$data ['account_menu_sidebar'] = 0;
					}
				}
				
				if (is_array ( $data ['captcha_form_option'] )) {
					if ($data ['captcha_form_option']) {
						$captchaformoption = implode ( "|", $data ['captcha_form_option'] );
						$data ['captcha_form_option'] = $captchaformoption;
					} else {
						$data ['captcha_form_option'] = 0;
					}
				}
				 
				/*
				 * if(serialize($data['productdetails_social_enable']))
				 * {
				 * $data['productdetails_social_enable'] = serialize($data['productdetails_social_enable']);
				 * }
				 */
				if (is_array ( $data ['productdetails_social_enable'] )) {
					$data ['productdetails_social_enable'] = serialize ( $data ['productdetails_social_enable'] );
				}
				// echo "<pre>"; print_r($data['productdetails_social_enable']); exit;
				
				if (is_array ( $data ['appointment_category'] )) {
					if ($data ['appointment_category']) {
						$appointment_category = implode ( "|", $data ['appointment_category'] );
						$data ['appointment_category'] = $appointment_category;
					} else {
						$data ['appointment_category'] = 0;
					}
				}
				
				
				
				if ($blockname == "evolved_social")
				{
					if (isset ( $_FILES ['evolved_form_social'] ['name'] ['social_custom_image'] ) && $_FILES ['evolved_form_social'] ['name'] ['social_custom_image'] != '') {
						try {
							$uploader = new Varien_File_Uploader ( array (
									'name' => $_FILES ['evolved_form_social'] ['name'] ['social_custom_image'],
									'type' => $_FILES ['evolved_form_social'] ['type'] ['social_custom_image'],
									'tmp_name' => $_FILES ['evolved_form_social'] ['tmp_name'] ['social_custom_image'],
									'error' => $_FILES ['evolved_form_social'] ['error'] ['social_custom_image'],
									'size' => $_FILES ['evolved_form_social'] ['size'] ['social_custom_image']
							) );
							// Any extention would work
							$uploader->setAllowedExtensions ( array (
									'jpg',
									'jpeg',
									'gif',
									'png'
							) );
							$uploader->setAllowRenameFiles ( false );
							$uploader->setFilesDispersion ( false );
							$path = Mage::getBaseDir ( 'media' ) . DS . "evolved";
							if (! is_dir ( $path )) {
								mkdir ( $path );
							}
							$uploader->save ( $path, $_FILES ['evolved_form_social'] ['name'] ['social_custom_image'] );
						} catch ( Exception $e ) {
						}
						// this way the name is saved in DB
						$data ['social_custom_image'] = "evolved/" . $_FILES ['evolved_form_social'] ['name'] ['social_custom_image'];
					} else {
						if ($data ['social_custom_image'] ['delete'] == 1) {
							$data ['social_custom_image'] = "";
						} else {
							$data ['social_custom_image'] = $data ['social_custom_image'] ['value'];
						}
					}
					
					$evolveddatatype ['social_custom_image'] = 'evolved_form_social';
				}
				
				
				/*
				 * $data['social_icons_size'] = "";
				 * $data['social_icons_theme'] = "";
				 * $data['social_icons_theme'] = "";
				 */
				// echo $data['couponid'];
				// echo "<pre>";
				// print_r($data);
				// exit;
				try {
					$model = Mage::getModel ( 'evolved/evolved' );
					
					foreach($evolveddata as $evolveddatakey => $evolveddatavalue)
					{
						foreach($evolveddatavalue as $datakey => $datavalue)
						{
							$evolveddatatype[$datakey] = $evolveddatakey;
						}
					}
					//echo htmlentities($data['config']['general_miscellaneous_head_scripts']); exit;
					 //echo "<pre>";
					//print_r($evolveddatatype); 
					//echo ($evolveddatatype['homepage_element_1_textrow_style_marker_image']);
					//echo "<br />#######################<br />";
					//print_r($data);
					//exit;
					$postkeyarr = array_unique(array_merge(array_keys($data),array_keys($evolveddatatype)));
					//echo "<pre>"; print_r($data); exit;
					foreach ( $data as $field => $value ) {
						
						if ($field == 'form_key') {
							continue;
						}
						

						if ($field == 'config') {
							$config = new Mage_Core_Model_Config ();
							$data['general_store_information_name'] = $value ['general_store_information_name'];
							$config->saveConfig ( 'general/store_information/name', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'general/store_information/phone', $value ['general_store_information_phone'], 'default', 0 );
							
							//Task: http://production.idealbrandmarketing.com/task_detail.php?ti=14544
							//admin live chat should post the phone number dynamically from the general settings omitting the special characters and spaces.
							if($value ['general_store_information_phone'] != "") {
								$CompanyID = preg_replace("/[^0-9]/","",$value ['general_store_information_phone']);
								$config->saveConfig ( 'general/livechatadmin/company_id', $CompanyID, 'default', 0 );
							}
							
							$config->saveConfig ( 'trans_email/ident_general/name', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'trans_email/ident_general/email', $value ['trans_email_ident_general_email'], 'default', 0 );
							
							$config->saveConfig ( 'trans_email/ident_sales/name', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'trans_email/ident_sales/email', $value ['trans_email_ident_general_email'], 'default', 0 );
							
							$config->saveConfig ( 'trans_email/ident_support/name', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'trans_email/ident_support/email', $value ['trans_email_ident_general_email'], 'default', 0 );
							
							$config->saveConfig ( 'trans_email/ident_custom1/name', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'trans_email/ident_custom1/email', $value ['trans_email_ident_general_email'], 'default', 0 );
							
							$config->saveConfig ( 'trans_email/ident_custom2/name', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'trans_email/ident_custom2/email', $value ['trans_email_ident_general_email'], 'default', 0 );
							
							$config->saveConfig ( 'sales_email/order/copy_to', $value ['trans_email_ident_general_email'] . ',info@idealbrandmarketing.com', 'default', 0 );
							
							$config->saveConfig ( 'contacts/email/recipient_email', $value ['trans_email_ident_general_email'], 'default', 0 );
							$config->saveConfig ( 'quotes/email/recipient_email', $value ['trans_email_ident_general_email'], 'default', 0 );
							$config->saveConfig ( 'customcontactnew/email/recipient_email', $value ['trans_email_ident_general_email'], 'default', 0 );
							$config->saveConfig ( 'diamondrequest/email/recipient_email', $value ['trans_email_ident_general_email'], 'default', 0 );
							$config->saveConfig ( 'uploadtool/email/recipient_email', $value ['trans_email_ident_general_email'], 'default', 0 );
							$config->saveConfig ( 'design/header/logo_alt', $value ['general_store_information_name'], 'default', 0 );
							$config->saveConfig ( 'design/head/default_title', $value ['general_store_information_name'], 'default', 0 );
							
							$address = "";
							if ($data ['general_store_information_address1'] != "") {
								$address .= rtrim($data ['general_store_information_address1'],',');
							}
							if ($data ['general_store_information_address2'] != "") {
								$address .= ", " . rtrim($data ['general_store_information_address2'],',');
							}
							
							if ($data ['general_store_information_city'] != "") {
								$address .= "<br>" . rtrim($data ['general_store_information_city'],',');
							}
							
							if ($data ['general_store_state'] != "") {
								
								$region = Mage::getModel ( 'directory/region' )->load ( $data ['general_store_state'] );
								if ($region->getCode()) {
									$address .= ", " . $region->getCode();
								} else if ($region->getName()) {
									$address .= ", " . $region->getName();
								} else {
									$address .= ", " . $data['general_store_state'];
								}
								//echo "<pre>"; print_r($region->getData());exit;
							}
							
							if ($data ['general_store_information_zip'] != "") {
								$address .= " " . $data ['general_store_information_zip'];
							}
							//echo $address; exit;
							/* 123 Main Street, Suite 788
							City, State Abbreviation Zip 
							provided by John */
							
							$config->saveConfig ( 'general/store_information/address', $address, 'default', 0 );
							
							if ($data ['general_store_country'] != "") {
								$config->saveConfig ( 'general/store_information/merchant_country', $data ['general_store_country'], 'default', 0 );
							}
							
							$config->saveConfig ( 'shipping/origin/street_line1', $data ['general_store_information_address1'], 'default', 0 );
							$config->saveConfig ( 'shipping/origin/street_line2', $data ['general_store_information_address2'], 'default', 0 );
							$config->saveConfig ( 'shipping/origin/city', $data ['general_store_information_city'], 'default', 0 );
							$config->saveConfig ( 'shipping/origin/postcode', $data ['general_store_information_zip'], 'default', 0 );
							$config->saveConfig ( 'shipping/origin/country_id', $data ['general_store_country'], 'default', 0 );
							$config->saveConfig ( 'shipping/origin/region_id', $data ['general_store_state'], 'default', 0 );
							
							if($this->getRequest ()->getPost ( 'evolved_form_newsletter' )['config']['newsletter_popup_enable']){
								$config->saveConfig ( 'newsletter/general/secondtitle', $value ['newsletter_popup_title'], 'default', 0 );
								$config->saveConfig ( 'newsletter/general/message', $value ['newsletter_popup_description'], 'default', 0 );
							}
							
							//continue;
						}
						if ($blockname == "evolved_general") {

							$config->saveConfig ( 'design/head/includes', str_replace("\'", "'", str_replace('\"','"', addslashes($data['config']['general_miscellaneous_head_scripts']))) , 'default', 0 );
							$config->saveConfig ( 'design/footer/absolute_footer', str_replace("\'", "'", str_replace('\"','"', addslashes($data['config']['general_miscellaneous_footer_html']))) , 'default', 0 );
							//$config->saveConfig ( 'smtppro/general/googleapps_email', $data ['general_googleapps_username'], 'default', 0 );
							//$config->saveConfig ( 'smtppro/general/googleapps_gpassword', Mage::helper ( 'core' )->encrypt ( $data ['general_googleapps_password'] ), 'default', 0 );
							//$config->saveConfig ( 'smtppro/general/option', 'google', 'default', 0 );
						}
						if ($blockname == "evolved_contacts") {
							if ($data ['contacts_title']) {
								// $contactpage = Mage::getModel('cms/page')->load(13);
								// $contactpage = Mage::getModel('cms/page')->loadByAttribute('identifier', 'contacts.html');
								/*
								 * $contactpage = Mage::getModel('cms/page')->load('contacts.html', 'identifier');
								 * $contactpage->setTitle($data['contacts_title']);
								 * $contactpage->setMetaKeywords($data['contacts_title']);
								 * $contactpage->setMetaDescription($data['contacts_meta_description']);
								 * $contactpage->save();
								 */
								$config->saveConfig ( 'evolved/contacts/metakeywords', $data ['contacts_title'], 'default', 0 );
							}
							if ($data ['contacts_meta_description']) {
								$config->saveConfig ( 'evolved/contacts/metadescription', $data ['contacts_meta_description'], 'default', 0 );
							}
						}
						/* if ($this->getRequest ()->getPost ( 'evolved_form_newsletter' )['config']['newsletter_popup_enable']) {
							$config = new Mage_Core_Model_Config ();
							$config->saveConfig ( 'newsletter/general/secondtitle', $value ['newsletter_popup_title'], 'default', 0 );
							$config->saveConfig ( 'newsletter/general/message', $value ['newsletter_popup_description'], 'default', 0 );
						} */
						$config = new Mage_Core_Model_Config ();
						if ($data ['shopping_checkout_multiple_address_enable'] != "") {
							$config->saveConfig ( 'shipping/option/checkout_multiple', $data ['shopping_checkout_multiple_address_enable'], 'default', 0 );
						}
						
						if($field == "config")
						{
							foreach($value as $valuekey => $valuevalue)
							{
								//echo "<br />".$valuekey." => ".$valuevalue;
								$collection = $model->getCollection ()->addFieldToFilter ( 'field', $valuekey );
								if(!in_array($valuekey,$postkeyarr))
								{
									continue;
								}
								else
								{
									if (count ( $collection ) > 0) {
										$exists = $collection->getData ();
										$existsId = $exists [0] ['evolved_id'];
										$settings = array (
												'evolved_id' => $existsId,
												'field' => $valuekey,
												'value' => $valuevalue,
												'type' => $evolveddatatype[$valuekey]
										);
									} else {
										$settings = array (
												'field' => $valuekey,
												'value' => $valuevalue,
												'type' => $evolveddatatype[$valuekey]
										);
									}
								} 
								//echo "<pre>"; print_r($settings); echo "</pre>";
								$model->setData ( $settings );
								$model->save ();
							}
						}
						else 
						{
							$collection = $model->getCollection ()->addFieldToFilter ( 'field', $field );
							if(!in_array($field,$postkeyarr))
							{
								continue;
							}
							else
							{
								if (count ( $collection ) > 0) {
									$exists = $collection->getData ();
									$existsId = $exists [0] ['evolved_id'];
									$settings = array (
											'evolved_id' => $existsId,
											'field' => $field,
											'value' => $value,
											'type' => $evolveddatatype[$field]
									);
								} else {
									$settings = array (
											'field' => $field,
											'value' => $value,
											'type' => $evolveddatatype[$field]
									);
								}
							}	
							$model->setData ( $settings );
							$model->save ();
						}
						 //echo "<pre>"; 
						 //print_r($evolveddatatype[$field]); 
						// print_r($settings);
						// echo "</pre>";
						// exit;
						// Mage::getModel('salesrule/rule')->load(1)
						
						//$model->setData ( $settings );
						
						//$model->save ();
						//echo "<br />".$evolveddatatype[$field]." => ".$field."   value ::: ".$value;
					}

                     // Mage::app()->getCacheInstance()->cleanType('config');
				$types=array('config','layout','block_html','translate','collections','eav');
      			foreach($types as $type) 
				{
            		$c = Mage::app()->getCacheInstance()->cleanType($type);
            		Mage::dispatchEvent('adminhtml_cache_refresh_type', array('type' => $type));
      			}
					
				if(Mage::helper('core')->isModuleOutputEnabled('Litespeed_Litemage'))
				{
					Mage::getModel( 'litemage/observer_purge' )->adminPurgeCache(null);
				}

					//exit;
					
					Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'evolved' )->__ ( 'Settings was successfully saved' ) );
					Mage::getSingleton ( 'adminhtml/session' )->setFormData ( false );
					
					if ($this->getRequest ()->getParam ( 'back' )) {
						Mage::app ()->getResponse ()->setRedirect ( $_SERVER ['HTTP_REFERER'] )->sendResponse ();
						exit ();
						// $this->_redirect('*/*/settings');
						return;
					}
					
					// $this->_redirect('*/*/settings');
					// echo $this->_redirect($_SERVER['HTTP_REFERER']);
					Mage::app ()->getResponse ()->setRedirect ( $_SERVER ['HTTP_REFERER'] )->sendResponse ();
					exit ();
					return;
				} catch ( Exception $e ) {
					Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
					Mage::getSingleton ( 'adminhtml/session' )->setFormData ( $data );
					Mage::app ()->getResponse ()->setRedirect ( $_SERVER ['HTTP_REFERER'] )->sendResponse ();
					exit ();
					// $this->_redirect('*/*/settings');
					return;
				}
			}
		}
		Mage::getSingleton ( 'adminhtml/session' )->addError ( Mage::helper ( 'evolved' )->__ ( 'Unable to find item to save' ) );
		Mage::app ()->getResponse ()->setRedirect ( $_SERVER ['HTTP_REFERER'] )->sendResponse ();
		exit ();
		// $this->_redirect('*/*/settings');
	}
	public function stateAction() {
		$countrycode = $this->getRequest ()->getParam ( 'country' );
		
		if ($countrycode != '') {
			$statearray = Mage::getModel ( 'directory/region' )->getResourceCollection ()->addCountryFilter ( $countrycode )->load ();
			if (count ( $statearray ) != 0) {
				$state = "<select id=\"general_store_state\" class=\"select\" name=\"general_store_state\">";
				$state .= "<option value=''>Please Select</option>";
				$i = 1;
				foreach ( $statearray as $_state ) {
					$state .= "<option value='" . $i . "'>" . $_state->getDefaultName () . "</option>";
					$i ++;
				}
				$state .= "</select>";
			} else {
				$state = "<input type=\"text\" id=\"general_store_state\" class=\"input-text\" name=\"general_store_state\" />";
			}
		}
		echo $state;
	}
	public function deleteAction() {
		if ($this->getRequest ()->getParam ( 'id' ) > 0) {
			try {
				$model = Mage::getModel ( 'evolved/evolved' );
				
				$model->setId ( $this->getRequest ()->getParam ( 'id' ) )->delete ();
				
				Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Item was successfully deleted' ) );
				$this->_redirect ( '*/*/' );
			} catch ( Exception $e ) {
				Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
				$this->_redirect ( '*/*/edit', array (
						'id' => $this->getRequest ()->getParam ( 'id' ) 
				) );
			}
		}
		$this->_redirect ( '*/*/' );
	}
	protected function _isAllowed() {
		return Mage::getSingleton('admin/session')->isAllowed('theme');
	}
}
