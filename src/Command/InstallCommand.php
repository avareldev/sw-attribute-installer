<?php

declare(strict_types=1);

namespace Avarel\AttributeInstaller\Command;

use Avarel\AttributeInstaller\Installer;
use Avarel\AttributeInstaller\Config\ConfigurationReader;
use Exception;
use Shopware\Commands\ShopwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author André Varelmann <ev@andre-varelmann.de>
 * @package Avarel\AttributeInstaller\Command
 */
class InstallCommand extends ShopwareCommand
{
    /**
     * @var ConfigurationReader
     */
    private $configurationReader;

    /**
     * @var Installer
     */
    private $installer;

    /**
     * @param ConfigurationReader $configurationReader
     */
    public function __construct(ConfigurationReader $configurationReader, Installer $installer)
    {
        $this->configurationReader = $configurationReader;
        $this->installer = $installer;

        parent::__construct();
    }

    /**
     * @return void
     */
    public function configure(): void
    {
        $this
            ->setName('avarel:attributes:install')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to attributes definitions.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws Exception
     *
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('file');
        $attributeDefinitions = $this->configurationReader->read($filePath);

        $this->installer->setOutput($output);
        $this->installer->install($attributeDefinitions);

        return 0;
    }
}
