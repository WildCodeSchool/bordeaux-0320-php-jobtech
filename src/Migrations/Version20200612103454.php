<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612103454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job_have_category (job_id INT NOT NULL, job_category_id INT NOT NULL, INDEX IDX_AC712E91BE04EA9 (job_id), INDEX IDX_AC712E91712A86AB (job_category_id), PRIMARY KEY(job_id, job_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_have_category ADD CONSTRAINT FK_AC712E91BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_have_category ADD CONSTRAINT FK_AC712E91712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8712A86AB');
        $this->addSql('DROP INDEX IDX_FBD8E0F8712A86AB ON job');
        $this->addSql('ALTER TABLE job DROP job_category_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE job_have_category');
        $this->addSql('ALTER TABLE job ADD job_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8712A86AB ON job (job_category_id)');
    }
}
