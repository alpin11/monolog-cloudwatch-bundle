<?php


namespace MonologCloudWatch\Aws;


use Aws\CloudWatchLogs\CloudWatchLogsClient;

class CloudWatchClient extends CloudWatchLogsClient
{
    public function __construct(
        string $accessKey,
        string $secretKey,
        string $region,
        string $version
    )
    {
        parent::__construct([
            'region' => $region,
            'version' => $version,
            'credentials' => [
                'key' => $accessKey,
                'secret' => $secretKey
            ]
        ]);
    }
}