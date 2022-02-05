<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220205221159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP COLUMN "datetime"');
        $this->addSql('ALTER TABLE "user" ADD COLUMN "login_time" TIMESTAMP');
        $this->addSql('ALTER TABLE "user" ADD COLUMN "logout_time" TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP COLUMN "login_time"');
        $this->addSql('ALTER TABLE "user" DROP COLUMN "logout_time"');
    }
}
