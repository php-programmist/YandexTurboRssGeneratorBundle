<?php

namespace PhpProgrammist\YandexTurboRssGeneratorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('yandex_turbo_rss_generator');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->integerNode('yandex_id')
                    ->defaultValue(0)
                    ->info('ID of your Yandex.Metrika counter')
                ->end()
                ->scalarNode('language')
                    ->defaultValue('ru-RU')
                    ->info('If language not set, default value - ru-RU')
                ->end()
                ->scalarNode('date_format')
                    ->defaultValue('D, d M Y H:i:s e')
                    ->info('If format not set, default value - D, d M Y H:i:s e')
                ->end()
            ->end();
        return $treeBuilder;
    }
}
