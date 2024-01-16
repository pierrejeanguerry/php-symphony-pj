<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116100746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA76ED395');
        $this->addSql('DROP INDEX IDX_1F1B251EA76ED395 ON item');
        $this->addSql('ALTER TABLE item ADD validator_id INT DEFAULT NULL, CHANGE user_id creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EB0644AEC FOREIGN KEY (validator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E61220EA6 ON item (creator_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251EB0644AEC ON item (validator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E61220EA6');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EB0644AEC');
        $this->addSql('DROP INDEX IDX_1F1B251E61220EA6 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251EB0644AEC ON item');
        $this->addSql('ALTER TABLE item ADD user_id INT DEFAULT NULL, DROP creator_id, DROP validator_id');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1F1B251EA76ED395 ON item (user_id)');
    }
}
