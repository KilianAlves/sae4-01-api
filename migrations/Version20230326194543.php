<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326194543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, date_deces DATE DEFAULT NULL, robe VARCHAR(50) NOT NULL, num_puce VARCHAR(50) NOT NULL, commentaire VARCHAR(256) NOT NULL, poids DOUBLE PRECISION NOT NULL, num_tatouage VARCHAR(50) NOT NULL, a_disparu INT NOT NULL, est_agressif INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, solde DOUBLE PRECISION DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creneau (id INT AUTO_INCREMENT NOT NULL, debut DOUBLE PRECISION NOT NULL, fin DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, veterinaire_id INT NOT NULL, motif VARCHAR(50) NOT NULL, date_rdv DATE NOT NULL, est_urgent INT NOT NULL, commentaire_veto VARCHAR(50) NOT NULL, est_domicile INT NOT NULL, horaire INT NOT NULL, INDEX IDX_65E8AA0A19EB6921 (client_id), INDEX IDX_65E8AA0A5C80924 (veterinaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `utilisateur` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, tel VARCHAR(50) NOT NULL, cp VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, complement_adresse VARCHAR(50) NOT NULL, civilite VARCHAR(50) NOT NULL, discriminator VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccin (id INT AUTO_INCREMENT NOT NULL, date_rappel DATE NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES `utilisateur` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A5C80924 FOREIGN KEY (veterinaire_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B8BF396750 FOREIGN KEY (id) REFERENCES `utilisateur` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A19EB6921');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A5C80924');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B8BF396750');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE creneau');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE `utilisateur`');
        $this->addSql('DROP TABLE vaccin');
        $this->addSql('DROP TABLE veterinaire');
    }
}
