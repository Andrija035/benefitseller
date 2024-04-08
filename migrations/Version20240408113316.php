<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408113316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benefits (id INT AUTO_INCREMENT NOT NULL, merchant_id INT NOT NULL, name VARCHAR(255) NOT NULL, type INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_965A49FE6796D554 (merchant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cards (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, number VARCHAR(16) NOT NULL, expiration_date DATETIME NOT NULL, cvv VARCHAR(5) NOT NULL, account VARCHAR(20) NOT NULL, funds INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4C258FD96901F54 (number), UNIQUE INDEX UNIQ_4C258FDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE merchant_categories (id INT AUTO_INCREMENT NOT NULL, category SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE merchants (id INT AUTO_INCREMENT NOT NULL, merchant_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, discount INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_CC77B6C094F720F1 (merchant_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE packages (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, user_category SMALLINT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9BB5C0A7979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package_merchant_category (package_id INT NOT NULL, merchant_category_id INT NOT NULL, INDEX IDX_FD973597F44CABFF (package_id), INDEX IDX_FD97359794F720F1 (merchant_category_id), PRIMARY KEY(package_id, merchant_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE package_merchant (package_id INT NOT NULL, merchant_id INT NOT NULL, INDEX IDX_902AB18FF44CABFF (package_id), INDEX IDX_902AB18F6796D554 (merchant_id), PRIMARY KEY(package_id, merchant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, merchant_id INT NOT NULL, amount INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_EAA81A4C4ACC9A20 (card_id), INDEX IDX_EAA81A4C6796D554 (merchant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, email VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, category SMALLINT DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE api_token (id INT AUTO_INCREMENT NOT NULL, authority VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_7BA2F5EB4AF96AFC (authority), UNIQUE INDEX UNIQ_7BA2F5EB5F37A13B (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE benefits ADD CONSTRAINT FK_965A49FE6796D554 FOREIGN KEY (merchant_id) REFERENCES merchants (id)');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE merchants ADD CONSTRAINT FK_CC77B6C094F720F1 FOREIGN KEY (merchant_category_id) REFERENCES merchant_categories (id)');
        $this->addSql('ALTER TABLE packages ADD CONSTRAINT FK_9BB5C0A7979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE package_merchant_category ADD CONSTRAINT FK_FD973597F44CABFF FOREIGN KEY (package_id) REFERENCES packages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE package_merchant_category ADD CONSTRAINT FK_FD97359794F720F1 FOREIGN KEY (merchant_category_id) REFERENCES merchant_categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE package_merchant ADD CONSTRAINT FK_902AB18FF44CABFF FOREIGN KEY (package_id) REFERENCES packages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE package_merchant ADD CONSTRAINT FK_902AB18F6796D554 FOREIGN KEY (merchant_id) REFERENCES merchants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C4ACC9A20 FOREIGN KEY (card_id) REFERENCES cards (id)');
        $this->addSql('ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C6796D554 FOREIGN KEY (merchant_id) REFERENCES merchants (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benefits DROP FOREIGN KEY FK_965A49FE6796D554');
        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FDA76ED395');
        $this->addSql('ALTER TABLE merchants DROP FOREIGN KEY FK_CC77B6C094F720F1');
        $this->addSql('ALTER TABLE packages DROP FOREIGN KEY FK_9BB5C0A7979B1AD6');
        $this->addSql('ALTER TABLE package_merchant_category DROP FOREIGN KEY FK_FD973597F44CABFF');
        $this->addSql('ALTER TABLE package_merchant_category DROP FOREIGN KEY FK_FD97359794F720F1');
        $this->addSql('ALTER TABLE package_merchant DROP FOREIGN KEY FK_902AB18FF44CABFF');
        $this->addSql('ALTER TABLE package_merchant DROP FOREIGN KEY FK_902AB18F6796D554');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C4ACC9A20');
        $this->addSql('ALTER TABLE transactions DROP FOREIGN KEY FK_EAA81A4C6796D554');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9979B1AD6');
        $this->addSql('DROP TABLE benefits');
        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE merchant_categories');
        $this->addSql('DROP TABLE merchants');
        $this->addSql('DROP TABLE packages');
        $this->addSql('DROP TABLE package_merchant_category');
        $this->addSql('DROP TABLE package_merchant');
        $this->addSql('DROP TABLE transactions');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE api_token');
    }
}
