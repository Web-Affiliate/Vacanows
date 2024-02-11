<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211210819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE articles DROP INDEX guides_id, ADD INDEX IDX_BFDD31686A8C820 (guides_id)');
        $this->addSql('ALTER TABLE articles CHANGE paragraph_1 paragraph_1 VARCHAR(255) NOT NULL, CHANGE paragraph_2 paragraph_2 VARCHAR(255) NOT NULL, CHANGE paragraph_3 paragraph_3 VARCHAR(255) NOT NULL, CHANGE paragraph_4 paragraph_4 VARCHAR(255) NOT NULL, CHANGE tab_col_url_1 tab_col_url_1 VARCHAR(255) NOT NULL, CHANGE tab_col_url_2 tab_col_url_2 VARCHAR(255) NOT NULL, CHANGE tab_col_url_3 tab_col_url_3 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE content CHANGE paragraph_header paragraph_header VARCHAR(255) NOT NULL, CHANGE paragraph_1 paragraph_1 VARCHAR(255) NOT NULL, CHANGE paragraph_2 paragraph_2 VARCHAR(255) NOT NULL, CHANGE paragraph_3 paragraph_3 VARCHAR(255) NOT NULL, CHANGE paragraph_4 paragraph_4 VARCHAR(255) NOT NULL, CHANGE paragraph_5 paragraph_5 VARCHAR(255) NOT NULL, CHANGE paragraph_6 paragraph_6 VARCHAR(255) NOT NULL, CHANGE paragraph_7 paragraph_7 VARCHAR(255) NOT NULL, CHANGE paragraph_8 paragraph_8 VARCHAR(255) NOT NULL, CHANGE paragraph_9 paragraph_9 VARCHAR(255) NOT NULL, CHANGE paragraph_10 paragraph_10 VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE content CHANGE paragraph_header paragraph_header LONGTEXT NOT NULL, CHANGE paragraph_1 paragraph_1 LONGTEXT NOT NULL, CHANGE paragraph_2 paragraph_2 LONGTEXT NOT NULL, CHANGE paragraph_3 paragraph_3 LONGTEXT NOT NULL, CHANGE paragraph_4 paragraph_4 LONGTEXT NOT NULL, CHANGE paragraph_5 paragraph_5 LONGTEXT NOT NULL, CHANGE paragraph_6 paragraph_6 LONGTEXT NOT NULL, CHANGE paragraph_7 paragraph_7 LONGTEXT NOT NULL, CHANGE paragraph_8 paragraph_8 LONGTEXT NOT NULL, CHANGE paragraph_9 paragraph_9 LONGTEXT NOT NULL, CHANGE paragraph_10 paragraph_10 LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE articles DROP INDEX IDX_BFDD31686A8C820, ADD UNIQUE INDEX guides_id (guides_id)');
        $this->addSql('ALTER TABLE articles CHANGE paragraph_1 paragraph_1 LONGTEXT NOT NULL, CHANGE paragraph_2 paragraph_2 LONGTEXT NOT NULL, CHANGE paragraph_3 paragraph_3 LONGTEXT NOT NULL, CHANGE paragraph_4 paragraph_4 LONGTEXT NOT NULL, CHANGE tab_col_url_1 tab_col_url_1 LONGTEXT NOT NULL, CHANGE tab_col_url_2 tab_col_url_2 LONGTEXT NOT NULL, CHANGE tab_col_url_3 tab_col_url_3 LONGTEXT NOT NULL');
    }
}
