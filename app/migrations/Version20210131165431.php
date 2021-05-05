<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131165431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function isTransactional(): bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, ADD created_from_ip VARCHAR(45) DEFAULT NULL, ADD updated_from_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE day ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, ADD created_from_ip VARCHAR(45) DEFAULT NULL, ADD updated_from_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, ADD created_from_ip VARCHAR(45) DEFAULT NULL, ADD updated_from_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE location ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, ADD created_from_ip VARCHAR(45) DEFAULT NULL, ADD updated_from_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, ADD created_from_ip VARCHAR(45) DEFAULT NULL, ADD updated_from_ip VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD created_by VARCHAR(255) DEFAULT NULL, ADD updated_by VARCHAR(255) DEFAULT NULL, ADD created_from_ip VARCHAR(45) DEFAULT NULL, ADD updated_from_ip VARCHAR(45) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP created_at, DROP updated_at, DROP created_by, DROP updated_by, DROP created_from_ip, DROP updated_from_ip');
        $this->addSql('ALTER TABLE day DROP created_at, DROP updated_at, DROP created_by, DROP updated_by, DROP created_from_ip, DROP updated_from_ip');
        $this->addSql('ALTER TABLE event DROP created_at, DROP updated_at, DROP created_by, DROP updated_by, DROP created_from_ip, DROP updated_from_ip');
        $this->addSql('ALTER TABLE location DROP created_at, DROP updated_at, DROP created_by, DROP updated_by, DROP created_from_ip, DROP updated_from_ip');
        $this->addSql('ALTER TABLE tag DROP created_at, DROP updated_at, DROP created_by, DROP updated_by, DROP created_from_ip, DROP updated_from_ip');
        $this->addSql('ALTER TABLE `user` DROP created_at, DROP updated_at, DROP created_by, DROP updated_by, DROP created_from_ip, DROP updated_from_ip');
    }
}
