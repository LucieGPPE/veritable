<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224144809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, duree_id INT DEFAULT NULL, type_abonnement_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, date_fin DATE NOT NULL, date_debut DATE NOT NULL, INDEX IDX_351268BBD13C140 (duree_id), INDEX IDX_351268BB813AF326 (type_abonnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonnement_abonnement (abonnement_source INT NOT NULL, abonnement_target INT NOT NULL, INDEX IDX_A7D8126EBDB9C2EC (abonnement_source), INDEX IDX_A7D8126EA45C9263 (abonnement_target), PRIMARY KEY(abonnement_source, abonnement_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, sujet VARCHAR(100) DEFAULT NULL, titre VARCHAR(100) NOT NULL, contenu LONGTEXT NOT NULL, date_publication DATETIME NOT NULL, INDEX IDX_23A0E66FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, box_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, note INT NOT NULL, INDEX IDX_8F91ABF019EB6921 (client_id), INDEX IDX_8F91ABF0D8177B3F (box_id), INDEX IDX_8F91ABF0F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE box (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE box_produit (box_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_30677216D8177B3F (box_id), INDEX IDX_30677216F347EFB (produit_id), PRIMARY KEY(box_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_497DD6343DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (categorie_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_76264285BCF5E72D (categorie_id), INDEX IDX_76264285F347EFB (produit_id), PRIMARY KEY(categorie_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) DEFAULT NULL, lien_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification_produit (certification_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_7C46E211CB47068A (certification_id), INDEX IDX_7C46E211F347EFB (produit_id), PRIMARY KEY(certification_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, complement_adresse VARCHAR(255) DEFAULT NULL, code_postal INT NOT NULL, ville VARCHAR(100) NOT NULL, date_naissance DATE DEFAULT NULL, newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C7440455FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_abonnement (commande_id INT NOT NULL, abonnement_id INT NOT NULL, INDEX IDX_ADD0445D82EA2E54 (commande_id), INDEX IDX_ADD0445DF1D74413 (abonnement_id), PRIMARY KEY(commande_id, abonnement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_box (commande_id INT NOT NULL, box_id INT NOT NULL, INDEX IDX_FF95F6A82EA2E54 (commande_id), INDEX IDX_FF95F6AD8177B3F (box_id), PRIMARY KEY(commande_id, box_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_produit (commande_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_DF1E9E8782EA2E54 (commande_id), INDEX IDX_DF1E9E87F347EFB (produit_id), PRIMARY KEY(commande_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duree (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, pourcentage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_C53D045FF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, provenance VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_produit (ingredient_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_2892E7E1933FE08C (ingredient_id), INDEX IDX_2892E7E1F347EFB (produit_id), PRIMARY KEY(ingredient_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, prix DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, provenance VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_abonnement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, prenom VARCHAR(40) NOT NULL, email VARCHAR(100) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, role VARCHAR(40) NOT NULL, num_tel VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BBD13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB813AF326 FOREIGN KEY (type_abonnement_id) REFERENCES type_abonnement (id)');
        $this->addSql('ALTER TABLE abonnement_abonnement ADD CONSTRAINT FK_A7D8126EBDB9C2EC FOREIGN KEY (abonnement_source) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE abonnement_abonnement ADD CONSTRAINT FK_A7D8126EA45C9263 FOREIGN KEY (abonnement_target) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0D8177B3F FOREIGN KEY (box_id) REFERENCES box (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE box_produit ADD CONSTRAINT FK_30677216D8177B3F FOREIGN KEY (box_id) REFERENCES box (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE box_produit ADD CONSTRAINT FK_30677216F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6343DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE certification_produit ADD CONSTRAINT FK_7C46E211CB47068A FOREIGN KEY (certification_id) REFERENCES certification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE certification_produit ADD CONSTRAINT FK_7C46E211F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande_abonnement ADD CONSTRAINT FK_ADD0445D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_abonnement ADD CONSTRAINT FK_ADD0445DF1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_box ADD CONSTRAINT FK_FF95F6A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_box ADD CONSTRAINT FK_FF95F6AD8177B3F FOREIGN KEY (box_id) REFERENCES box (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ingredient_produit ADD CONSTRAINT FK_2892E7E1933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_produit ADD CONSTRAINT FK_2892E7E1F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BBD13C140');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB813AF326');
        $this->addSql('ALTER TABLE abonnement_abonnement DROP FOREIGN KEY FK_A7D8126EBDB9C2EC');
        $this->addSql('ALTER TABLE abonnement_abonnement DROP FOREIGN KEY FK_A7D8126EA45C9263');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FB88E14F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF019EB6921');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0D8177B3F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F347EFB');
        $this->addSql('ALTER TABLE box_produit DROP FOREIGN KEY FK_30677216D8177B3F');
        $this->addSql('ALTER TABLE box_produit DROP FOREIGN KEY FK_30677216F347EFB');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6343DA5256D');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285BCF5E72D');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285F347EFB');
        $this->addSql('ALTER TABLE certification_produit DROP FOREIGN KEY FK_7C46E211CB47068A');
        $this->addSql('ALTER TABLE certification_produit DROP FOREIGN KEY FK_7C46E211F347EFB');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455FB88E14F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande_abonnement DROP FOREIGN KEY FK_ADD0445D82EA2E54');
        $this->addSql('ALTER TABLE commande_abonnement DROP FOREIGN KEY FK_ADD0445DF1D74413');
        $this->addSql('ALTER TABLE commande_box DROP FOREIGN KEY FK_FF95F6A82EA2E54');
        $this->addSql('ALTER TABLE commande_box DROP FOREIGN KEY FK_FF95F6AD8177B3F');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E8782EA2E54');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87F347EFB');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FF347EFB');
        $this->addSql('ALTER TABLE ingredient_produit DROP FOREIGN KEY FK_2892E7E1933FE08C');
        $this->addSql('ALTER TABLE ingredient_produit DROP FOREIGN KEY FK_2892E7E1F347EFB');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE abonnement_abonnement');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE box');
        $this->addSql('DROP TABLE box_produit');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE certification');
        $this->addSql('DROP TABLE certification_produit');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_abonnement');
        $this->addSql('DROP TABLE commande_box');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE duree');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE type_abonnement');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
