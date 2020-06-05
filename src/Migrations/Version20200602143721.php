<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602143721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_information CHANGE postal_code postal_code INT NOT NULL, CHANGE city city VARCHAR(60) NOT NULL, CHANGE country country VARCHAR(60) NOT NULL, CHANGE is_handicaped is_handicaped TINYINT(1) NOT NULL, CHANGE is_contactable_tel is_contactable_tel TINYINT(1) NOT NULL, CHANGE is_contactable_email is_contactable_email TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_qualification DROP FOREIGN KEY FK_599C5D9E4575EE58');
        $this->addSql('ALTER TABLE user_qualification ADD CONSTRAINT FK_599C5D9E4575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_information CHANGE postal_code postal_code INT DEFAULT NULL, CHANGE city city VARCHAR(60) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(60) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE is_handicaped is_handicaped TINYINT(1) DEFAULT NULL, CHANGE is_contactable_tel is_contactable_tel TINYINT(1) DEFAULT NULL, CHANGE is_contactable_email is_contactable_email TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_qualification DROP FOREIGN KEY FK_599C5D9E4575EE58');
        $this->addSql('ALTER TABLE user_qualification ADD CONSTRAINT FK_599C5D9E4575EE58 FOREIGN KEY (user_information_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
