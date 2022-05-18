<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518032936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove unique in post, comment on author_id';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9474526CF675F31B ON comment');
        $this->addSql('DROP INDEX UNIQ_5A8A6C8DF675F31B ON post');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8DF675F31B ON post (author_id)');
    }
}
