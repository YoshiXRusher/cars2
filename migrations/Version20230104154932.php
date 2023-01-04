<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104154932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carburant (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, id_modele_id INT DEFAULT NULL, id_carbu_id INT DEFAULT NULL, id_transmi_id INT DEFAULT NULL, id_type_de_boite_id INT DEFAULT NULL, id_marque_id INT DEFAULT NULL, kilometrage INT NOT NULL, price INT NOT NULL, nb_proprio SMALLINT NOT NULL, cylindree INT NOT NULL, puissance_ch INT NOT NULL, puissance_kw INT NOT NULL, year DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', description LONGTEXT NOT NULL, INDEX IDX_95C71D142C210B2D (id_modele_id), INDEX IDX_95C71D1426A5179E (id_carbu_id), INDEX IDX_95C71D149305D9B5 (id_transmi_id), INDEX IDX_95C71D14E05D0FC1 (id_type_de_boite_id), INDEX IDX_95C71D14C8120595 (id_marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images_cars (images_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_AFC92CEBD44F05E5 (images_id), INDEX IDX_AFC92CEB8702F506 (cars_id), PRIMARY KEY(images_id, cars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, name VARCHAR(55) NOT NULL, INDEX IDX_100285584827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transmission (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_de_boite (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D142C210B2D FOREIGN KEY (id_modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1426A5179E FOREIGN KEY (id_carbu_id) REFERENCES carburant (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D149305D9B5 FOREIGN KEY (id_transmi_id) REFERENCES transmission (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14E05D0FC1 FOREIGN KEY (id_type_de_boite_id) REFERENCES type_de_boite (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C8120595 FOREIGN KEY (id_marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE images_cars ADD CONSTRAINT FK_AFC92CEBD44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images_cars ADD CONSTRAINT FK_AFC92CEB8702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D142C210B2D');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1426A5179E');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D149305D9B5');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14E05D0FC1');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C8120595');
        $this->addSql('ALTER TABLE images_cars DROP FOREIGN KEY FK_AFC92CEBD44F05E5');
        $this->addSql('ALTER TABLE images_cars DROP FOREIGN KEY FK_AFC92CEB8702F506');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('DROP TABLE carburant');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE images_cars');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE transmission');
        $this->addSql('DROP TABLE type_de_boite');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
