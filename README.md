UAM Amazon Search Bundle
========================

This package provides a Symfony 2.* bundle that includes usable samples of pages using the UMAwsEcsBundle.


Installation
------------
Via composer:

Add the library package to your `composer.json` file:

```
	require: {
		…
		"uam/amazon-search-bundle": "dev-master"
	}
```

Register the bundle in `AppKernel.php`:

```
<?php 

	#AppKernel.php
	
	public function registerBundles()
    {
        $bundles = array(
        	…
        	new UAM\Bundle\AazonSearchBundle\UAMAmazonSearchBundle()
    }

```

