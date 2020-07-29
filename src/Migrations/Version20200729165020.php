<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200729165020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(80) NOT NULL, description LONGTEXT NOT NULL, is_external TINYINT(1) DEFAULT \'0\' NOT NULL, url LONGTEXT DEFAULT NULL, article LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, posted_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, document VARCHAR(255) NOT NULL, INDEX IDX_D8698A76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, job VARCHAR(255) NOT NULL, years INT NOT NULL, INDEX IDX_590C10391BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, job_id INT NOT NULL, job_category_id INT NOT NULL, work_time_id INT NOT NULL, title VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, detail LONGTEXT NOT NULL, available_place INT NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, posted_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_29D6873E979B1AD6 (company_id), INDEX IDX_29D6873EBE04EA9 (job_id), INDEX IDX_29D6873E712A86AB (job_category_id), INDEX IDX_29D6873E8B216519 (work_time_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_has_contracts (offer_id INT NOT NULL, contract_id INT NOT NULL, INDEX IDX_74A1683753C674EE (offer_id), INDEX IDX_74A168372576E0FD (contract_id), PRIMARY KEY(offer_id, contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_time (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, ability_id INT NOT NULL, score INT NOT NULL, posted_at DATETIME NOT NULL, INDEX IDX_7A64DAF91BD8781 (candidate_id), INDEX IDX_7A64DAF8016D8B2 (ability_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, ability_id INT NOT NULL, question VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E8016D8B2 (ability_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radius (id INT AUTO_INCREMENT NOT NULL, radius INT NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apply (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, offer_id INT NOT NULL, apply_at DATETIME NOT NULL, INDEX IDX_BD2F8C1FA76ED395 (user_id), INDEX IDX_BD2F8C1F53C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, candidate_id INT DEFAULT NULL, email VARCHAR(80) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649979B1AD6 (company_id), UNIQUE INDEX UNIQ_8D93D64991BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, html LONGTEXT DEFAULT NULL, identifier VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_5E3DE47791BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, job_id INT NOT NULL, job_category_id INT NOT NULL, UNIQUE INDEX UNIQ_B4F0DBA791BD8781 (candidate_id), INDEX IDX_B4F0DBA7BE04EA9 (job_id), INDEX IDX_B4F0DBA7712A86AB (job_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_has_contracts (search_id INT NOT NULL, contract_id INT NOT NULL, INDEX IDX_49890838650760A9 (search_id), INDEX IDX_498908382576E0FD (contract_id), PRIMARY KEY(search_id, contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, gender_id INT NOT NULL, company_id INT NOT NULL, surname VARCHAR(45) NOT NULL, first_name VARCHAR(45) NOT NULL, email VARCHAR(80) NOT NULL, job VARCHAR(100) NOT NULL, phone_number VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_4C62E638E7927C74 (email), INDEX IDX_4C62E638708A0E0 (gender_id), INDEX IDX_4C62E638979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, icon VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, gender_id INT NOT NULL, curriculum_vitae_id INT DEFAULT NULL, surname VARCHAR(45) NOT NULL, first_name VARCHAR(45) NOT NULL, birthday DATE NOT NULL, phone_number VARCHAR(20) NOT NULL, other_number VARCHAR(20) DEFAULT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, is_handicapped TINYINT(1) DEFAULT \'0\' NOT NULL, is_contactable_tel TINYINT(1) DEFAULT \'0\' NOT NULL, is_contactable_email TINYINT(1) DEFAULT \'1\' NOT NULL, have_vehicle TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_C8B28E44708A0E0 (gender_id), UNIQUE INDEX UNIQ_C8B28E444AF29A35 (curriculum_vitae_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookmark (candidate_id INT NOT NULL, offer_id INT NOT NULL, INDEX IDX_DA62921D91BD8781 (candidate_id), INDEX IDX_DA62921D53C674EE (offer_id), PRIMARY KEY(candidate_id, offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_has_licenses (candidate_id INT NOT NULL, license_id INT NOT NULL, INDEX IDX_AC42597691BD8781 (candidate_id), INDEX IDX_AC425976460F904B (license_id), PRIMARY KEY(candidate_id, license_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, siret VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curriculum_vitae (id INT AUTO_INCREMENT NOT NULL, cv_name VARCHAR(255) NOT NULL, cv_size INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_has_categories (job_id INT NOT NULL, job_category_id INT NOT NULL, INDEX IDX_4EC8EF3EBE04EA9 (job_id), INDEX IDX_4EC8EF3E712A86AB (job_category_id), PRIMARY KEY(job_id, job_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, contact_id INT NOT NULL, subject VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, posted_at DATETIME NOT NULL, is_new TINYINT(1) DEFAULT \'1\' NOT NULL, is_to_contact TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_B6BD307FE7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ability (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(50) NOT NULL, is_professional TINYINT(1) NOT NULL, nb_question INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobility (id INT AUTO_INCREMENT NOT NULL, radius_id INT DEFAULT NULL, is_international TINYINT(1) DEFAULT \'0\' NOT NULL, is_national TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_D650201CA5A71553 (radius_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(45) NOT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, acronym VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10391BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E8B216519 FOREIGN KEY (work_time_id) REFERENCES work_time (id)');
        $this->addSql('ALTER TABLE offer_has_contracts ADD CONSTRAINT FK_74A1683753C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_has_contracts ADD CONSTRAINT FK_74A168372576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1FA76ED395 FOREIGN KEY (user_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64991BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47791BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA791BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA7BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA7712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE search_has_contracts ADD CONSTRAINT FK_49890838650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_has_contracts ADD CONSTRAINT FK_498908382576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E444AF29A35 FOREIGN KEY (curriculum_vitae_id) REFERENCES curriculum_vitae (id)');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_licenses ADD CONSTRAINT FK_AC42597691BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_licenses ADD CONSTRAINT FK_AC425976460F904B FOREIGN KEY (license_id) REFERENCES license (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_has_categories ADD CONSTRAINT FK_4EC8EF3EBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_has_categories ADD CONSTRAINT FK_4EC8EF3E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE7A1254A FOREIGN KEY (contact_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mobility ADD CONSTRAINT FK_D650201CA5A71553 FOREIGN KEY (radius_id) REFERENCES radius (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer_has_contracts DROP FOREIGN KEY FK_74A1683753C674EE');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F53C674EE');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D53C674EE');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E8B216519');
        $this->addSql('ALTER TABLE mobility DROP FOREIGN KEY FK_D650201CA5A71553');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE7A1254A');
        $this->addSql('ALTER TABLE search_has_contracts DROP FOREIGN KEY FK_49890838650760A9');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E712A86AB');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA7712A86AB');
        $this->addSql('ALTER TABLE job_has_categories DROP FOREIGN KEY FK_4EC8EF3E712A86AB');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10391BD8781');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF91BD8781');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1FA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64991BD8781');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47791BD8781');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA791BD8781');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D91BD8781');
        $this->addSql('ALTER TABLE candidate_has_licenses DROP FOREIGN KEY FK_AC42597691BD8781');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638979B1AD6');
        $this->addSql('ALTER TABLE candidate_has_licenses DROP FOREIGN KEY FK_AC425976460F904B');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E444AF29A35');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EBE04EA9');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA7BE04EA9');
        $this->addSql('ALTER TABLE job_has_categories DROP FOREIGN KEY FK_4EC8EF3EBE04EA9');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF8016D8B2');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E8016D8B2');
        $this->addSql('ALTER TABLE offer_has_contracts DROP FOREIGN KEY FK_74A168372576E0FD');
        $this->addSql('ALTER TABLE search_has_contracts DROP FOREIGN KEY FK_498908382576E0FD');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638708A0E0');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44708A0E0');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_has_contracts');
        $this->addSql('DROP TABLE work_time');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE radius');
        $this->addSql('DROP TABLE apply');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE search');
        $this->addSql('DROP TABLE search_has_contracts');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE job_category');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE bookmark');
        $this->addSql('DROP TABLE candidate_has_licenses');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE license');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE curriculum_vitae');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_has_categories');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE ability');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE mobility');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE gender');
    }
}
