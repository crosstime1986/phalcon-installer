<?php

namespace Quan\Composer;

use Composer\Composer;
use Composer\Installer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $manager = $composer->getInstallationManager();

        //框架核心
        $manager->addInstaller(new QuanFramework($io, $composer));

        //扩展
        $manager->addInstaller(new QuanExtend($io, $composer));

    }
}