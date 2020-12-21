<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219185737 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_logique_id INT DEFAULT NULL, question_choix_multiples_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC76CEB5729 (question_logique_id), INDEX IDX_5FB6DEC72D5F2B0 (question_choix_multiples_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76CEB5729 FOREIGN KEY (question_logique_id) REFERENCES question_logique (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC72D5F2B0 FOREIGN KEY (question_choix_multiples_id) REFERENCES question_choix_multiples (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reponse');
    }
}
