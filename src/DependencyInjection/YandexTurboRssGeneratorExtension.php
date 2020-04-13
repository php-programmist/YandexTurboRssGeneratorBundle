<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class YandexTurboRssGeneratorExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
        
        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);
        
        $definition = $container
            ->getDefinition('php_programmist_yandex_turbo_rss_generator.yandex_turbo_rss_generator');
        $definition->setArgument(1, $config['yandex_id']);
        $definition->setArgument(2, $config['language']);
        $definition->setArgument(3, $config['date_format']);
    }
}
