<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124155443 extends AbstractMigration
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
        $this->addSql('DROP TABLE event_foodtruck');
        $this->addSql('ALTER TABLE event ADD foodtruck_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7FD42418B FOREIGN KEY (foodtruck_id) REFERENCES foodtruck (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7FD42418B ON event (foodtruck_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_foodtruck (event_id INT NOT NULL, foodtruck_id INT NOT NULL, INDEX IDX_A35B15FDFD42418B (foodtruck_id), INDEX IDX_A35B15FD71F7E88B (event_id), PRIMARY KEY(event_id, foodtruck_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_foodtruck ADD CONSTRAINT FK_A35B15FD71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_foodtruck ADD CONSTRAINT FK_A35B15FDFD42418B FOREIGN KEY (foodtruck_id) REFERENCES foodtruck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7FD42418B');
        $this->addSql('DROP INDEX IDX_3BAE0AA7FD42418B ON event');
        $this->addSql('ALTER TABLE event DROP foodtruck_id');
    }
}
