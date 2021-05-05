<?php

use App\Deployer;

return new class extends Deployer
{
    protected string $hostname = 'staging.find-a-lunch.de';

    public function beforeFinishingDeploy(): void
    {
        $this->log('Drop old Database');
        $this->runRemote('{{ console_bin }} doctrine:database:drop --force');

        $this->log('Create new Database');
        $this->runRemote('{{ console_bin }} doctrine:database:create');

        parent::beforeFinishingDeploy();

        $this->log('Load Fixtures');
        $this->runRemote('{{ console_bin }} doctrine:fixtures:load -q');
    }
};
