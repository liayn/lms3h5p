#
# Table structure for table 'tx_lms3h5p_domain_model_setting'
#
CREATE TABLE tx_lms3h5p_domain_model_setting (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    config_key VARCHAR(255) NOT NULL,
    config_value LONGTEXT NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_library'
#
CREATE TABLE tx_lms3h5p_domain_model_library (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    major_version INT NOT NULL,
    minor_version INT NOT NULL,
    patch_version INT NOT NULL,
    runnable TINYINT(1) NOT NULL,
    restricted TINYINT(1) NOT NULL,
    fullscreen TINYINT(1) NOT NULL,
    embed_types VARCHAR(255) NOT NULL,
    preloaded_js LONGTEXT NOT NULL,
    preloaded_css LONGTEXT NOT NULL,
    drop_library_css LONGTEXT NOT NULL,
    semantics LONGTEXT NOT NULL,
    tutorial_url LONGTEXT NOT NULL,
    has_icon TINYINT(1) NOT NULL,
    meta_data_settings LONGTEXT DEFAULT NULL,
    add_to LONGTEXT DEFAULT NULL,
    created_at int(11) DEFAULT '0' NOT NULL,
    updated_at int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_librarydependency'
#
CREATE TABLE tx_lms3h5p_domain_model_librarydependency (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    library int(11) NOT NULL,
    required_library int(11) NOT NULL,
    dependency_type VARCHAR(255) NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_librarytranslation'
#
CREATE TABLE tx_lms3h5p_domain_model_librarytranslation (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    library int(11) NOT NULL,
    language_code varchar(255) NOT NULL,
    translation longtext NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_contenttypecacheentry'
#
CREATE TABLE tx_lms3h5p_domain_model_contenttypecacheentry (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    machine_name VARCHAR(255) NOT NULL,
    major_version INT NOT NULL,
    minor_version INT NOT NULL,
    patch_version INT NOT NULL,
    h5p_major_version INT NOT NULL,
    h5p_minor_version INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    summary LONGTEXT NOT NULL,
    description LONGTEXT NOT NULL,
    icon LONGTEXT NOT NULL,
    created_at int(11) DEFAULT '0' NOT NULL,
    updated_at int(11) DEFAULT '0' NOT NULL,
    is_recommended TINYINT(1) NOT NULL,
    popularity INT NOT NULL,
    screenshots LONGTEXT DEFAULT NULL,
    license LONGTEXT DEFAULT NULL,
    example LONGTEXT NOT NULL,
    tutorial LONGTEXT DEFAULT NULL,
    keywords LONGTEXT DEFAULT NULL,
    categories LONGTEXT DEFAULT NULL,
    owner LONGTEXT DEFAULT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_cachedasset'
#
CREATE TABLE tx_lms3h5p_domain_model_cachedasset (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    library int(11) DEFAULT NULL,
    hash_key VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_content'
#
CREATE TABLE tx_lms3h5p_domain_model_content (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    library int(11) DEFAULT NULL,
    account int(11) DEFAULT NULL,
    zipped_content_file VARCHAR(40) DEFAULT NULL,
    export_file VARCHAR(40) DEFAULT NULL,
    created_at int(11) DEFAULT '0' NOT NULL,
    updated_at int(11) DEFAULT '0' NOT NULL,
    title VARCHAR(255) NOT NULL,
    parameters LONGTEXT NOT NULL,
    filtered LONGTEXT NOT NULL,
    slug VARCHAR(255) NOT NULL,
    embed_type VARCHAR(255) NOT NULL,
    disable INT NOT NULL,
    content_type VARCHAR(255) DEFAULT NULL,
    author VARCHAR(255) DEFAULT NULL,
    keywords LONGTEXT DEFAULT NULL,
    description LONGTEXT DEFAULT NULL,
    source VARCHAR(2083) DEFAULT NULL,
    year_from int(10) DEFAULT NULL,
    year_to int(10) DEFAULT NULL,
    license VARCHAR(255) DEFAULT NULL,
    license_version VARCHAR(10) DEFAULT NULL,
    license_extras LONGTEXT DEFAULT NULL,
    author_comments LONGTEXT DEFAULT NULL,
    changes LONGTEXT DEFAULT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_contentdependency'
#
CREATE TABLE tx_lms3h5p_domain_model_contentdependency (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    content int(11) NOT NULL,
    library int(11) NOT NULL,
    dependency_type VARCHAR(255) NOT NULL,
    weight INT NOT NULL,
    drop_css TINYINT(1) NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_lms3h5p_domain_model_editortempfile'
#
CREATE TABLE tx_lms3h5p_domain_model_editortempfile (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    path VARCHAR(255) NOT NULL,
    created_at int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);
