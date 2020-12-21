<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220120410 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC76CEB5729');
        $this->addSql('DROP TABLE question_logique');
        $this->addSql('DROP INDEX IDX_5FB6DEC76CEB5729 ON reponse');
        $this->addSql('ALTER TABLE reponse DROP question_logique_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question_logique (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, text VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_719B98AABAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE question_logique ADD CONSTRAINT FK_719B98AABAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE reponse ADD question_logique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76CEB5729 FOREIGN KEY (question_logique_id) REFERENCES question_logique (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC76CEB5729 ON reponse (question_logique_id)');
    }
}
