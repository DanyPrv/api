<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419201710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('insert into "user" (id, email, username, roles, password) VALUES (1,\'admin@admin.ro\',\'admin\',\'["ROLE_USER","ROLE_ADMIN"]\',\'$2y$13$nfNgE.FLd7syaNDRoaZgzO4poBkl7a4ewuTstQkZ/vhn.kdQNdf4O\')');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
