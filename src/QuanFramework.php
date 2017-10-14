<?php

namespace Quan\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

class QuanFramework extends LibraryInstaller
{
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        echo "安装框架....";
        parent::install($repo, $package);
        if ($this->composer->getPackage()->getType() == 'project' && $package->getInstallationSource() != 'source') {
            //remove tests dir
            $this->filesystem->removeDirectory($this->getInstallPath($package) . DIRECTORY_SEPARATOR . 'tests');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        if ('zhengyou/phalcon-framework' !== $package->getPrettyName()) {
            throw new \InvalidArgumentException('Unable to install this library!');
        }

        if ($this->composer->getPackage()->getType() !== 'project') {
            return parent::getInstallPath($package);
        }

        if ($this->composer->getPackage()) {
            $extra = $this->composer->getPackage()->getExtra();
            if (!empty($extra['quan-path'])) {
                return $extra['quan-path'];
            }
        }

        return 'system';
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        parent::update($repo, $initial, $target);
        if ($this->composer->getPackage()->getType() == 'project' && $target->getInstallationSource() != 'source') {
            //remove tests dir
            $this->filesystem->removeDirectory($this->getInstallPath($target) . DIRECTORY_SEPARATOR . 'tests');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'zhengyou/phalcon-framework' === $packageType;
    }
}