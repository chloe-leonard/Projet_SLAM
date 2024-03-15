<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216092322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hashtag');

        $this->addSql('CREATE TABLE hashtag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
 //       $this->addSql('ALTER TABLE hashtag ADD idpublication_id INT NOT NULL');
        $this->addSql('ALTER TABLE hashtag ADD CONSTRAINT FK_5AB52A6129CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
        $this->addSql('CREATE INDEX IDX_5AB52A6129CA86EC ON hashtag (idpublication_id)');
        $this->addSql('ALTER TABLE image CHANGE photo photo VARBINARY(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hashtag DROP FOREIGN KEY FK_5AB52A6129CA86EC');
        $this->addSql('DROP INDEX IDX_5AB52A6129CA86EC ON hashtag');
        $this->addSql('ALTER TABLE hashtag DROP idpublication_id');
        $this->addSql('ALTER TABLE image CHANGE photo photo LONGBLOB DEFAULT NULL');
    }
}
