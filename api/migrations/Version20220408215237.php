<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408215237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE mullion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE point_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE structure_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE mullion (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE point (id INT NOT NULL, mullion_id INT DEFAULT NULL, structure_id INT DEFAULT NULL, x DOUBLE PRECISION NOT NULL, y DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B7A5F324C095D055 ON point (mullion_id)');
        $this->addSql('CREATE INDEX IDX_B7A5F3242534008B ON point (structure_id)');
        $this->addSql('CREATE TABLE structure (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F324C095D055 FOREIGN KEY (mullion_id) REFERENCES mullion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F3242534008B FOREIGN KEY (structure_id) REFERENCES structure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F324C095D055');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F3242534008B');
        $this->addSql('DROP SEQUENCE mullion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE point_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE structure_id_seq CASCADE');
        $this->addSql('DROP TABLE mullion');
        $this->addSql('DROP TABLE point');
        $this->addSql('DROP TABLE structure');
    }
}
