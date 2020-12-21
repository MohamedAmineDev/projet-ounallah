<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220094508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, texte VARCHAR(255) NOT NULL, INDEX IDX_B6F7494EBAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE `option` ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B01E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_5A8600B01E27F6BF ON `option` (question_id)');
        $this->addSql('ALTER TABLE reponse ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC71E27F6BF ON reponse (question_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B01E27F6BF');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP INDEX IDX_5A8600B01E27F6BF ON `option`');
        $this->addSql('ALTER TABLE `option` DROP question_id');
        $this->addSql('DROP INDEX IDX_5FB6DEC71E27F6BF ON reponse');
        $this->addSql('ALTER TABLE reponse DROP question_id');
    }
}
