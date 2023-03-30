<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330110817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, document_request_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4FBF094FE3BD13F3 (document_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_request (id INT AUTO_INCREMENT NOT NULL, tracking_id INT DEFAULT NULL, document_request_detail_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9FF829437D05ABBE (tracking_id), INDEX IDX_9FF82943FB9D23D7 (document_request_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_request_detail (id INT AUTO_INCREMENT NOT NULL, fill_value VARCHAR(255) DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_type (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, document_request_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_2B6ADBBAC33F7837 (document_id), INDEX IDX_2B6ADBBAE3BD13F3 (document_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, institution_title VARCHAR(255) DEFAULT NULL, degree_title VARCHAR(255) NOT NULL, field_of_study_title VARCHAR(255) NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education_type (id INT AUTO_INCREMENT NOT NULL, education_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_6647EA982CA1BD71 (education_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_template (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_type (id INT AUTO_INCREMENT NOT NULL, form_template_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_18FF533EF2B19FA9 (form_template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, project_detail_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2FB3D0EEC9EC466C (project_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_detail (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_type (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_B54F9F31166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracking (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, education_id INT DEFAULT NULL, work_experience_id INT DEFAULT NULL, project_id INT DEFAULT NULL, form_template_id INT DEFAULT NULL, document_request_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, crated_at DATETIME NOT NULL, INDEX IDX_8D93D649C33F7837 (document_id), INDEX IDX_8D93D6492CA1BD71 (education_id), INDEX IDX_8D93D6496347713 (work_experience_id), INDEX IDX_8D93D649166D1F9C (project_id), INDEX IDX_8D93D649F2B19FA9 (form_template_id), INDEX IDX_8D93D649E3BD13F3 (document_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_detail (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_experience (id INT AUTO_INCREMENT NOT NULL, work_detail_id INT DEFAULT NULL, company_title VARCHAR(255) DEFAULT NULL, job_title VARCHAR(255) DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1EF36CD0BAD8ABEE (work_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_type (id INT AUTO_INCREMENT NOT NULL, work_experience_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_751DE6116347713 (work_experience_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FE3BD13F3 FOREIGN KEY (document_request_id) REFERENCES document_request (id)');
        $this->addSql('ALTER TABLE document_request ADD CONSTRAINT FK_9FF829437D05ABBE FOREIGN KEY (tracking_id) REFERENCES tracking (id)');
        $this->addSql('ALTER TABLE document_request ADD CONSTRAINT FK_9FF82943FB9D23D7 FOREIGN KEY (document_request_detail_id) REFERENCES document_request_detail (id)');
        $this->addSql('ALTER TABLE document_type ADD CONSTRAINT FK_2B6ADBBAC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE document_type ADD CONSTRAINT FK_2B6ADBBAE3BD13F3 FOREIGN KEY (document_request_id) REFERENCES document_request (id)');
        $this->addSql('ALTER TABLE education_type ADD CONSTRAINT FK_6647EA982CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id)');
        $this->addSql('ALTER TABLE form_type ADD CONSTRAINT FK_18FF533EF2B19FA9 FOREIGN KEY (form_template_id) REFERENCES form_template (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEC9EC466C FOREIGN KEY (project_detail_id) REFERENCES project_detail (id)');
        $this->addSql('ALTER TABLE project_type ADD CONSTRAINT FK_B54F9F31166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6492CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6496347713 FOREIGN KEY (work_experience_id) REFERENCES work_experience (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F2B19FA9 FOREIGN KEY (form_template_id) REFERENCES form_template (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649E3BD13F3 FOREIGN KEY (document_request_id) REFERENCES document_request (id)');
        $this->addSql('ALTER TABLE work_experience ADD CONSTRAINT FK_1EF36CD0BAD8ABEE FOREIGN KEY (work_detail_id) REFERENCES work_detail (id)');
        $this->addSql('ALTER TABLE work_type ADD CONSTRAINT FK_751DE6116347713 FOREIGN KEY (work_experience_id) REFERENCES work_experience (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FE3BD13F3');
        $this->addSql('ALTER TABLE document_request DROP FOREIGN KEY FK_9FF829437D05ABBE');
        $this->addSql('ALTER TABLE document_request DROP FOREIGN KEY FK_9FF82943FB9D23D7');
        $this->addSql('ALTER TABLE document_type DROP FOREIGN KEY FK_2B6ADBBAC33F7837');
        $this->addSql('ALTER TABLE document_type DROP FOREIGN KEY FK_2B6ADBBAE3BD13F3');
        $this->addSql('ALTER TABLE education_type DROP FOREIGN KEY FK_6647EA982CA1BD71');
        $this->addSql('ALTER TABLE form_type DROP FOREIGN KEY FK_18FF533EF2B19FA9');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEC9EC466C');
        $this->addSql('ALTER TABLE project_type DROP FOREIGN KEY FK_B54F9F31166D1F9C');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649C33F7837');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6492CA1BD71');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6496347713');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649166D1F9C');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F2B19FA9');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649E3BD13F3');
        $this->addSql('ALTER TABLE work_experience DROP FOREIGN KEY FK_1EF36CD0BAD8ABEE');
        $this->addSql('ALTER TABLE work_type DROP FOREIGN KEY FK_751DE6116347713');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_request');
        $this->addSql('DROP TABLE document_request_detail');
        $this->addSql('DROP TABLE document_type');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE education_type');
        $this->addSql('DROP TABLE form_template');
        $this->addSql('DROP TABLE form_type');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_detail');
        $this->addSql('DROP TABLE project_type');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE work_detail');
        $this->addSql('DROP TABLE work_experience');
        $this->addSql('DROP TABLE work_type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
