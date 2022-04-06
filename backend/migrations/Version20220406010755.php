<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406010755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD facebook_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ALTER google_id DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499BE8FD98 ON "user" (facebook_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_8D93D6499BE8FD98');
        $this->addSql('ALTER TABLE "user" DROP facebook_id');
        $this->addSql('ALTER TABLE "user" ALTER google_id SET NOT NULL');
    }
}
