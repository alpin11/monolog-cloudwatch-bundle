# Monolog CloudWatch Bundle

Prerequisites
-------------

This bundle requires Symfony 3.4+.

Installation
------------

Add [`alpin11/monolog-cloudwatch-bundle`](https://packagist.org/packages/alpin11/monolog-cloudwatch-bundle)
to your `composer.json` file:

    php composer.phar require "alpin11/monolog-cloudwatch-bundle"

#### Register the bundle: 

**Symfony 3 Version:**  
Register bundle into `app/AppKernel.php`:

``` php
public function registerBundles()
{
    return array(
        // ...
        new MonologCloudWatch\MonologCloudWatchBundle(),
    );
}

```
**Symfony 4 Version :**   
Register bundle into `config/bundles.php`:  

```php 
return [
    //...
    MonologCloudWatch\MonologCloudWatchBundle::class => ['all' => true],
];
```

