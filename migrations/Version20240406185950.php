<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406185950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE companies ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE merchants ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE packages ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE users ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE companies DROP created_at');
        $this->addSql('ALTER TABLE merchants DROP created_at');
        $this->addSql('ALTER TABLE packages DROP created_at');
        $this->addSql('ALTER TABLE users DROP created_at');
    }
}
