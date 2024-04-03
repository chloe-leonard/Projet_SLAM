<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403092919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ajout_etablissement (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, idlieu_id INT NOT NULL, nom_etablissement VARCHAR(250) NOT NULL, UNIQUE INDEX UNIQ_51460B0AEAF07004 (idutilisateur_id), UNIQUE INDEX UNIQ_51460B0AB5B641A2 (idlieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, idpublication_id INT NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_67F068BCEAF07004 (idutilisateur_id), INDEX IDX_67F068BC29CA86EC (idpublication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, id_lieu INT NOT NULL, nom_etablissement VARCHAR(250) NOT NULL, INDEX IDX_20FD592CA477615B (id_lieu), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, idpublication_id INT NOT NULL, photo VARCHAR(255) NOT NULL, num_image INT NOT NULL, INDEX IDX_C53D045F29CA86EC (idpublication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, code_postal VARCHAR(5) NOT NULL, ville VARCHAR(200) NOT NULL, pays VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, titre VARCHAR(200) NOT NULL, description LONGTEXT DEFAULT NULL, date_heure DATETIME NOT NULL, duree_retard TIME NOT NULL, INDEX IDX_AF3C6779EAF07004 (idutilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, pseudo VARCHAR(50) NOT NULL, bio LONGTEXT DEFAULT NULL, avatar VARBINARY(255) DEFAULT NULL, mail VARCHAR(150) NOT NULL, mot_de_passe VARCHAR(100) NOT NULL, nb_signalement INT DEFAULT NULL, id_etablissement INT DEFAULT NULL, date_creation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, idpublication_id INT NOT NULL, lien LONGTEXT NOT NULL, num_lien INT NOT NULL, INDEX IDX_7CC7DA2C29CA86EC (idpublication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ajout_etablissement ADD CONSTRAINT FK_51460B0AEAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ajout_etablissement ADD CONSTRAINT FK_51460B0AB5B641A2 FOREIGN KEY (idlieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCEAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC29CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CA477615B FOREIGN KEY (id_lieu) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F29CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779EAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C29CA86EC FOREIGN KEY (idpublication_id) REFERENCES publication (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajout_etablissement DROP FOREIGN KEY FK_51460B0AEAF07004');
        $this->addSql('ALTER TABLE ajout_etablissement DROP FOREIGN KEY FK_51460B0AB5B641A2');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCEAF07004');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC29CA86EC');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CA477615B');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F29CA86EC');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779EAF07004');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C29CA86EC');
        $this->addSql('DROP TABLE ajout_etablissement');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
