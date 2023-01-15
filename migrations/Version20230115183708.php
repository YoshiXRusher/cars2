<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230115183708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carburant (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, modele_id INT DEFAULT NULL, carbu_id INT DEFAULT NULL, transmi_id INT DEFAULT NULL, typedeboite_id INT DEFAULT NULL, kilometrage INT NOT NULL, price INT NOT NULL, nbproprio SMALLINT NOT NULL, cylindree INT NOT NULL, puissancech INT NOT NULL, puissancekw INT NOT NULL, year DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', description LONGTEXT NOT NULL, cover VARCHAR(255) NOT NULL, INDEX IDX_95C71D14AC14B70A (modele_id), INDEX IDX_95C71D14767EFB0B (carbu_id), INDEX IDX_95C71D14368F5962 (transmi_id), INDEX IDX_95C71D148D4970DE (typedeboite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_cars (equipement_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_7A1B8424806F0F5C (equipement_id), INDEX IDX_7A1B84248702F506 (cars_id), PRIMARY KEY(equipement_id, cars_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6AC3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, name VARCHAR(55) NOT NULL, year_modele INT NOT NULL, INDEX IDX_100285584827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transmission (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_de_boite (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(6) NOT NULL, city VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14767EFB0B FOREIGN KEY (carbu_id) REFERENCES carburant (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14368F5962 FOREIGN KEY (transmi_id) REFERENCES transmission (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D148D4970DE FOREIGN KEY (typedeboite_id) REFERENCES type_de_boite (id)');
        $this->addSql('ALTER TABLE equipement_cars ADD CONSTRAINT FK_7A1B8424806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_cars ADD CONSTRAINT FK_7A1B84248702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AC3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14AC14B70A');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14767EFB0B');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14368F5962');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D148D4970DE');
        $this->addSql('ALTER TABLE equipement_cars DROP FOREIGN KEY FK_7A1B8424806F0F5C');
        $this->addSql('ALTER TABLE equipement_cars DROP FOREIGN KEY FK_7A1B84248702F506');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AC3C6F69F');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('DROP TABLE carburant');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_cars');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE transmission');
        $this->addSql('DROP TABLE type_de_boite');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
