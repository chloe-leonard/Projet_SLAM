<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403195533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement_etablissement (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, idetablissement_id INT NOT NULL, INDEX IDX_5DE14B7EAF07004 (idutilisateur_id), INDEX IDX_5DE14B76BE6364C (idetablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnement_utilisateur (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, idabonne_id INT NOT NULL, INDEX IDX_EB378F92EAF07004 (idutilisateur_id), INDEX IDX_EB378F92BD3E0F63 (idabonne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement_etablissement ADD CONSTRAINT FK_5DE14B7EAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE abonnement_etablissement ADD CONSTRAINT FK_5DE14B76BE6364C FOREIGN KEY (idetablissement_id) REFERENCES etablissement (id)');
        $this->addSql('ALTER TABLE abonnement_utilisateur ADD CONSTRAINT FK_EB378F92EAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE abonnement_utilisateur ADD CONSTRAINT FK_EB378F92BD3E0F63 FOREIGN KEY (idabonne_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ajout_etablissement DROP FOREIGN KEY FK_51460B0AB5B641A2');
        $this->addSql('ALTER TABLE ajout_etablissement DROP FOREIGN KEY FK_51460B0AEAF07004');
        $this->addSql('DROP TABLE ajout_etablissement');
        $this->addSql('ALTER TABLE user CHANGE date_creation date_creation DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ajout_etablissement (id INT AUTO_INCREMENT NOT NULL, idutilisateur_id INT NOT NULL, idlieu_id INT NOT NULL, nom_etablissement VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_51460B0AEAF07004 (idutilisateur_id), UNIQUE INDEX UNIQ_51460B0AB5B641A2 (idlieu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ajout_etablissement ADD CONSTRAINT FK_51460B0AB5B641A2 FOREIGN KEY (idlieu_id) REFERENCES lieu (id)');
        $this->addSql('ALTER TABLE ajout_etablissement ADD CONSTRAINT FK_51460B0AEAF07004 FOREIGN KEY (idutilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE abonnement_etablissement DROP FOREIGN KEY FK_5DE14B7EAF07004');
        $this->addSql('ALTER TABLE abonnement_etablissement DROP FOREIGN KEY FK_5DE14B76BE6364C');
        $this->addSql('ALTER TABLE abonnement_utilisateur DROP FOREIGN KEY FK_EB378F92EAF07004');
        $this->addSql('ALTER TABLE abonnement_utilisateur DROP FOREIGN KEY FK_EB378F92BD3E0F63');
        $this->addSql('DROP TABLE abonnement_etablissement');
        $this->addSql('DROP TABLE abonnement_utilisateur');
        $this->addSql('ALTER TABLE user CHANGE date_creation date_creation DATE NOT NULL');
    }
}
