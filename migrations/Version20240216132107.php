<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216132107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, idpublication_id INT NOT NULL, lien LONGTEXT NOT NULL, num_lien INT NOT NULL, INDEX IDX_7CC7DA2C29CA86EC (idpublication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C29CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
//        $this->addSql('ALTER TABLE hashtag ADD idpublication_id INT NOT NULL');
//        $this->addSql('ALTER TABLE hashtag ADD CONSTRAINT FK_5AB52A6129CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
//        $this->addSql('CREATE INDEX IDX_5AB52A6129CA86EC ON hashtag (idpublication_id)');
        $this->addSql('ALTER TABLE image CHANGE photo photo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C29CA86EC');
        $this->addSql('DROP TABLE video');
        $this->addSql('ALTER TABLE hashtag DROP FOREIGN KEY FK_5AB52A6129CA86EC');
        $this->addSql('DROP INDEX IDX_5AB52A6129CA86EC ON hashtag');
        $this->addSql('ALTER TABLE hashtag DROP idpublication_id');
        $this->addSql('ALTER TABLE image CHANGE photo photo LONGBLOB DEFAULT NULL');
    }
}
