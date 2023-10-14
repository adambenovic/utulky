<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014173932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE application_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE template_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id INT NOT NULL, person_id INT NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, street_number VARCHAR(255) NOT NULL, is_main BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D4E6F81217BBB47 ON address (person_id)');
        $this->addSql('CREATE TABLE application (id INT NOT NULL, adopter_id INT NOT NULL, address_id INT NOT NULL, pet_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A45BDDC1A0D47673 ON application (adopter_id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC1F5B7AF75 ON application (address_id)');
        $this->addSql('CREATE INDEX IDX_A45BDDC1966F7FB6 ON application (pet_id)');
        $this->addSql('CREATE TABLE attribute (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, expected_value VARCHAR(255) DEFAULT NULL, choices JSON DEFAULT NULL, required BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pet (id INT NOT NULL, template_id INT NOT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, size VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E4529B855DA0FB8 ON pet (template_id)');
        $this->addSql('CREATE TABLE template (id INT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97601F837E3C61F9 ON template (owner_id)');
        $this->addSql('CREATE TABLE template_attribute (template_id INT NOT NULL, attribute_id INT NOT NULL, PRIMARY KEY(template_id, attribute_id))');
        $this->addSql('CREATE INDEX IDX_3329994D5DA0FB8 ON template_attribute (template_id)');
        $this->addSql('CREATE INDEX IDX_3329994DB6E62EFA ON template_attribute (attribute_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(255) DEFAULT NULL, surname VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, shelter VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81217BBB47 FOREIGN KEY (person_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1A0D47673 FOREIGN KEY (adopter_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B855DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F837E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE template_attribute ADD CONSTRAINT FK_3329994D5DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE template_attribute ADD CONSTRAINT FK_3329994DB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE address_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE application_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE template_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT FK_D4E6F81217BBB47');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC1A0D47673');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC1F5B7AF75');
        $this->addSql('ALTER TABLE application DROP CONSTRAINT FK_A45BDDC1966F7FB6');
        $this->addSql('ALTER TABLE pet DROP CONSTRAINT FK_E4529B855DA0FB8');
        $this->addSql('ALTER TABLE template DROP CONSTRAINT FK_97601F837E3C61F9');
        $this->addSql('ALTER TABLE template_attribute DROP CONSTRAINT FK_3329994D5DA0FB8');
        $this->addSql('ALTER TABLE template_attribute DROP CONSTRAINT FK_3329994DB6E62EFA');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE template_attribute');
        $this->addSql('DROP TABLE "user"');
    }
}
