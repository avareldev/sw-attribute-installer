<?php

declare(strict_types=1);

namespace Avarel\AttributeInstaller;

use Doctrine\Common\Cache\ClearableCache;
use Exception;
use Shopware\Components\Model\ModelManager;

/**
 * Class Installer
 *
 * @author André Varelmann <andre.varelmann@bestit-online.de>
 * @package Avarel\Installer
 */
class Installer
{
//    /**
//     * Attribute definition class names
//     */
//    private const ATTRIBUTE_DEFINITIONS = [
//        Article::class,
//        Category::class,
//        Emotion::class
//    ];
//
//    /**
//     * Attribute definitions to install
//     *
//     * @var array[]
//     */
//    public $attributeDefinitions = [];
//
//    /**
//     * The attribute crud service
//     *
//     * @var CrudService
//     */
//    private $crudService;
//
//    /**
//     * The shopware model manager
//     *
//     * @var ModelManager
//     */
//    private $modelManager;
//
//    /**
//     * Console output
//     *
//     * @var OutputInterface
//     */
//    private $output;
//
//    /**
//     * AttributeInstaller constructor.
//     *
//     * @param CrudService $crudService
//     * @param ModelManager $modelManager
//     */
//    public function __construct(CrudService $crudService, ModelManager $modelManager)
//    {
//        $this->crudService = $crudService;
//        $this->modelManager = $modelManager;
//        $this->output = new NullOutput();
//    }
//
//    /**
//     * Setter for output
//     *
//     * @param OutputInterface $output
//     *
//     * @return void
//     */
//    public function setOutput(OutputInterface $output): void
//    {
//        $this->output = $output;
//    }
//
//    /**
//     * Install or update attributes
//     *
//     * @throws Exception When install fails
//     *
//     * @return void
//     */
//    public function install(): void
//    {
//        foreach ($this->getAttributeDefinitions() as $attributeDefinition) {
//            $this->output
//                ->writeln('Installing: ' . $attributeDefinition['table'] . ' - ' . $attributeDefinition['column']);
//
//            $this->crudService->update(
//                $attributeDefinition['table'],
//                $attributeDefinition['column'],
//                $attributeDefinition['type'],
//                $attributeDefinition['data'] ?? [],
//                $attributeDefinition['newColumn'] ?? null,
//                $attributeDefinition['updateDependingTables'] ?? false,
//                $attributeDefinition['defaultValue'] ?? null
//            );
//        }
//
//        $this->rebuildAttributeModels();
//    }
//
//    /**
//     * Load attribute definitions
//     *
//     * @return array
//     */
//    private function getAttributeDefinitions(): array
//    {
//        if (!count($this->attributeDefinitions)) {
//            $this->attributeDefinitions = $this->loadAttributeDefinitions();
//        }
//
//        return $this->attributeDefinitions;
//    }
//
//    /**
//     * Load Attribute definitions from definition classes
//     *
//     * @return array
//     */
//    private function loadAttributeDefinitions(): array
//    {
//        $attributeDefinitions = [];
//
//        foreach (self::ATTRIBUTE_DEFINITIONS as $attributeDefinitionClass) {
//            if (!class_exists($attributeDefinitionClass)) {
//                continue;
//            }
//
//            $attributeDefinition = new $attributeDefinitionClass();
//
//            if (!$attributeDefinition instanceof AttributeDefinitionsInterface) {
//                continue;
//            }
//
//            $attributeDefinitions =
//                array_merge($attributeDefinitions, $attributeDefinition->getAttributeDefinitions());
//        }
//
//        return $attributeDefinitions;
//    }
//
//    /**
//     * Rebuilds the attribute models after attribute create - update - delete.
//     *
//     * @return void
//     */
//    private function rebuildAttributeModels(): void
//    {
//        $attributeTables = array_unique(array_column($this->getAttributeDefinitions(), 'table'));
//
//        $metaDataCache = $this->modelManager->getConfiguration()->getMetadataCacheImpl();
//        assert($metaDataCache instanceof ClearableCache);
//
//        $metaDataCache->deleteAll();
//
//        $this->modelManager->generateAttributeModels($attributeTables);
//    }
}
