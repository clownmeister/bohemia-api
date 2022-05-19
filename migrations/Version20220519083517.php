<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220519083517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create entity for role hierarchy. No time for join tables unfortunately.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_hierarchy (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', parent_role BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', included_roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE role_hierarchy');
    }
}
