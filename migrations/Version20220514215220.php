<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220514215220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Init posts.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(64) NOT NULL, html TEXT DEFAULT NULL, author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', published TINYINT(1) DEFAULT 0 NOT NULL, archived TINYINT(1) DEFAULT 0 NOT NULL, deleted TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_5A8A6C8DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post');
    }
}
