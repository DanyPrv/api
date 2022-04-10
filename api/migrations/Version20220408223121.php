<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408223121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure ADD floor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA854679E2 FOREIGN KEY (floor_id) REFERENCES floor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6F0137EA854679E2 ON structure (floor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE structure DROP CONSTRAINT FK_6F0137EA854679E2');
        $this->addSql('DROP INDEX IDX_6F0137EA854679E2');
        $this->addSql('ALTER TABLE structure DROP floor_id');
    }
}
