<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408221305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE furniture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE furniture (id INT NOT NULL, furniture_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE point ADD furniture_points_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD furniture_clearance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD furniture_open_side_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F32450589267 FOREIGN KEY (furniture_points_id) REFERENCES furniture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F32421FB7065 FOREIGN KEY (furniture_clearance_id) REFERENCES furniture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F32462B3B2F1 FOREIGN KEY (furniture_open_side_id) REFERENCES furniture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B7A5F32450589267 ON point (furniture_points_id)');
        $this->addSql('CREATE INDEX IDX_B7A5F32421FB7065 ON point (furniture_clearance_id)');
        $this->addSql('CREATE INDEX IDX_B7A5F32462B3B2F1 ON point (furniture_open_side_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F32450589267');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F32421FB7065');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F32462B3B2F1');
        $this->addSql('DROP SEQUENCE furniture_id_seq CASCADE');
        $this->addSql('DROP TABLE furniture');
        $this->addSql('DROP INDEX IDX_B7A5F32450589267');
        $this->addSql('DROP INDEX IDX_B7A5F32421FB7065');
        $this->addSql('DROP INDEX IDX_B7A5F32462B3B2F1');
        $this->addSql('ALTER TABLE point DROP furniture_points_id');
        $this->addSql('ALTER TABLE point DROP furniture_clearance_id');
        $this->addSql('ALTER TABLE point DROP furniture_open_side_id');
    }
}
