H5P Platform Integration Extension for TYPO3 CMS
============

What is H5P?
============

H5P is an open standard for rich content in browsers, mainly - but certainly not limited to - for learning use cases and
environments. It provides a variety of reusable content types, such as Memory Games, Fill in the Blanks, Multiple Choice
Questions and many more. Too get an overview about H5P and its content types, visit https://h5p.org/content-types-and-applications.

What does this extension do?
============

This extension provides a platform integration for H5P into the TYPO3 CMS (https://typo3.org/), allowing
you to use H5P content types seamlessly within TYPO3 CMS.

Installation
============

Installation is simple and consists of these steps:

1. Add repository url (https://gitlab.com/lms3/core/lms3h5p.git) in composer.json file
2. Run `composer require "lms3/lms3h5p:^1.0"`
3. Install extension from Extension Manager.
4. Make sure `typo3/cms-fluid-styled-content` installed.

Configuration
============

1. Make sure database tables are created.
2. Run `./vendor/bin/typo3 lms3h5p:h5p:configsetting`
3. Run  `./vendor/bin/typo3 lms3h5p:h5p:copyresources`
4. Include the static TypoScript of the extension

H5P Content Preparation
============

1. Create new folder in page tree
2. Click on LMS3: H5P Content and select storage folder
3. Click on `Create new content` icon to create new H5P Content
4. Install H5P Library and use it.

Render Content
============

1. Go to page and add content
2. Select LMS3: H5P Content
3. Select H5P Content from the storage folder
4. Save and Close
5. View content in frontend

Change styling
============

1. Create css file e.g. fileadmin/lms3h5p/custom.css
2. Configure typoscript as follows:

```
module.tx_lms3h5p.settings {
    customStyle {
        path = fileadmin/lms3h5p/custom.css
        version = 20190601150000
    }
}
```

Note: After your css changes, don't forget to change the version number.
