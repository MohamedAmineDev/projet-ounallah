<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220100834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B02D5F2B0');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B06CEB5729');
        $this->addSql('DROP INDEX IDX_5A8600B06CEB5729 ON `option`');
        $this->addSql('DROP INDEX IDX_5A8600B02D5F2B0 ON `option`');
        $this->addSql('ALTER TABLE `option` ADD contenue VARCHAR(255) DEFAULT NULL, DROP question_logique_id, DROP question_choix_multiples_id, DROP choix');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` ADD question_logique_id INT DEFAULT NULL, ADD question_choix_multiples_id INT DEFAULT NULL, ADD choix VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP contenue');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B02D5F2B0 FOREIGN KEY (question_choix_multiples_id) REFERENCES question_choix_multiples (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B06CEB5729 FOREIGN KEY (question_logique_id) REFERENCES question_logique (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B06CEB5729 ON `option` (question_logique_id)');
        $this->addSql('CREATE INDEX IDX_5A8600B02D5F2B0 ON `option` (question_choix_multiples_id)');
    }
}
