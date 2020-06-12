<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605141327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE news CHANGE created_on created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE created_on created_at DATETIME NOT NULL, CHANGE updated_on updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE created_on created_at DATETIME NOT NULL, CHANGE updated_on updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE news CHANGE created_at created_on DATETIME NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE created_at created_on DATETIME NOT NULL, CHANGE updated_at updated_on DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE created_at created_on DATETIME NOT NULL, CHANGE updated_at updated_on DATETIME DEFAULT NULL');
    }
}
