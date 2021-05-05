<?php

namespace App;

use EasyCorp\Bundle\EasyDeployBundle\Configuration\DefaultConfiguration;
use EasyCorp\Bundle\EasyDeployBundle\Configuration\Option;
use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;
use JetBrains\PhpStorm\Pure;

class Deployer extends DefaultDeployer
{
    protected string $remotePhpBinaryPath = '/usr/bin/php';
    protected string $repositoryUrl = 'git@github.com:EugenGanshorn/foodtruck.git';
    protected string $username = 'hosting154641';
    protected string $hostname = '';
    protected bool $ssl = true;

    /**
     * @var string[]
     */
    protected array $sharedFilesAndDirs = [
        '.env',
        '.env.local',
        'var/log',
        'public/images',
    ];

    /**
     * @var string[]
     */
    protected array $servers = [
        'hosting154641.a2edf.netcup.net',
    ];

    public function configure(): DefaultConfiguration
    {
        return $this->getConfigBuilder()
            ->server(sprintf('%s@%s', $this->username, $this->servers[array_rand($this->servers)]))
            ->deployDir(sprintf('/%s', $this->hostname))
            ->repositoryUrl($this->repositoryUrl)
            ->repositoryBranch('master')
            ->sharedFilesAndDirs($this->sharedFilesAndDirs)
            ->remotePhpBinaryPath($this->remotePhpBinaryPath)
            ->remoteComposerBinaryPath(sprintf('%s /composer.phar', $this->remotePhpBinaryPath))
            ->composerInstallFlags('--no-dev --prefer-dist --no-interaction --ignore-platform-reqs')
            ->installWebAssets(true)
        ;
    }

    public function beforePreparing(): void
    {
        $this->runRemote('cp -RPp app/* ./ && rm -rf app');
    }

    public function beforeFinishingDeploy(): void
    {
        $this->doNetcupSpecials();

        $this->log('Run migrations');
        $this->runRemote('{{ console_bin }} doctrine:migrations:migrate -q');
    }

    protected function doNetcupSpecials(): void
    {
        $this->log('<h2>Creating symlinks for shared directories</>');
        foreach ($this->getConfig(Option::sharedDirs) as $sharedDir) {
            $this->runRemote(sprintf('mkdir -p {{ deploy_dir }}/shared/%s', $sharedDir));
            $this->runRemote(sprintf('if [ -d {{ project_dir }}/%s ] ; then rm -rf {{ project_dir }}/%s; fi', $sharedDir, $sharedDir));

            $path = str_repeat('../', substr_count(rtrim($sharedDir, '/'), '/'));
            $this->runRemote(sprintf('ln -nfs %s../../shared/%s {{ project_dir }}/%s', $path, $sharedDir, $sharedDir));
        }

        $this->log('<h2>Creating symlinks for shared files</>');
        foreach ($this->getConfig(Option::sharedFiles) as $sharedFile) {
            $sharedFileParentDir = dirname($sharedFile);
            $this->runRemote(sprintf('mkdir -p {{ deploy_dir }}/shared/%s', $sharedFileParentDir));
            $this->runRemote(sprintf('touch {{ deploy_dir }}/shared/%s', $sharedFile));

            $path = str_repeat('../', substr_count(rtrim($sharedFile, '/'), '/'));
            $this->runRemote(sprintf('ln -nfs %s../../shared/%s {{ project_dir }}/%s', $path, $sharedFile, $sharedFile));
        }

        $this->log('<h2>Updating the symlink</>');
        $this->runRemote('rm -f {{ deploy_dir }}/current && ln -s $(echo "{{ project_dir }}" | sed "s#{{ deploy_dir }}/##") {{ deploy_dir }}/current');

        $this->log('<h2>Installing web assets</>');
        $this->runRemote(sprintf('{{ console_bin }} assets:install {{ web_dir }} --no-debug --env=%s', $this->getConfig(Option::symfonyEnvironment)));
    }

    protected function getProtocol(): string
    {
        return $this->ssl ? 'https' : 'http';
    }

    protected function getPort(): int
    {
        return $this->ssl ? 443 : 80;
    }

    #[Pure] protected function getUrl(): string
    {
        return sprintf('%s://%s', $this->getProtocol(), $this->hostname);
    }
}
