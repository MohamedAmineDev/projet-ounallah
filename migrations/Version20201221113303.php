<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221113303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cadeau (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, contenu VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_3D213460BAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation_user (conversation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5AECB5559AC0396 (conversation_id), INDEX IDX_5AECB555A76ED395 (user_id), PRIMARY KEY(conversation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, conversation_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_DB021E969AC0396 (conversation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nouveau_type (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, offre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_13BF4AD7BAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, contenue VARCHAR(255) DEFAULT NULL, INDEX IDX_5A8600B01E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, texte VARCHAR(255) NOT NULL, INDEX IDX_B6F7494EBAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_choix_multiples (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_9574480FBAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remise (id INT AUTO_INCREMENT NOT NULL, sondage_id INT DEFAULT NULL, pourcentage DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_117A95C7BAF4AE56 (sondage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_choix_multiples_id INT DEFAULT NULL, user_id INT DEFAULT NULL, question_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC72D5F2B0 (question_choix_multiples_id), INDEX IDX_5FB6DEC7A76ED395 (user_id), INDEX IDX_5FB6DEC71E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sondage (id INT AUTO_INCREMENT NOT NULL, enqueteur_id INT NOT NULL, sujet_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, nb_participant INT DEFAULT NULL, nb_question INT DEFAULT NULL, remun VARCHAR(255) NOT NULL, INDEX IDX_7579C89FDB28D7F1 (enqueteur_id), INDEX IDX_7579C89F7C4D497E (sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sujet (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, nom VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_naissance DATE DEFAULT NULL, tel INT DEFAULT NULL, matricule_fiscale LONGBLOB DEFAULT NULL, registre_des_commerces LONGBLOB DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, genre TINYINT(1) DEFAULT NULL, cin INT DEFAULT NULL, age INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cadeau ADD CONSTRAINT FK_3D213460BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE conversation_user ADD CONSTRAINT FK_5AECB5559AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conversation_user ADD CONSTRAINT FK_5AECB555A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E969AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id)');
        $this->addSql('ALTER TABLE nouveau_type ADD CONSTRAINT FK_13BF4AD7BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B01E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE question_choix_multiples ADD CONSTRAINT FK_9574480FBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE remise ADD CONSTRAINT FK_117A95C7BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC72D5F2B0 FOREIGN KEY (question_choix_multiples_id) REFERENCES question_choix_multiples (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89FDB28D7F1 FOREIGN KEY (enqueteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F7C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation_user DROP FOREIGN KEY FK_5AECB5559AC0396');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E969AC0396');
        $this->addSql('ALTER TABLE `option` DROP FOREIGN KEY FK_5A8600B01E27F6BF');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E27F6BF');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC72D5F2B0');
        $this->addSql('ALTER TABLE cadeau DROP FOREIGN KEY FK_3D213460BAF4AE56');
        $this->addSql('ALTER TABLE nouveau_type DROP FOREIGN KEY FK_13BF4AD7BAF4AE56');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBAF4AE56');
        $this->addSql('ALTER TABLE question_choix_multiples DROP FOREIGN KEY FK_9574480FBAF4AE56');
        $this->addSql('ALTER TABLE remise DROP FOREIGN KEY FK_117A95C7BAF4AE56');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89F7C4D497E');
        $this->addSql('ALTER TABLE conversation_user DROP FOREIGN KEY FK_5AECB555A76ED395');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A76ED395');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89FDB28D7F1');
        $this->addSql('DROP TABLE cadeau');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE conversation_user');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE nouveau_type');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_choix_multiples');
        $this->addSql('DROP TABLE remise');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE sondage');
        $this->addSql('DROP TABLE sujet');
        $this->addSql('DROP TABLE user');
    }
}
