# Monolog CloudWatch Bundle

This bundle heavily depends on the [maxbanton/cwh](https://github.com/maxbanton/cwh) package. So go to the Github repository and also leave a star.

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
 
AWS IAM needed permissions
-------------
if you prefer to use a separate programmatic IAM user (recommended) or want to define a policy, make sure following permissions are included:
1. `CreateLogGroup` [aws docs](https://docs.aws.amazon.com/AmazonCloudWatchLogs/latest/APIReference/API_CreateLogGroup.html)
1. `CreateLogStream` [aws docs](https://docs.aws.amazon.com/AmazonCloudWatchLogs/latest/APIReference/API_CreateLogStream.html)
1. `PutLogEvents` [aws docs](https://docs.aws.amazon.com/AmazonCloudWatchLogs/latest/APIReference/API_PutLogEvents.html)
1. `PutRetentionPolicy` [aws docs](https://docs.aws.amazon.com/AmazonCloudWatchLogs/latest/APIReference/API_PutRetentionPolicy.html)
1. `DescribeLogStreams` [aws docs](https://docs.aws.amazon.com/AmazonCloudWatchLogs/latest/APIReference/API_DescribeLogStreams.html)
1. `DescribeLogGroups` [aws docs](https://docs.aws.amazon.com/AmazonCloudWatchLogs/latest/APIReference/API_DescribeLogGroups.html)

## AWS IAM Policy full json example
```json
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": "logs:CreateLogGroup",
            "Resource": "*"
        },
        {
            "Effect": "Allow",
            "Action": [
                "logs:DescribeLogGroups",
                "logs:CreateLogStream",
                "logs:DescribeLogStreams",
                "logs:PutRetentionPolicy"
            ],
            "Resource": "{LOG_GROUP_ARN}"
        },
        {
            "Effect": "Allow",
            "Action": [
                "logs:PutLogEvents"
            ],
            "Resource": [
                "{LOG_STREAM_1_ARN}",
                "{LOG_STREAM_2_ARN}"
            ]
        }
    ]
}
```

Issues
-------------
Feel free to [report any issues](https://github.com/alpin11/monolog-cloudwatch-bundle/issues/new)

Contributing
-------------
Please check [this document](https://github.com/alpin11/monolog-cloudwatch-bundle/blob/master/CONTRIBUTING.md)
