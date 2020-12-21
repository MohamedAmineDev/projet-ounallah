<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220172441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cadeau ADD sondage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cadeau ADD CONSTRAINT FK_3D213460BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3D213460BAF4AE56 ON cadeau (sondage_id)');
        $this->addSql('ALTER TABLE nouveau_type ADD sondage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nouveau_type ADD CONSTRAINT FK_13BF4AD7BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_13BF4AD7BAF4AE56 ON nouveau_type (sondage_id)');
        $this->addSql('ALTER TABLE remise ADD sondage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE remise ADD CONSTRAINT FK_117A95C7BAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_117A95C7BAF4AE56 ON remise (sondage_id)');
        $this->addSql('ALTER TABLE sondage CHANGE nb_question nb_question INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cadeau DROP FOREIGN KEY FK_3D213460BAF4AE56');
        $this->addSql('DROP INDEX UNIQ_3D213460BAF4AE56 ON cadeau');
        $this->addSql('ALTER TABLE cadeau DROP sondage_id');
        $this->addSql('ALTER TABLE nouveau_type DROP FOREIGN KEY FK_13BF4AD7BAF4AE56');
        $this->addSql('DROP INDEX UNIQ_13BF4AD7BAF4AE56 ON nouveau_type');
        $this->addSql('ALTER TABLE nouveau_type DROP sondage_id');
        $this->addSql('ALTER TABLE remise DROP FOREIGN KEY FK_117A95C7BAF4AE56');
        $this->addSql('DROP INDEX UNIQ_117A95C7BAF4AE56 ON remise');
        $this->addSql('ALTER TABLE remise DROP sondage_id');
        $this->addSql('ALTER TABLE sondage CHANGE nb_question nb_question INT DEFAULT NULL');
    }
}
