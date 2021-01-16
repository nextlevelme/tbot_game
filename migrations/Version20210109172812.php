<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210109172812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_tg_user (game_id INT NOT NULL, tg_user_id INT NOT NULL, INDEX IDX_13EC3AC4E48FD905 (game_id), INDEX IDX_13EC3AC4922E4C78 (tg_user_id), PRIMARY KEY(game_id, tg_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_tg_user ADD CONSTRAINT FK_13EC3AC4E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_tg_user ADD CONSTRAINT FK_13EC3AC4922E4C78 FOREIGN KEY (tg_user_id) REFERENCES tg_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE game_tg_user');
    }
}
