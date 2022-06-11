<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220611224256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ADD ADMIN\nU:admin@admin.ro\nP:test';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('insert into "user" (id,first_name, last_name, email, username, roles, password, active) VALUES
                                               (0,\'System\',\'Administrator\',\'admin@admin.ro\',\'admin\',\'["ROLE_USER","ROLE_ADMIN"]\',\'$2y$13$nfNgE.FLd7syaNDRoaZgzO4poBkl7a4ewuTstQkZ/vhn.kdQNdf4O\', true)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
    }
}
