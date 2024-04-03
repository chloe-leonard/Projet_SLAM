<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403100432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE signalement_compte ADD CONSTRAINT FK_B3A5D0F883C70437 FOREIGN KEY (idsignaleur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE signalement_compte ADD CONSTRAINT FK_B3A5D0F8437984CD FOREIGN KEY (iduser_signale_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE signalement_compte DROP FOREIGN KEY FK_B3A5D0F883C70437');
        $this->addSql('ALTER TABLE signalement_compte DROP FOREIGN KEY FK_B3A5D0F8437984CD');
    }
}
