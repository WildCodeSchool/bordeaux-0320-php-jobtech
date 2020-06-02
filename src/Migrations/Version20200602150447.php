<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602150447 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer CHANGE contract_id contract_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE email email VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE current_situation CHANGE is_pole_emploi is_pole_emploi TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_interim is_interim TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_unemployed is_unemployed TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE mobility CHANGE is_international is_international TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_national is_national TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact CHANGE email email VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE current_situation CHANGE is_pole_emploi is_pole_emploi TINYINT(1) NOT NULL, CHANGE is_interim is_interim TINYINT(1) NOT NULL, CHANGE is_unemployed is_unemployed TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE mobility CHANGE is_international is_international TINYINT(1) DEFAULT NULL, CHANGE is_national is_national TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE offer CHANGE contract_id contract_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
