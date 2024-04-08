<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240407145110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, merchant_id INT NOT NULL, amount INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_EAA81A4C4ACC9A20 (card_id), INDEX IDX_EAA81A4C6796D554 (merchant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C4ACC9A20 FOREIGN KEY (card_id) REFERENCES cards (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C6796D554 FOREIGN KEY (merchant_id) REFERENCES merchants (id)');
        $this->addSql('ALTER TABLE cards ADD active TINYINT(1) DEFAULT 1 NOT NULL, CHANGE amount balance INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C4ACC9A20');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C6796D554');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('ALTER TABLE cards DROP active, CHANGE balance amount INT NOT NULL');
    }
}
