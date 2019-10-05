<?php

declare(strict_types=1);

namespace Avarel\AttributeInstaller\Config;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigurationReader
 *
 * @author André Varelmann <andre.varelmann@bestit-online.de>
 * @package Avarel\Config
 */
class ConfigurationReader
{
    /**
     * Read and validate configuration
     *
     * @param string $filePath Path to config file
     *
     * @return array Validated and normalized values
     */
    public function read(string $filePath): array
    {
        $rawConfig = Yaml::parse(file_get_contents($filePath));

        $compiledConfig = [];
        $processor = new Processor();
        $configuration = new Configuration();

        return $this->normalize($processor->processConfiguration($configuration, $rawConfig));
    }

    /**
     * Normalize the config to a crud service readable format
     *
     * @param array $config
     *
     * @return array
     */
    private function normalize(array $config): array
    {
        $normalized = [];

        foreach ($config as $table => $definitions) {
            $position = 3;

            foreach ($definitions as $fieldName => $definition) {
                $normalizedDefinition = [
                    'table' => $table,
                    'column' => $fieldName,
                    'type' => $definition['type'],
                    'newColumn' => $definition['newColumn'] ?? null,
                    'updateDependingTables' => $definition['updateDependingTables'] ?? null,
                    'defaultValue' => $definition['defaultValue'] ?? null
                ];

                if (isset($definition['label'])) {
                    $normalizedDefinition['data']['label'] = $definition['label'];
                }

                if (isset($definition['displayInBackend'])) {
                    $normalizedDefinition['data']['displayInBackend'] = $definition['displayInBackend'];
                }

                if (isset($definition['entity'])) {
                    $normalizedDefinition['data']['entity'] = $definition['entity'];
                }

                if (isset($normalizedDefinition['data'])) {
                    $normalizedDefinition['data']['position'] = ++$position;
                }

                $normalized[] = $normalizedDefinition;
            }
        }

        return $normalized;
    }
}
