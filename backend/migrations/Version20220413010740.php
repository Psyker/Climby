<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413010740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gym (id UUID NOT NULL, name VARCHAR(500) NOT NULL, mp_id VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, address VARCHAR(500) NOT NULL, phone_number VARCHAR(50) DEFAULT NULL, site_url VARCHAR(255) DEFAULT NULL, image_url VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN gym.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE session (id UUID NOT NULL, gym_id UUID DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, grade VARCHAR(4) NOT NULL, seats INT NOT NULL, type VARCHAR(255) NOT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, discipline VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D044D5D4BD2F03 ON session (gym_id)');
        $this->addSql('COMMENT ON COLUMN session.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN session.gym_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN session.start_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN session.end_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN session.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN session.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "session_user" (session_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(session_id, user_id))');
        $this->addSql('CREATE INDEX IDX_4BE2D663613FECDF ON "session_user" (session_id)');
        $this->addSql('CREATE INDEX IDX_4BE2D663A76ED395 ON "session_user" (user_id)');
        $this->addSql('COMMENT ON COLUMN "session_user".session_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "session_user".user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, username VARCHAR(180) DEFAULT NULL, google_id VARCHAR(255) DEFAULT NULL, facebook_id VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64976F5C865 ON "user" (google_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499BE8FD98 ON "user" (facebook_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4BD2F03 FOREIGN KEY (gym_id) REFERENCES gym (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "session_user" ADD CONSTRAINT FK_4BE2D663613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "session_user" ADD CONSTRAINT FK_4BE2D663A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE session DROP CONSTRAINT FK_D044D5D4BD2F03');
        $this->addSql('ALTER TABLE "session_user" DROP CONSTRAINT FK_4BE2D663613FECDF');
        $this->addSql('ALTER TABLE "session_user" DROP CONSTRAINT FK_4BE2D663A76ED395');
        $this->addSql('DROP TABLE gym');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE "session_user"');
        $this->addSql('DROP TABLE "user"');
    }
}
