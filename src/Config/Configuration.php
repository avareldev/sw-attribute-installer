<?php

declare(strict_types=1);

namespace Avarel\AttributeInstaller\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author André Varelmann <ev@andre-varelmann.de>
 * @package Avarel\AttributeInstaller\Config
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('attributes');

        $rootNode
            ->useAttributeAsKey('name')
            ->arrayPrototype()
                ->useAttributeAsKey('name')
                ->arrayPrototype()
                    ->children()
                        ->enumNode('type')
                            ->cannotBeEmpty()
                            ->values([
                                'string',
                                'text',
                                'html',
                                'integer',
                                'float',
                                'boolean',
                                'date',
                                'datetime',
                                'combobox',
                                'single_selection',
                                'multi_selection',
                            ])
                        ->end()
                        ->scalarNode('type')->cannotBeEmpty()->isRequired()->end()
                        ->booleanNode('displayInBackend')->isRequired()->end()
                        ->scalarNode('label')->end()
                        ->scalarNode('entity')->end()
                        ->scalarNode('newColumn')->end()
                        ->scalarNode('updateDependingTables')->end()
                        ->scalarNode('defaultValue')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
