<?php

/**
 * LiteMage
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see https://opensource.org/licenses/GPL-3.0 .
 *
 * @package   LiteSpeed_LiteMage
 * @copyright  Copyright (c) 2015-2016 LiteSpeed Technologies, Inc. (https://www.litespeedtech.com)
 * @license     https://opensource.org/licenses/GPL-3.0
 */


class Litespeed_Litemage_Block_Adminhtml_Cache_Management extends Mage_Adminhtml_Block_Template
{
    /**
     * Get clean cache url
     *
     * @return string
     */
    public function getPurgeUrl($type)
    {
		if ($type == 'Refresh') {
			return $this->getUrl('*/cache/index');
		}
		else {
	        $types = array('All', 'Tag', 'Url');

			if (in_array($type, $types)) {
				return $this->getUrl('*/litemageCache/purge' . $type);
			}
			else {
				return $this->getUrl('*/litemageCache/purgeAll');
			}
		}
    }

	public function getCacheStatistics()
	{
		$statUri = '/__LSCACHE/STATS';
        $base = Mage::getBaseUrl();
		if ((stripos($base, 'http') !== false) && ($pos = strpos($base, '://'))) {
			$pos2 = strpos($base, '/', $pos+ 4);
			if ($pos === false) {
				$statBase = $base;
			}
			else {
				$statBase = substr($base, 0, $pos2);
				if (substr($base, $pos2+1, 1) == '~') {
					if ($pos3 = strpos($base, '/', $pos2+1)) {
						$statBase = substr($base, 0, $pos3);
					}
				}
			}
		}
		$statUri = $statBase . $statUri;

        $client = new Varien_Http_Client($statUri) ;

		try {
			$response = $client->request() ;
			$data = trim($response->getBody());
			if ($data{0} !== '{') {
				return null;
			}

			$data1 = json_decode($data, true);
			$data2 = array_values($data1);
			if (count($data2)) {
				$stats = $data2[0];
				switch ($stats['LITEMAGE_PLAN']) {
					case 11: $stats['plan'] = 'LiteMage Standard';
						$stats['plan_desc'] = 'up to 25000 publicly cached objects';
						break;
					case 3: $stats['plan'] = 'LiteMage Unlimited';
						$stats['plan_desc'] = 'unlimited publicly cached objects';
						break;
					case 9:
					default:
						$stats['plan'] = 'LiteMage Starter';
						$stats['plan_desc'] = 'up to 1500 publicly cached objects';
				}
				return $stats;
			}
		} catch ( Exception $e ) {
		}
		return null;
	}

	public function getCrawlerStatus()
	{
		$status = Mage::getModel( 'litemage/observer_cron' )->getCrawlerStatus();
		$status['url_reset'] = $this->getUrl('*/litemageCache/resetCrawlerList');
		$status['url_details'] = $this->getUrl('*/litemageCache/getCrawlerList');
		return $status;
	}

    /**
     * Check if block can be displayed
     *
     * @return bool
     */
    public function canShowButton()
    {
        return Mage::helper('litemage/data')->moduleEnabled();
    }

    public function isCacheAvailable()
    {
        return Mage::app()->useCache('layout') && Mage::app()->useCache('config');
    }



}
