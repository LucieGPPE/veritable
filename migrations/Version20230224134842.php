<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224134842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE certification (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) DEFAULT NULL, lien_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification_produit (certification_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_7C46E211CB47068A (certification_id), INDEX IDX_7C46E211F347EFB (produit_id), PRIMARY KEY(certification_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, provenance VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_produit (ingredient_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_2892E7E1933FE08C (ingredient_id), INDEX IDX_2892E7E1F347EFB (produit_id), PRIMARY KEY(ingredient_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE certification_produit ADD CONSTRAINT FK_7C46E211CB47068A FOREIGN KEY (certification_id) REFERENCES certification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE certification_produit ADD CONSTRAINT FK_7C46E211F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_produit ADD CONSTRAINT FK_2892E7E1933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_produit ADD CONSTRAINT FK_2892E7E1F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certification_produit DROP FOREIGN KEY FK_7C46E211CB47068A');
        $this->addSql('ALTER TABLE certification_produit DROP FOREIGN KEY FK_7C46E211F347EFB');
        $this->addSql('ALTER TABLE ingredient_produit DROP FOREIGN KEY FK_2892E7E1933FE08C');
        $this->addSql('ALTER TABLE ingredient_produit DROP FOREIGN KEY FK_2892E7E1F347EFB');
        $this->addSql('DROP TABLE certification');
        $this->addSql('DROP TABLE certification_produit');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_produit');
    }
}
