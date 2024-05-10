<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503230516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordres ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordres ADD CONSTRAINT FK_F9C5CC8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F9C5CC8DA76ED395 ON ordres (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordres DROP FOREIGN KEY FK_F9C5CC8DA76ED395');
        $this->addSql('DROP INDEX IDX_F9C5CC8DA76ED395 ON ordres');
        $this->addSql('ALTER TABLE ordres DROP user_id');
    }
}
