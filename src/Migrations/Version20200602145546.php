<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602145546 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D699D5B92F9');
        $this->addSql('ALTER TABLE current_situation DROP FOREIGN KEY FK_370B2B66FDEF8996');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EFDEF8996');
        $this->addSql('ALTER TABLE search_profession DROP FOREIGN KEY FK_62253DA3FDEF8996');
        $this->addSql('CREATE TABLE search_job (search_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_3F639447650760A9 (search_id), INDEX IDX_3F639447BE04EA9 (job_id), PRIMARY KEY(search_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, job_category_id INT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, INDEX IDX_FBD8E0F8712A86AB (job_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE search_job ADD CONSTRAINT FK_3F639447650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_job ADD CONSTRAINT FK_3F639447BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('DROP TABLE expertise');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE search_profession');
        $this->addSql('ALTER TABLE user_information CHANGE have_vehicle have_vehicle TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('DROP INDEX IDX_29D6873EFDEF8996 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE profession_id job_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_29D6873EBE04EA9 ON offer (job_id)');
        $this->addSql('DROP INDEX IDX_370B2B66FDEF8996 ON current_situation');
        $this->addSql('ALTER TABLE current_situation CHANGE profession_id job_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE current_situation ADD CONSTRAINT FK_370B2B66BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_370B2B66BE04EA9 ON current_situation (job_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8712A86AB');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EBE04EA9');
        $this->addSql('ALTER TABLE search_job DROP FOREIGN KEY FK_3F639447BE04EA9');
        $this->addSql('ALTER TABLE current_situation DROP FOREIGN KEY FK_370B2B66BE04EA9');
        $this->addSql('CREATE TABLE expertise (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, identifier VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, expertise_id INT DEFAULT NULL, title VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, identifier VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BA930D699D5B92F9 (expertise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE search_profession (search_id INT NOT NULL, profession_id INT NOT NULL, INDEX IDX_62253DA3650760A9 (search_id), INDEX IDX_62253DA3FDEF8996 (profession_id), PRIMARY KEY(search_id, profession_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D699D5B92F9 FOREIGN KEY (expertise_id) REFERENCES expertise (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE search_profession ADD CONSTRAINT FK_62253DA3650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_profession ADD CONSTRAINT FK_62253DA3FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE search_job');
        $this->addSql('DROP TABLE job_category');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP INDEX IDX_370B2B66BE04EA9 ON current_situation');
        $this->addSql('ALTER TABLE current_situation CHANGE job_id profession_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE current_situation ADD CONSTRAINT FK_370B2B66FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_370B2B66FDEF8996 ON current_situation (profession_id)');
        $this->addSql('DROP INDEX IDX_29D6873EBE04EA9 ON offer');
        $this->addSql('ALTER TABLE offer CHANGE job_id profession_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EFDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29D6873EFDEF8996 ON offer (profession_id)');
        $this->addSql('ALTER TABLE user_information CHANGE have_vehicle have_vehicle TINYINT(1) DEFAULT NULL');
    }
}
