<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616231425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_time (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(80) NOT NULL, description LONGTEXT NOT NULL, is_external TINYINT(1) DEFAULT \'0\' NOT NULL, url LONGTEXT DEFAULT NULL, article LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, posted_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, document VARCHAR(255) NOT NULL, INDEX IDX_D8698A76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, job_id INT NOT NULL, job_category_id INT NOT NULL, work_time_id INT NOT NULL, title VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, available_place INT NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, posted_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_29D6873E979B1AD6 (company_id), INDEX IDX_29D6873EBE04EA9 (job_id), INDEX IDX_29D6873E712A86AB (job_category_id), INDEX IDX_29D6873E8B216519 (work_time_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_has_contracts (offer_id INT NOT NULL, contract_id INT NOT NULL, INDEX IDX_74A1683753C674EE (offer_id), INDEX IDX_74A168372576E0FD (contract_id), PRIMARY KEY(offer_id, contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radius (id INT AUTO_INCREMENT NOT NULL, radius INT NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apply (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, offer_id INT NOT NULL, apply_at DATETIME NOT NULL, INDEX IDX_BD2F8C1FA76ED395 (user_id), INDEX IDX_BD2F8C1F53C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, candidate_id INT DEFAULT NULL, email VARCHAR(80) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649979B1AD6 (company_id), UNIQUE INDEX UNIQ_8D93D64991BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, skill_category_id INT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, INDEX IDX_5E3DE477AC58042E (skill_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, job_id INT NOT NULL, job_category_id INT NOT NULL, INDEX IDX_B4F0DBA791BD8781 (candidate_id), INDEX IDX_B4F0DBA7BE04EA9 (job_id), INDEX IDX_B4F0DBA7712A86AB (job_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_has_contracts (search_id INT NOT NULL, contract_id INT NOT NULL, INDEX IDX_49890838650760A9 (search_id), INDEX IDX_498908382576E0FD (contract_id), PRIMARY KEY(search_id, contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(45) NOT NULL, first_name VARCHAR(45) NOT NULL, email VARCHAR(80) NOT NULL, job VARCHAR(100) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, icon VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(45) NOT NULL, first_name VARCHAR(45) NOT NULL, birthday DATE NOT NULL, phone_number VARCHAR(20) NOT NULL, other_number VARCHAR(20) DEFAULT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, is_handicapped TINYINT(1) DEFAULT \'0\' NOT NULL, is_contactable_tel TINYINT(1) DEFAULT \'0\' NOT NULL, is_contactable_email TINYINT(1) DEFAULT \'1\' NOT NULL, have_vehicle TINYINT(1) DEFAULT \'0\' NOT NULL, curriculum_vitae VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookmark (candidate_id INT NOT NULL, offer_id INT NOT NULL, INDEX IDX_DA62921D91BD8781 (candidate_id), INDEX IDX_DA62921D53C674EE (offer_id), PRIMARY KEY(candidate_id, offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_has_licenses (candidate_id INT NOT NULL, license_id INT NOT NULL, INDEX IDX_AC42597691BD8781 (candidate_id), INDEX IDX_AC425976460F904B (license_id), PRIMARY KEY(candidate_id, license_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_has_skills (candidate_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_CBD416D591BD8781 (candidate_id), INDEX IDX_CBD416D55585C142 (skill_id), PRIMARY KEY(candidate_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, siret VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualification (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_situation (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, contract_id INT DEFAULT NULL, is_pole_emploi TINYINT(1) DEFAULT \'0\' NOT NULL, is_interim TINYINT(1) DEFAULT \'0\' NOT NULL, is_unemployed TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_370B2B66BE04EA9 (job_id), INDEX IDX_370B2B662576E0FD (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_has_categories (job_id INT NOT NULL, job_category_id INT NOT NULL, INDEX IDX_4EC8EF3EBE04EA9 (job_id), INDEX IDX_4EC8EF3E712A86AB (job_category_id), PRIMARY KEY(job_id, job_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate_has_qualifications (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, qualification_id INT NOT NULL, title VARCHAR(80) NOT NULL, INDEX IDX_1C91787691BD8781 (candidate_id), INDEX IDX_1C9178761A75EE38 (qualification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobility (id INT AUTO_INCREMENT NOT NULL, radius_id INT DEFAULT NULL, is_international TINYINT(1) DEFAULT \'0\' NOT NULL, is_national TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_D650201CA5A71553 (radius_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E8B216519 FOREIGN KEY (work_time_id) REFERENCES work_time (id)');
        $this->addSql('ALTER TABLE offer_has_contracts ADD CONSTRAINT FK_74A1683753C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_has_contracts ADD CONSTRAINT FK_74A168372576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1FA76ED395 FOREIGN KEY (user_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64991BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477AC58042E FOREIGN KEY (skill_category_id) REFERENCES skill_category (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA791BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA7BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA7712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE search_has_contracts ADD CONSTRAINT FK_49890838650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_has_contracts ADD CONSTRAINT FK_498908382576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_licenses ADD CONSTRAINT FK_AC42597691BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_licenses ADD CONSTRAINT FK_AC425976460F904B FOREIGN KEY (license_id) REFERENCES license (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_skills ADD CONSTRAINT FK_CBD416D591BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_skills ADD CONSTRAINT FK_CBD416D55585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE current_situation ADD CONSTRAINT FK_370B2B66BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE current_situation ADD CONSTRAINT FK_370B2B662576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE job_has_categories ADD CONSTRAINT FK_4EC8EF3EBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_has_categories ADD CONSTRAINT FK_4EC8EF3E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidate_has_qualifications ADD CONSTRAINT FK_1C91787691BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE candidate_has_qualifications ADD CONSTRAINT FK_1C9178761A75EE38 FOREIGN KEY (qualification_id) REFERENCES qualification (id)');
        $this->addSql('ALTER TABLE mobility ADD CONSTRAINT FK_D650201CA5A71553 FOREIGN KEY (radius_id) REFERENCES radius (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E8B216519');
        $this->addSql('ALTER TABLE offer_has_contracts DROP FOREIGN KEY FK_74A1683753C674EE');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F53C674EE');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D53C674EE');
        $this->addSql('ALTER TABLE mobility DROP FOREIGN KEY FK_D650201CA5A71553');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76A76ED395');
        $this->addSql('ALTER TABLE candidate_has_skills DROP FOREIGN KEY FK_CBD416D55585C142');
        $this->addSql('ALTER TABLE search_has_contracts DROP FOREIGN KEY FK_49890838650760A9');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E712A86AB');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA7712A86AB');
        $this->addSql('ALTER TABLE job_has_categories DROP FOREIGN KEY FK_4EC8EF3E712A86AB');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1FA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64991BD8781');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA791BD8781');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D91BD8781');
        $this->addSql('ALTER TABLE candidate_has_licenses DROP FOREIGN KEY FK_AC42597691BD8781');
        $this->addSql('ALTER TABLE candidate_has_skills DROP FOREIGN KEY FK_CBD416D591BD8781');
        $this->addSql('ALTER TABLE candidate_has_qualifications DROP FOREIGN KEY FK_1C91787691BD8781');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE candidate_has_qualifications DROP FOREIGN KEY FK_1C9178761A75EE38');
        $this->addSql('ALTER TABLE candidate_has_licenses DROP FOREIGN KEY FK_AC425976460F904B');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477AC58042E');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EBE04EA9');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA7BE04EA9');
        $this->addSql('ALTER TABLE current_situation DROP FOREIGN KEY FK_370B2B66BE04EA9');
        $this->addSql('ALTER TABLE job_has_categories DROP FOREIGN KEY FK_4EC8EF3EBE04EA9');
        $this->addSql('ALTER TABLE offer_has_contracts DROP FOREIGN KEY FK_74A168372576E0FD');
        $this->addSql('ALTER TABLE search_has_contracts DROP FOREIGN KEY FK_498908382576E0FD');
        $this->addSql('ALTER TABLE current_situation DROP FOREIGN KEY FK_370B2B662576E0FD');
        $this->addSql('DROP TABLE work_time');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_has_contracts');
        $this->addSql('DROP TABLE radius');
        $this->addSql('DROP TABLE apply');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE search');
        $this->addSql('DROP TABLE search_has_contracts');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE job_category');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE bookmark');
        $this->addSql('DROP TABLE candidate_has_licenses');
        $this->addSql('DROP TABLE candidate_has_skills');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE qualification');
        $this->addSql('DROP TABLE license');
        $this->addSql('DROP TABLE current_situation');
        $this->addSql('DROP TABLE skill_category');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_has_categories');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE candidate_has_qualifications');
        $this->addSql('DROP TABLE mobility');
    }
}
