<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617080657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, acronym VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD gender_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638708A0E0 ON contact (gender_id)');
        $this->addSql('ALTER TABLE candidate ADD gender_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_C8B28E44708A0E0 ON candidate (gender_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638708A0E0');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44708A0E0');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP INDEX IDX_C8B28E44708A0E0 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP gender_id');
        $this->addSql('DROP INDEX IDX_4C62E638708A0E0 ON contact');
        $this->addSql('ALTER TABLE contact DROP gender_id');
    }
}
