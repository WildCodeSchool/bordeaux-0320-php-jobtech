<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602144444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_information CHANGE is_handicaped is_handicaped TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_contactable_tel is_contactable_tel TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_contactable_email is_contactable_email TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_information CHANGE is_handicaped is_handicaped TINYINT(1) NOT NULL, CHANGE is_contactable_tel is_contactable_tel TINYINT(1) NOT NULL, CHANGE is_contactable_email is_contactable_email TINYINT(1) NOT NULL');
    }
}
