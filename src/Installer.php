<?php

declare(strict_types=1);

namespace Avarel\AttributeInstaller;

use Doctrine\Common\Cache\ClearableCache;
use Exception;
use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Shopware\Components\Model\ModelManager;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Installer
 *
 * @author André Varelmann <dev@andre-varelmann.de>
 * @package Avarel\AttributeInstaller\Installer
 */
class Installer
{
    /**
     * The attribute crud service
     *
     * @var CrudService
     */
    private $crudService;

    /**
     * The shopware model manager
     *
     * @var ModelManager
     */
    private $modelManager;

    /**
     * Console output
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * AttributeInstaller constructor.
     *
     * @param CrudService $crudService
     * @param ModelManager $modelManager
     */
    public function __construct(CrudService $crudService, ModelManager $modelManager)
    {
        $this->crudService = $crudService;
        $this->modelManager = $modelManager;
        $this->output = new NullOutput();
    }

    /**
     * Setter for output
     *
     * @param OutputInterface $output
     *
     * @return void
     */
    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    /**
     * Install or update attributes
     *
     * @param array $attributeDefinition
     *
     * @throws Exception When install fails
     *
     * @return void
     */
    public function install(array $attributeDefinitions): void
    {
        foreach ($attributeDefinitions as $attributeDefinition) {
            $this->output
                ->writeln('Installing: ' . $attributeDefinition['table'] . ' - ' . $attributeDefinition['column']);

            $this->crudService->update(
                $attributeDefinition['table'],
                $attributeDefinition['column'],
                $attributeDefinition['type'],
                $attributeDefinition['data'] ?? [],
                $attributeDefinition['newColumn'] ?? null,
                $attributeDefinition['updateDependingTables'] ?? false,
                $attributeDefinition['defaultValue'] ?? null
            );
        }

        $this->rebuildAttributeModels($attributeDefinitions);
    }

    /**
     * Rebuilds the attribute models after attribute create - update - delete.
     *
     * @param array $attributeDefinitions
     *
     * @return void
     */
    private function rebuildAttributeModels(array $attributeDefinitions): void
    {
        $attributeTables = array_unique(array_column($attributeDefinitions, 'table'));

        $metaDataCache = $this->modelManager->getConfiguration()->getMetadataCacheImpl();
        assert($metaDataCache instanceof ClearableCache);

        $metaDataCache->deleteAll();

        $this->modelManager->generateAttributeModels($attributeTables);
    }
}
