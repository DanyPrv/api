<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607171844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hardware_request DROP CONSTRAINT fk_975a01f07e3c61f9');
        $this->addSql('DROP INDEX uniq_975a01f07e3c61f9');
        $this->addSql('ALTER TABLE hardware_request DROP owner_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hardware_request ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE hardware_request ADD CONSTRAINT fk_975a01f07e3c61f9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_975a01f07e3c61f9 ON hardware_request (owner_id)');
    }
}
