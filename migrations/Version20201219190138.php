<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219190138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, question_logique_id INT DEFAULT NULL, question_choix_multiples_id INT DEFAULT NULL, choix VARCHAR(255) NOT NULL, INDEX IDX_5A8600B06CEB5729 (question_logique_id), INDEX IDX_5A8600B02D5F2B0 (question_choix_multiples_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B06CEB5729 FOREIGN KEY (question_logique_id) REFERENCES question_logique (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B02D5F2B0 FOREIGN KEY (question_choix_multiples_id) REFERENCES question_choix_multiples (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `option`');
    }
}
