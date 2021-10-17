<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210801141101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_headings (id INT AUTO_INCREMENT NOT NULL, page_id INT DEFAULT NULL, quantity_h1 INT DEFAULT NULL, average_word_count_in_h1 DOUBLE PRECISION DEFAULT NULL, quantity_h2 INT DEFAULT NULL, average_word_count_in_h2 DOUBLE PRECISION DEFAULT NULL, quantity_h3 INT DEFAULT NULL, average_word_count_in_h3 DOUBLE PRECISION DEFAULT NULL, quantity_h4 INT DEFAULT NULL, average_word_count_in_h4 DOUBLE PRECISION DEFAULT NULL, quantity_h5 INT DEFAULT NULL, average_word_count_in_h5 DOUBLE PRECISION DEFAULT NULL, quantity_h6 INT DEFAULT NULL, average_word_count_in_h6 DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_77F08E32C4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_headings ADD CONSTRAINT FK_77F08E32C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_headings DROP FOREIGN KEY FK_77F08E32C4663E4');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_headings');
    }
}
