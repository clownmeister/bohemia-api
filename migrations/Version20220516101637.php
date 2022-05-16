<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516101637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Role fixtures.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_ADMIN\')');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE role');
    }
}
