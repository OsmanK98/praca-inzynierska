<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122185525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_meta ADD page_id INT NOT NULL');
        $this->addSql('ALTER TABLE page_meta ADD CONSTRAINT FK_503608EFC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_503608EFC4663E4 ON page_meta (page_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_meta DROP FOREIGN KEY FK_503608EFC4663E4');
        $this->addSql('DROP INDEX UNIQ_503608EFC4663E4 ON page_meta');
        $this->addSql('ALTER TABLE page_meta DROP page_id');
    }
}
