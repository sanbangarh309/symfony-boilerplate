<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use TheCodingMachine\FluidSchema\TdbmFluidSchema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240929102135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create payments table.';
    }

    public function up(Schema $schema): void
    {
      $db = new TdbmFluidSchema($schema);

      $db->table('payments')
          ->column('id')->guid()->primaryKey()->comment('@UUID')
          ->column('user_id')->references('users')->notNull()->unique()
          ->column('amount')->float()->notNull()
          ->column('label')->string(255)->notNull()
          ->column('localization')->text()->null()
          //->timestamps();  this method is not working but mentioned in the documentation
          ->column('created_at')->datetime()
          ->column('updated_at')->datetime()->null();

      // $this->addSql('ALTER TABLE payments
      //         MODIFY COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP');
      // $this->addSql('ALTER TABLE payments
      //   MODIFY COLUMN updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP');

    }

    public function down(Schema $schema): void
    {
        throw new RuntimeException('Never rollback a migration!');
    }
}
