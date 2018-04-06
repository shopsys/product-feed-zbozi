# Shopsys Framework Zboží.cz Product Feed Plugin

[![Build Status](https://travis-ci.org/shopsys/product-feed-zbozi.svg?branch=master)](https://travis-ci.org/shopsys/product-feed-zbozi)
[![Downloads](https://img.shields.io/packagist/dt/shopsys/product-feed-zbozi.svg)](https://packagist.org/packages/shopsys/product-feed-zbozi)

Plugin for [Shopsys Framework](https://www.shopsys-framework.com) responsible for generating XML product feed for [Zboží.cz](https://www.zbozi.cz).

For detailed information about the feed see [official documentation](https://napoveda.seznam.cz/cz/zbozi/specifikace-xml-pro-obchody/specifikace-xml-feedu/).

## Installation
The plugin is a Symfony bundle and is installed in the same way:

### Download
First, you download the package using [Composer](https://getcomposer.org/):
```
composer require shopsys/product-feed-zbozi
```

### Register
For the bundle to be loaded in your application you need to register it in the `app/AppKernel.php` file of your project:
```php
<?php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new Shopsys\ProductFeed\ZboziBundle\ShopsysProductFeedZboziBundle(),
            // ...
        ];
        
        // ...

        return $bundles;
    }
    
    // ...
}
```

## How to use
You should see the new feed immediately after installation in the administration feed list.
All output XML files will be automatically generated by a cron module or they can be generated manually in administration when logged as superadmin.

## Contributing
Report [issues](https://github.com/shopsys/shopsys/issues/new) and send [pull requests](https://github.com/shopsys/shopsys/compare) in the main [Shopsys repository](https://github.com/shopsys/shopsys).

## Need help
Contact us on our Slack [http://slack.shopsys-framework.com/](http://slack.shopsys-framework.com/).
