<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314143205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, idpublication_id INT NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_67F068BCEAF07004 (idutilisateur_id), INDEX IDX_67F068BC29CA86EC (idpublication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCEAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC29CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCEAF07004');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC29CA86EC');
        $this->addSql('DROP TABLE commentaire');
    }
}
