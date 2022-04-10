<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408222356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE floor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE floor (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE corridor_polygon ADD floor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE corridor_polygon ADD CONSTRAINT FK_46AC52F2854679E2 FOREIGN KEY (floor_id) REFERENCES floor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_46AC52F2854679E2 ON corridor_polygon (floor_id)');
        $this->addSql('ALTER TABLE mullion ADD floor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mullion ADD CONSTRAINT FK_EB97746854679E2 FOREIGN KEY (floor_id) REFERENCES floor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EB97746854679E2 ON mullion (floor_id)');
        $this->addSql('ALTER TABLE point ADD floor_point_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE point ADD CONSTRAINT FK_B7A5F324525A85B3 FOREIGN KEY (floor_point_id) REFERENCES floor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B7A5F324525A85B3 ON point (floor_point_id)');
        $this->addSql('ALTER TABLE room ADD floor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B854679E2 FOREIGN KEY (floor_id) REFERENCES floor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_729F519B854679E2 ON room (floor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE corridor_polygon DROP CONSTRAINT FK_46AC52F2854679E2');
        $this->addSql('ALTER TABLE mullion DROP CONSTRAINT FK_EB97746854679E2');
        $this->addSql('ALTER TABLE point DROP CONSTRAINT FK_B7A5F324525A85B3');
        $this->addSql('ALTER TABLE room DROP CONSTRAINT FK_729F519B854679E2');
        $this->addSql('DROP SEQUENCE floor_id_seq CASCADE');
        $this->addSql('DROP TABLE floor');
        $this->addSql('DROP INDEX IDX_EB97746854679E2');
        $this->addSql('ALTER TABLE mullion DROP floor_id');
        $this->addSql('DROP INDEX IDX_B7A5F324525A85B3');
        $this->addSql('ALTER TABLE point DROP floor_point_id');
        $this->addSql('DROP INDEX IDX_46AC52F2854679E2');
        $this->addSql('ALTER TABLE corridor_polygon DROP floor_id');
        $this->addSql('DROP INDEX IDX_729F519B854679E2');
        $this->addSql('ALTER TABLE room DROP floor_id');
    }
}
