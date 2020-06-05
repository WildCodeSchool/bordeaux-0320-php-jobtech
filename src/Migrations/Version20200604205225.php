<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604205225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_have_license (user_information_id INT NOT NULL, license_id INT NOT NULL, INDEX IDX_EFBC125A4575EE58 (user_information_id), INDEX IDX_EFBC125A460F904B (license_id), PRIMARY KEY(user_information_id, license_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_have_skill (user_information_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_1BB32DE44575EE58 (user_information_id), INDEX IDX_1BB32DE45585C142 (skill_id), PRIMARY KEY(user_information_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_have_license ADD CONSTRAINT FK_EFBC125A4575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_have_license ADD CONSTRAINT FK_EFBC125A460F904B FOREIGN KEY (license_id) REFERENCES license (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_have_skill ADD CONSTRAINT FK_1BB32DE44575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_have_skill ADD CONSTRAINT FK_1BB32DE45585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_information_license');
        $this->addSql('DROP TABLE user_information_skill');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_information_license (user_information_id INT NOT NULL, license_id INT NOT NULL, INDEX IDX_609A3BFA4575EE58 (user_information_id), INDEX IDX_609A3BFA460F904B (license_id), PRIMARY KEY(user_information_id, license_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_information_skill (user_information_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_C5059B8C4575EE58 (user_information_id), INDEX IDX_C5059B8C5585C142 (skill_id), PRIMARY KEY(user_information_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_information_license ADD CONSTRAINT FK_609A3BFA4575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_information_license ADD CONSTRAINT FK_609A3BFA460F904B FOREIGN KEY (license_id) REFERENCES license (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_information_skill ADD CONSTRAINT FK_C5059B8C4575EE58 FOREIGN KEY (user_information_id) REFERENCES user_information (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_information_skill ADD CONSTRAINT FK_C5059B8C5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_have_license');
        $this->addSql('DROP TABLE user_have_skill');
    }
}
