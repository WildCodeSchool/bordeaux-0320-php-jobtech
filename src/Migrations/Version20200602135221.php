<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602135221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, article LONGTEXT NOT NULL, image LONGTEXT DEFAULT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, document LONGTEXT NOT NULL, INDEX IDX_D8698A76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_information (id INT AUTO_INCREMENT NOT NULL, mobility_id INT DEFAULT NULL, current_situation_id INT DEFAULT NULL, lastname VARCHAR(45) NOT NULL, firstname VARCHAR(45) NOT NULL, birthday DATE NOT NULL, phone_number INT DEFAULT NULL, home_number INT DEFAULT NULL, postal_code INT DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, country VARCHAR(60) DEFAULT NULL, is_handicaped TINYINT(1) DEFAULT NULL, is_contactable_tel TINYINT(1) DEFAULT NULL, is_contactable_email TINYINT(1) DEFAULT NULL, have_vehicle TINYINT(1) DEFAULT NULL, curriculum_vitae LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8062D1168D92EAA4 (mobility_id), UNIQUE INDEX UNIQ_8062D116CBB95674 (current_situation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_information_license (user_information_id INT NOT NULL, license_id INT NOT NULL, INDEX IDX_609A3BFA4575EE58 (user_information_id), INDEX IDX_609A3BFA460F904B (license_id), PRIMARY KEY(user_information_id, license_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_information_skill (user_information_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_C5059B8C4575EE58 (user_information_id), INDEX IDX_C5059B8C5585C142 (skill_id), PRIMARY KEY(user_information_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, contract_id INT DEFAULT NULL, profession_id INT NOT NULL, title VARCHAR(45) NOT NULL, description LONGTEXT NOT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, duration VARCHAR(45) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME DEFAULT NULL, INDEX IDX_29D6873E979B1AD6 (company_id), INDEX IDX_29D6873E2576E0FD (contract_id), INDEX IDX_29D6873EFDEF8996 (profession_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE radius (id INT AUTO_INCREMENT NOT NULL, radius INT NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apply (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, offer_id INT NOT NULL, apply_on DATETIME NOT NULL, INDEX IDX_BD2F8C1FA76ED395 (user_id), INDEX IDX_BD2F8C1F53C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, user_information_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_on DATETIME NOT NULL, updated_on DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649979B1AD6 (company_id), UNIQUE INDEX UNIQ_8D93D6494575EE58 (user_information_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_offer (user_id INT NOT NULL, offer_id INT NOT NULL, INDEX IDX_CB147C66A76ED395 (user_id), INDEX IDX_CB147C6653C674EE (offer_id), PRIMARY KEY(user_id, offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, skill_category_id INT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, INDEX IDX_5E3DE477AC58042E (skill_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_B4F0DBA7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_contract (search_id INT NOT NULL, contract_id INT NOT NULL, INDEX IDX_F9D883EC650760A9 (search_id), INDEX IDX_F9D883EC2576E0FD (contract_id), PRIMARY KEY(search_id, contract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search_profession (search_id INT NOT NULL, profession_id INT NOT NULL, INDEX IDX_62253DA3650760A9 (search_id), INDEX IDX_62253DA3FDEF8996 (profession_id), PRIMARY KEY(search_id, profession_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, lastname VARCHAR(45) NOT NULL, firstname VARCHAR(45) NOT NULL, email VARCHAR(60) NOT NULL, poste VARCHAR(100) NOT NULL, phone_number INT DEFAULT NULL, INDEX IDX_4C62E638979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, siret VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(60) NOT NULL, country VARCHAR(60) NOT NULL, adress VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualification (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_situation (id INT AUTO_INCREMENT NOT NULL, contract_id INT DEFAULT NULL, profession_id INT DEFAULT NULL, is_pole_emploi TINYINT(1) NOT NULL, is_interim TINYINT(1) NOT NULL, is_unemployed TINYINT(1) NOT NULL, INDEX IDX_370B2B662576E0FD (contract_id), INDEX IDX_370B2B66FDEF8996 (profession_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(60) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expertise (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, expertise_id INT DEFAULT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, INDEX IDX_BA930D699D5B92F9 (expertise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, identifier VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mobility (id INT AUTO_INCREMENT NOT NULL, radius_id INT DEFAULT NULL, is_international TINYINT(1) DEFAULT NULL, is_national TINYINT(1) DEFAULT NULL, INDEX IDX_D650201CA5A71553 (radius_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_qualification (id INT AUTO_INCREMENT NOT NULL, user_information_id INT NOT NULL, qualification_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_599C5D9E4575EE58 (user_information_id), INDEX IDX_599C5D9E1A75EE38 (qualification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_information ADD CONSTRAINT FK_8062D1168D92EAA4 FOREIGN KEY (mobility_id) REFERENCES mobility (id)');
        $this->addSql('ALTER TABLE user_information ADD CONSTRAINT FK_8062D116CBB95674 FOREIGN KEY (current_situation_id) REFERENCES current_situation (id)');
        $this->addSql('ALTER TABLE user_information_license ADD CONSTRAINT FK_609A3BFA4575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_information_license ADD CONSTRAINT FK_609A3BFA460F904B FOREIGN KEY (license_id) REFERENCES license (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_information_skill ADD CONSTRAINT FK_C5059B8C4575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_information_skill ADD CONSTRAINT FK_C5059B8C5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E2576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EFDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id)');
        $this->addSql('ALTER TABLE user_offer ADD CONSTRAINT FK_CB147C66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_offer ADD CONSTRAINT FK_CB147C6653C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477AC58042E FOREIGN KEY (skill_category_id) REFERENCES skill_category (id)');
        $this->addSql('ALTER TABLE search ADD CONSTRAINT FK_B4F0DBA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE search_contract ADD CONSTRAINT FK_F9D883EC650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_contract ADD CONSTRAINT FK_F9D883EC2576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_profession ADD CONSTRAINT FK_62253DA3650760A9 FOREIGN KEY (search_id) REFERENCES search (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE search_profession ADD CONSTRAINT FK_62253DA3FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE current_situation ADD CONSTRAINT FK_370B2B662576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE current_situation ADD CONSTRAINT FK_370B2B66FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D699D5B92F9 FOREIGN KEY (expertise_id) REFERENCES expertise (id)');
        $this->addSql('ALTER TABLE mobility ADD CONSTRAINT FK_D650201CA5A71553 FOREIGN KEY (radius_id) REFERENCES radius (id)');
        $this->addSql('ALTER TABLE user_qualification ADD CONSTRAINT FK_599C5D9E4575EE58 FOREIGN KEY (user_information_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_qualification ADD CONSTRAINT FK_599C5D9E1A75EE38 FOREIGN KEY (qualification_id) REFERENCES qualification (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_information_license DROP FOREIGN KEY FK_609A3BFA4575EE58');
        $this->addSql('ALTER TABLE user_information_skill DROP FOREIGN KEY FK_C5059B8C4575EE58');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494575EE58');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F53C674EE');
        $this->addSql('ALTER TABLE user_offer DROP FOREIGN KEY FK_CB147C6653C674EE');
        $this->addSql('ALTER TABLE mobility DROP FOREIGN KEY FK_D650201CA5A71553');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76A76ED395');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1FA76ED395');
        $this->addSql('ALTER TABLE user_offer DROP FOREIGN KEY FK_CB147C66A76ED395');
        $this->addSql('ALTER TABLE search DROP FOREIGN KEY FK_B4F0DBA7A76ED395');
        $this->addSql('ALTER TABLE user_qualification DROP FOREIGN KEY FK_599C5D9E4575EE58');
        $this->addSql('ALTER TABLE user_information_skill DROP FOREIGN KEY FK_C5059B8C5585C142');
        $this->addSql('ALTER TABLE search_contract DROP FOREIGN KEY FK_F9D883EC650760A9');
        $this->addSql('ALTER TABLE search_profession DROP FOREIGN KEY FK_62253DA3650760A9');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638979B1AD6');
        $this->addSql('ALTER TABLE user_qualification DROP FOREIGN KEY FK_599C5D9E1A75EE38');
        $this->addSql('ALTER TABLE user_information_license DROP FOREIGN KEY FK_609A3BFA460F904B');
        $this->addSql('ALTER TABLE user_information DROP FOREIGN KEY FK_8062D116CBB95674');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477AC58042E');
        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D699D5B92F9');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EFDEF8996');
        $this->addSql('ALTER TABLE search_profession DROP FOREIGN KEY FK_62253DA3FDEF8996');
        $this->addSql('ALTER TABLE current_situation DROP FOREIGN KEY FK_370B2B66FDEF8996');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E2576E0FD');
        $this->addSql('ALTER TABLE search_contract DROP FOREIGN KEY FK_F9D883EC2576E0FD');
        $this->addSql('ALTER TABLE current_situation DROP FOREIGN KEY FK_370B2B662576E0FD');
        $this->addSql('ALTER TABLE user_information DROP FOREIGN KEY FK_8062D1168D92EAA4');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE user_information');
        $this->addSql('DROP TABLE user_information_license');
        $this->addSql('DROP TABLE user_information_skill');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE radius');
        $this->addSql('DROP TABLE apply');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_offer');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE search');
        $this->addSql('DROP TABLE search_contract');
        $this->addSql('DROP TABLE search_profession');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE qualification');
        $this->addSql('DROP TABLE license');
        $this->addSql('DROP TABLE current_situation');
        $this->addSql('DROP TABLE skill_category');
        $this->addSql('DROP TABLE expertise');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE mobility');
        $this->addSql('DROP TABLE user_qualification');
    }
}
