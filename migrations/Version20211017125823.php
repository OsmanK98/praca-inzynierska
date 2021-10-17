<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211017125823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_images ADD number_of_small_size_graphics INT DEFAULT NULL, ADD number_of_medium_size_graphics INT DEFAULT NULL, ADD number_of_big_size_graphics INT DEFAULT NULL, ADD number_of_custom_graphics INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_images DROP number_of_small_size_graphics, DROP number_of_medium_size_graphics, DROP number_of_big_size_graphics, DROP number_of_custom_graphics');
    }
}
