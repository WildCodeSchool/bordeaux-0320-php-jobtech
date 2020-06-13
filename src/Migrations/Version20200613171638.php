<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613171638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E1BE86975');
        $this->addSql('DROP INDEX IDX_29D6873E1BE86975 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE durationwork_id duration_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E37B987D8 FOREIGN KEY (duration_id) REFERENCES duration_work_time (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E37B987D8 ON offer (duration_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E37B987D8');
        $this->addSql('DROP INDEX IDX_29D6873E37B987D8 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE duration_id durationwork_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E1BE86975 FOREIGN KEY (durationwork_id) REFERENCES duration_work_time (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29D6873E1BE86975 ON offer (durationwork_id)');
    }
}
