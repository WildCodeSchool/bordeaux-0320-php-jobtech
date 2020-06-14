<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614023039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer ADD job_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E712A86AB ON offer (job_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E712A86AB');
        $this->addSql('DROP INDEX IDX_29D6873E712A86AB ON offer');
        $this->addSql('ALTER TABLE offer DROP job_category_id');
    }
}
