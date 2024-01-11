<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111140026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_item (tag_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_F1149AA8BAD26311 (tag_id), INDEX IDX_F1149AA8126F525E (item_id), PRIMARY KEY(tag_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_item ADD CONSTRAINT FK_F1149AA8BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_item ADD CONSTRAINT FK_F1149AA8126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tag_item DROP FOREIGN KEY FK_F1149AA8BAD26311');
        $this->addSql('ALTER TABLE tag_item DROP FOREIGN KEY FK_F1149AA8126F525E');
        $this->addSql('DROP TABLE tag_item');
    }
}
