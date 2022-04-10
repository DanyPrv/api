<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408222004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, type VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, intractable BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE furniture ADD room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB354177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_665DDAB354177093 ON furniture (room_id)');
        $this->addSql('ALTER TABLE point ADD room_points_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD room_inner_point_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD room_revit_points_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F32443C0B746 FOREIGN KEY (room_points_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F32454986718 FOREIGN KEY (room_inner_point_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F324225C4D3D FOREIGN KEY (room_revit_points_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B7A5F32443C0B746 ON point (room_points_id)');
        $this->addSql('CREATE INDEX IDX_B7A5F32454986718 ON point (room_inner_point_id)');
        $this->addSql('CREATE INDEX IDX_B7A5F324225C4D3D ON point (room_revit_points_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE furniture DROP CONSTRAINT FK_665DDAB354177093');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F32443C0B746');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F32454986718');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F324225C4D3D');
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP INDEX IDX_B7A5F32443C0B746');
        $this->addSql('DROP INDEX IDX_B7A5F32454986718');
        $this->addSql('DROP INDEX IDX_B7A5F324225C4D3D');
        $this->addSql('ALTER TABLE point DROP room_points_id');
        $this->addSql('ALTER TABLE point DROP room_inner_point_id');
        $this->addSql('ALTER TABLE point DROP room_revit_points_id');
        $this->addSql('DROP INDEX IDX_665DDAB354177093');
        $this->addSql('ALTER TABLE furniture DROP room_id');
    }
}
