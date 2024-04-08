<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406232647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cards ADD number VARCHAR(255) NOT NULL, ADD expiration_date DATETIME NOT NULL, ADD cvv VARCHAR(5) NOT NULL, ADD account VARCHAR(20) NOT NULL, ADD amount INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FD96901F54 ON cards (number)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4C258FD96901F54 ON cards');
        $this->addSql('ALTER TABLE cards DROP number, DROP expiration_date, DROP cvv, DROP account, DROP amount');
    }
}
