#
# Table structure for table 'tx_sitepackage_domain_model_event'
#
CREATE TABLE tx_sitepackage_domain_model_event (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    
    title varchar(255) DEFAULT '' NOT NULL,
    slug varchar(255) DEFAULT '' NOT NULL,
    description text,
    start_date int(11) DEFAULT '0' NOT NULL,
    end_date int(11) DEFAULT '0' NOT NULL,
    location varchar(255) DEFAULT '' NOT NULL,
    max_participants int(11) DEFAULT '0' NOT NULL,
    current_participants int(11) DEFAULT '0' NOT NULL,
    
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    
    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY slug (slug)
);

#
# Table structure for table 'tx_sitepackage_domain_model_subscriber'
#
CREATE TABLE tx_sitepackage_domain_model_subscriber (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    
    email varchar(255) DEFAULT '' NOT NULL,
    name varchar(255) DEFAULT '' NOT NULL,
    confirmed tinyint(4) DEFAULT '0' NOT NULL,
    confirmation_token varchar(255) DEFAULT '' NOT NULL,
    confirmed_at int(11) DEFAULT '0' NOT NULL,
    subscribed_at int(11) DEFAULT '0' NOT NULL,
    
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    
    PRIMARY KEY (uid),
    KEY parent (pid),
    UNIQUE KEY email (email)
);
