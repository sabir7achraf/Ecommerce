<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240415024846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD img_fk_id INT NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8DBBB0BF FOREIGN KEY (img_fk_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8DBBB0BF ON images (img_fk_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8DBBB0BF');
        $this->addSql('DROP INDEX IDX_E01FBE6A8DBBB0BF ON images');
        $this->addSql('ALTER TABLE images DROP img_fk_id');
    }
}
