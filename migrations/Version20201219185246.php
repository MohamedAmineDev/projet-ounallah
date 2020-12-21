<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219185246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question_choix_multiples (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_9574480FBAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_logique (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_719B98AABAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_choix_multiples ADD CONSTRAINT FK_9574480FBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE question_logique ADD CONSTRAINT FK_719B98AABAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE question_choix_multiples');
        $this->addSql('DROP TABLE question_logique');
    }
}
