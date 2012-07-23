<?php

namespace FSC\EmailFilterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fsc_email_filter');

        $rootNode
            ->children()
                ->scalarNode('file')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
