<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('diamondsearch')};
CREATE TABLE {$this->getTable('diamondsearch')} (
  `diamondsearch_id` int(11) unsigned NOT NULL auto_increment,
  `slider_color` varchar(255) NOT NULL default '',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`diamondsearch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 