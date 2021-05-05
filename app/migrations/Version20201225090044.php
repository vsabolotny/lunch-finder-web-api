<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201225090044 extends AbstractMigration
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
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, from_date DATETIME NOT NULL, to_date DATETIME NOT NULL, INDEX IDX_3BAE0AA764D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_foodtruck (event_id INT NOT NULL, foodtruck_id INT NOT NULL, INDEX IDX_A35B15FD71F7E88B (event_id), INDEX IDX_A35B15FDFD42418B (foodtruck_id), PRIMARY KEY(event_id, foodtruck_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE foodtruck (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE foodtruck_tag (foodtruck_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_12CAC7F9FD42418B (foodtruck_id), INDEX IDX_12CAC7F9BAD26311 (tag_id), PRIMARY KEY(foodtruck_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, house_number VARCHAR(255) NOT NULL, postcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA764D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE event_foodtruck ADD CONSTRAINT FK_A35B15FD71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_foodtruck ADD CONSTRAINT FK_A35B15FDFD42418B FOREIGN KEY (foodtruck_id) REFERENCES foodtruck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE foodtruck_tag ADD CONSTRAINT FK_12CAC7F9FD42418B FOREIGN KEY (foodtruck_id) REFERENCES foodtruck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE foodtruck_tag ADD CONSTRAINT FK_12CAC7F9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_foodtruck DROP FOREIGN KEY FK_A35B15FD71F7E88B');
        $this->addSql('ALTER TABLE event_foodtruck DROP FOREIGN KEY FK_A35B15FDFD42418B');
        $this->addSql('ALTER TABLE foodtruck_tag DROP FOREIGN KEY FK_12CAC7F9FD42418B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA764D218E');
        $this->addSql('ALTER TABLE foodtruck_tag DROP FOREIGN KEY FK_12CAC7F9BAD26311');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_foodtruck');
        $this->addSql('DROP TABLE foodtruck');
        $this->addSql('DROP TABLE foodtruck_tag');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE tag');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles BLOB NOT NULL');
    }
}
