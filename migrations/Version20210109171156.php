<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109171156 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD tg_chat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C2FDAEEC8 FOREIGN KEY (tg_chat_id) REFERENCES tg_chat (id)');
        $this->addSql('CREATE INDEX IDX_232B318C2FDAEEC8 ON game (tg_chat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C2FDAEEC8');
        $this->addSql('DROP INDEX IDX_232B318C2FDAEEC8 ON game');
        $this->addSql('ALTER TABLE game DROP tg_chat_id');
    }
}
