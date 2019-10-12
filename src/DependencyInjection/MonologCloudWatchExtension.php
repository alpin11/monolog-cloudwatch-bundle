<?php


namespace MonologCloudWatch\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MonologCloudWatchExtension extends Extension implements PrependExtensionInterface
{

    protected $arrayConfigKeys = [
        'tags'
    ];


    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['MonologBundle'])) {
            $handlerConfig = [
                'handlers' => [
                    'cloudwatch' => [
                        'type' => 'service',
                        'id' => 'monolog_cloud_watch.handler'
                    ]
                ]
            ];

            $container->prependExtensionConfig('monolog', $handlerConfig);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);

        $this->setupParameters($container, $config);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

    }

    /**
     * @param ContainerBuilder $container
     * @param array $config
     * @param null $prefix
     */
    private function setupParameters(ContainerBuilder $container, array $config, $prefix = null)
    {
        foreach ($config as $key => $value) {
            if (is_array($value) && !in_array($key, $this->arrayConfigKeys)) {
                $this->setupParameters($container, $value, $key);
            } else {
                if ($prefix == null) {
                    $container->setParameter(sprintf("%s.%s", $this->getAlias(), $key), $value);
                } else {
                    $container->setParameter(sprintf("%s.%s.%s", $this->getAlias(), $prefix, $key), $value);
                }
            }
        }
    }
}