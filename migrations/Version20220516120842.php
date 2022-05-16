<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220516120842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Role fixtures.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('REPLACE INTO role (id, name, is_default) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER\', TRUE)');
        $this->addSql('REPLACE INTO role (id, name, is_default) VALUES (UUID_TO_BIN(UUID()), \'ROLE_COMMENT_ADD\', TRUE)');

        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_ADMIN\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_MODERATOR\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_COMMENT_VIEW\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_COMMENT_REMOVE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_COMMENT_RESTORE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_POST_VIEW\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_POST_ADD\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_POST_EDIT\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_POST_REMOVE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_POST_RESTORE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_POST_PUBLISH\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER_VIEW\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER_ADD\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER_EDIT\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER_REMOVE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER_ENABLE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_USER_DISABLE\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_ROLE_VIEW\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_ROLE_ADD\')');
        $this->addSql('REPLACE INTO role (id, name) VALUES (UUID_TO_BIN(UUID()), \'ROLE_ROLE_REMOVE\')');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE role');
    }
}
