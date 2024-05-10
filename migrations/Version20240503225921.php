<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503225921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordres ADD product_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordres ADD CONSTRAINT FK_F9C5CC8DDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_F9C5CC8DDE18E50B ON ordres (product_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordres DROP FOREIGN KEY FK_F9C5CC8DDE18E50B');
        $this->addSql('DROP INDEX IDX_F9C5CC8DDE18E50B ON ordres');
        $this->addSql('ALTER TABLE ordres DROP product_id_id');
    }
}
