<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108141012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars ADD cover_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14922726E9 FOREIGN KEY (cover_id) REFERENCES cover (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_95C71D14922726E9 ON cars (cover_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14922726E9');
        $this->addSql('DROP INDEX UNIQ_95C71D14922726E9 ON cars');
        $this->addSql('ALTER TABLE cars DROP cover_id');
    }
}
