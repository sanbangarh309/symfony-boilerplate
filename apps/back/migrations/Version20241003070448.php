<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241003070448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new column user_id in user table and create payments table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user ADD COLUMN user_id BIGINT AUTO_INCREMENT UNIQUE AFTER id;');

        $this->addSql('CREATE TABLE payments (
            id INT AUTO_INCREMENT PRIMARY KEY,   
            user_id BIGINT NOT NULL,                
            amount FLOAT NOT NULL,               
            label VARCHAR(50),                  
            latitude VARCHAR(50),               
            longitude VARCHAR(50),               
            localization TEXT,                   
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(user_id)
        );');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE payments');
    }
}
