<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117165446 extends AbstractMigration
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
        $this->addSql('ALTER TABLE calendar ADD monday_id INT DEFAULT NULL, ADD tuesday_id INT DEFAULT NULL, ADD wednesday_id INT DEFAULT NULL, ADD thursday_id INT DEFAULT NULL, ADD friday_id INT DEFAULT NULL, ADD saturday_id INT DEFAULT NULL, ADD sunday_id INT DEFAULT NULL, DROP monday, DROP tuesday, DROP wednesday, DROP thursday, DROP friday, DROP saturday, DROP sunday');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A14621671777 FOREIGN KEY (monday_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1465B974FE2 FOREIGN KEY (tuesday_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146BBA2EEBE FOREIGN KEY (wednesday_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146D68DEE5D FOREIGN KEY (thursday_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146812B93DE FOREIGN KEY (friday_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146B86AC6FA FOREIGN KEY (saturday_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146A81EA377 FOREIGN KEY (sunday_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_6EA9A14621671777 ON calendar (monday_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A1465B974FE2 ON calendar (tuesday_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146BBA2EEBE ON calendar (wednesday_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146D68DEE5D ON calendar (thursday_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146812B93DE ON calendar (friday_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146B86AC6FA ON calendar (saturday_id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146A81EA377 ON calendar (sunday_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A14621671777');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1465B974FE2');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146BBA2EEBE');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146D68DEE5D');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146812B93DE');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146B86AC6FA');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146A81EA377');
        $this->addSql('DROP INDEX IDX_6EA9A14621671777 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A1465B974FE2 ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A146BBA2EEBE ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A146D68DEE5D ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A146812B93DE ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A146B86AC6FA ON calendar');
        $this->addSql('DROP INDEX IDX_6EA9A146A81EA377 ON calendar');
        $this->addSql('ALTER TABLE calendar ADD monday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD tuesday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD wednesday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD thursday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD friday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD saturday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD sunday VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP monday_id, DROP tuesday_id, DROP wednesday_id, DROP thursday_id, DROP friday_id, DROP saturday_id, DROP sunday_id');
    }
}
