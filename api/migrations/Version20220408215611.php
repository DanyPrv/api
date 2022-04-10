<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408215611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE corridor_polygon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE corridor_polygon (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE point ADD corridor_boundaries_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD corridor_holes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F324EA9CC29 FOREIGN KEY (corridor_boundaries_id) REFERENCES corridor_polygon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F3247537962C FOREIGN KEY (corridor_holes_id) REFERENCES corridor_polygon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B7A5F324EA9CC29 ON point (corridor_boundaries_id)');
        $this->addSql('CREATE INDEX IDX_B7A5F3247537962C ON point (corridor_holes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F324EA9CC29');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F3247537962C');
        $this->addSql('DROP SEQUENCE corridor_polygon_id_seq CASCADE');
        $this->addSql('DROP TABLE corridor_polygon');
        $this->addSql('DROP INDEX IDX_B7A5F324EA9CC29');
        $this->addSql('DROP INDEX IDX_B7A5F3247537962C');
        $this->addSql('ALTER TABLE point DROP corridor_boundaries_id');
        $this->addSql('ALTER TABLE point DROP corridor_holes_id');
    }
}
