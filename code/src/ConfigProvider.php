<?php

declare(strict_types=1);

namespace AssetGrabber;

use AssetGrabber\Commands\InternalPluginDownloadCommand;
use AssetGrabber\Commands\InternalThemeDownloadCommand;
use AssetGrabber\Commands\PluginsGrabCommand;
use AssetGrabber\Commands\PluginsImportMetaCommand;
use AssetGrabber\Commands\PluginsMetaCommand;
use AssetGrabber\Commands\PluginsPartialCommand;
use AssetGrabber\Commands\PluginsPullLatestRevCommand;
use AssetGrabber\Commands\ThemesGrabCommand;
use AssetGrabber\Commands\ThemesPartialCommand;
use AssetGrabber\Commands\ThemesPullLatestRevCommand;
use AssetGrabber\Commands\UtilCleanDataCommand;
use AssetGrabber\Factories\ExtendedPdoFactory;
use AssetGrabber\Factories\GenericServiceFactory;
use AssetGrabber\Factories\InternalPluginDownloadCommandFactory;
use AssetGrabber\Factories\InternalThemeDownloadCommandFactory;
use AssetGrabber\Factories\PluginListServiceFactory;
use AssetGrabber\Factories\PluginMetadataServiceFactory;
use AssetGrabber\Factories\PluginsGrabCommandFactory;
use AssetGrabber\Factories\PluginsImportMetaCommandFactory;
use AssetGrabber\Factories\PluginsMetaCommandFactory;
use AssetGrabber\Factories\PluginsPartialCommandFactory;
use AssetGrabber\Factories\PluginsPullLatestRevCommandFactory;
use AssetGrabber\Factories\RevisionMetadataServiceFactory;
use AssetGrabber\Factories\ThemesGrabCommandFactory;
use AssetGrabber\Factories\ThemesPartialCommandFactory;
use AssetGrabber\Factories\ThemesPullLatestRevCommandFactory;
use AssetGrabber\Services\PluginDownloadService;
use AssetGrabber\Services\PluginListService;
use AssetGrabber\Services\PluginMetadataService;
use AssetGrabber\Services\RevisionMetadataService;
use AssetGrabber\Services\ThemeDownloadService;
use AssetGrabber\Services\ThemeListService;
use Aura\Sql\ExtendedPdoInterface;

class ConfigProvider
{
    /**
     * @return array<string, array<string, string[]>>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * @return array<string, string[]>
     */
    private function getDependencies(): array
    {
        return [
            'invokables' => [
                UtilCleanDataCommand::class => UtilCleanDataCommand::class,
            ],
            'factories'  => [
                // Services
                PluginDownloadService::class   => GenericServiceFactory::class,
                PluginListService::class       => PluginListServiceFactory::class,
                ThemeListService::class        => GenericServiceFactory::class,
                ThemeDownloadService::class    => GenericServiceFactory::class,
                ExtendedPdoInterface::class    => ExtendedPdoFactory::class,
                PluginMetadataService::class   => PluginMetadataServiceFactory::class,
                RevisionMetadataService::class => RevisionMetadataServiceFactory::class,

                // Commands
                PluginsGrabCommand::class            => PluginsGrabCommandFactory::class,
                PluginsPullLatestRevCommand::class   => PluginsPullLatestRevCommandFactory::class,
                ThemesGrabCommand::class             => ThemesGrabCommandFactory::class,
                InternalThemeDownloadCommand::class  => InternalThemeDownloadCommandFactory::class,
                InternalPluginDownloadCommand::class => InternalPluginDownloadCommandFactory::class,
                PluginsPartialCommand::class         => PluginsPartialCommandFactory::class,
                ThemesPartialCommand::class          => ThemesPartialCommandFactory::class,
                ThemesPullLatestRevCommand::class    => ThemesPullLatestRevCommandFactory::class,
                PluginsMetaCommand::class            => PluginsMetaCommandFactory::class,
                PluginsImportMetaCommand::class      => PluginsImportMetaCommandFactory::class,
            ],
        ];
    }
}
