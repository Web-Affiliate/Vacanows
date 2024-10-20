<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241020121728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_app DROP FOREIGN KEY FK_FAB5E7F9D0113AD8');
        $this->addSql('ALTER TABLE users_app DROP FOREIGN KEY FK_FAB5E7F98E2368AB');
        $this->addSql('ALTER TABLE game_room DROP FOREIGN KEY FK_998A3DB754177093');
        $this->addSql('ALTER TABLE game_room DROP FOREIGN KEY FK_998A3DB711FC5C09');
        $this->addSql('ALTER TABLE game_room DROP FOREIGN KEY FK_998A3DB7A21214B7');
        $this->addSql('ALTER TABLE game_room DROP FOREIGN KEY FK_998A3DB7349F3E7');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE users_app');
        $this->addSql('DROP TABLE game_room');
        $this->addSql('ALTER TABLE categories CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment ADD article_id INT DEFAULT NULL, CHANGE date_creation date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('CREATE INDEX IDX_9474526C7294869C ON comment (article_id)');
        $this->addSql('ALTER TABLE sous_categories1 CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, participants INT NOT NULL, is_started TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users_app (id INT AUTO_INCREMENT NOT NULL, rooms_id INT NOT NULL, gameroom_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FAB5E7F98E2368AB (rooms_id), INDEX IDX_FAB5E7F9D0113AD8 (gameroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE game_room (id INT AUTO_INCREMENT NOT NULL, room_id INT NOT NULL, categories_id INT DEFAULT NULL, souscategories1_id INT DEFAULT NULL, souscategories2_id INT DEFAULT NULL, INDEX IDX_998A3DB7349F3E7 (souscategories2_id), INDEX IDX_998A3DB754177093 (room_id), INDEX IDX_998A3DB7A21214B7 (categories_id), INDEX IDX_998A3DB711FC5C09 (souscategories1_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users_app ADD CONSTRAINT FK_FAB5E7F9D0113AD8 FOREIGN KEY (gameroom_id) REFERENCES game_room (id)');
        $this->addSql('ALTER TABLE users_app ADD CONSTRAINT FK_FAB5E7F98E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE game_room ADD CONSTRAINT FK_998A3DB754177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE game_room ADD CONSTRAINT FK_998A3DB711FC5C09 FOREIGN KEY (souscategories1_id) REFERENCES sous_categories1 (id)');
        $this->addSql('ALTER TABLE game_room ADD CONSTRAINT FK_998A3DB7A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE game_room ADD CONSTRAINT FK_998A3DB7349F3E7 FOREIGN KEY (souscategories2_id) REFERENCES sous_categories2 (id)');
        $this->addSql('ALTER TABLE categories CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('DROP INDEX IDX_9474526C7294869C ON comment');
        $this->addSql('ALTER TABLE comment DROP article_id, CHANGE date_creation date_creation DATE NOT NULL');
        $this->addSql('ALTER TABLE sous_categories1 CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
