<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307094521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677965827D0B');
        $this->addSql('DROP TABLE hashtags');
        $this->addSql('DROP INDEX IDX_AF3C677965827D0B ON publication');
        $this->addSql('ALTER TABLE publication DROP hashtags_id');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hashtags (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE publication ADD hashtags_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677965827D0B FOREIGN KEY (hashtags_id) REFERENCES hashtags (id)');
        $this->addSql('CREATE INDEX IDX_AF3C677965827D0B ON publication (hashtags_id)');
        $this->addSql('ALTER TABLE user DROP reset_token');
    }
}
