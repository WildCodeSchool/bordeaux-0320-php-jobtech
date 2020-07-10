<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706131833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE questionnaire (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, ability_id INT NOT NULL, score INT NOT NULL, posted_at DATETIME NOT NULL, INDEX IDX_7A64DAF91BD8781 (candidate_id), INDEX IDX_7A64DAF8016D8B2 (ability_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE questionnaire');
    }
}
