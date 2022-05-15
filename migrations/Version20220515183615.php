<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515183615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update user entity. Fix nullable properties. Change nickname to displayName.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN display_name VARCHAR(255) DEFAULT NULL AFTER `username`, DROP nickname, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE street street VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE state state VARCHAR(255) DEFAULT NULL, CHANGE zip zip VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD nickname VARCHAR(255) NOT NULL, DROP display_name, CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE street street VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL, CHANGE state state VARCHAR(255) NOT NULL, CHANGE zip zip VARCHAR(255) NOT NULL');
    }
}
