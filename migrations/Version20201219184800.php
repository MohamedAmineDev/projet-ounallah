<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201219184800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sondage (id INT AUTO_INCREMENT NOT NULL, enqueteur_id INT NOT NULL, sujet_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, nb_particiapants INT NOT NULL, nb_question INT NOT NULL, INDEX IDX_7579C89FDB28D7F1 (enqueteur_id), INDEX IDX_7579C89F7C4D497E (sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sujet (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, image LONGBLOB NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89FDB28D7F1 FOREIGN KEY (enqueteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F7C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89F7C4D497E');
        $this->addSql('DROP TABLE sondage');
        $this->addSql('DROP TABLE sujet');
    }
}
