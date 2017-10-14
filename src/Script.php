<?php

namespace Quan\Composer;

use Composer\Composer;
use Composer\Installer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;

class Script
{
    public static function run(Event $event)
    {
        $composer = $event->getComposer();

        $package = $composer->getPackage()->getPrettyName();
        var_dump($package);
    }
}