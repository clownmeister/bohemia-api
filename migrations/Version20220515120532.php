<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515120532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Init comments. Update Post';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(64) DEFAULT NULL, text VARCHAR(1024) DEFAULT NULL, author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', archived TINYINT(1) NOT NULL, deleted TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post ADD edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE post DROP edited_at, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
