<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\MerchantCategory;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240408113327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT IGNORE INTO api_token (authority, token) VALUES ("benefitseller", "testvalue")');
        $this->addSql('INSERT IGNORE INTO merchant_categories (category) VALUES 
                        (' . MerchantCategory::FOOD_AND_DRINKS->value . '), 
                        (' . MerchantCategory::RECREATION->value . '), 
                        (' . MerchantCategory::EDUCATION->value . '), 
                        (' . MerchantCategory::CULTURE->value . '), 
                        (' . MerchantCategory::TRAVELING->value . '), 
                        (' . MerchantCategory::SHOPPING->value . ')
        ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
