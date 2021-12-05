<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211205202326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE thresholds (id UUID NOT NULL, user_id UUID NOT NULL, starting_from TIMESTAMP(0) WITH TIME ZONE NOT NULL, money_amount INT NOT NULL, money_currency VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN thresholds.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN thresholds.starting_from IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('CREATE TABLE transactions (id UUID NOT NULL, user_id UUID NOT NULL, type VARCHAR(255) NOT NULL, time TIMESTAMP(0) WITH TIME ZONE NOT NULL, money_amount INT NOT NULL, money_currency VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN transactions.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN transactions.time IS \'(DC2Type:datetimetz_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE thresholds');
        $this->addSql('DROP TABLE transactions');
    }
}
