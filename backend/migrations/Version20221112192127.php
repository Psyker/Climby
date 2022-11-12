<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221112192127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE session ADD author_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN session.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D044D5D4F675F31B ON session (author_id)');
        $this->addSql('ALTER TABLE session ADD public BOOLEAN NOT NULL DEFAULT true');
        $this->addSql('ALTER TABLE session ALTER name SET NOT NULL');
        $this->addSql('ALTER TABLE session ALTER description SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE session DROP CONSTRAINT FK_D044D5D4F675F31B');
        $this->addSql('DROP INDEX IDX_D044D5D4F675F31B');
        $this->addSql('ALTER TABLE session DROP author_id');
        $this->addSql('ALTER TABLE session DROP public');
        $this->addSql('ALTER TABLE session ALTER name DROP NOT NULL');
        $this->addSql('ALTER TABLE session ALTER description DROP NOT NULL');
    }
}
