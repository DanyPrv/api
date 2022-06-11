<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610184730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource ADD description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE resource ADD creation_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD first_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD last_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD birth_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP first_name');
        $this->addSql('ALTER TABLE "user" DROP last_name');
        $this->addSql('ALTER TABLE "user" DROP birth_date');
        $this->addSql('ALTER TABLE resource DROP description');
        $this->addSql('ALTER TABLE resource DROP creation_date');
    }
}
