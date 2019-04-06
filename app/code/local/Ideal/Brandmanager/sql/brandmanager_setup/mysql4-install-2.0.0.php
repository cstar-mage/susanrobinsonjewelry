<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('brandmanager')};
CREATE TABLE {$this->getTable('brandmanager')} (
  `brandmanager_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `content` text NULL,
  `status` smallint(6) NOT NULL default '0',
  `sortno` int(11) NOT NULL default '0',
  `weblink` varchar(255) NULL,
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  `stores` text default '',
  `is_home` tinyint(1) NOT NULL default '0',
  `categories` text default '',
  PRIMARY KEY (`brandmanager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();