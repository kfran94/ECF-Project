<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230408111805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, category VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_link_dish (id INT AUTO_INCREMENT NOT NULL, menu_id_id INT NOT NULL, dish_id_id INT NOT NULL, INDEX IDX_3D7A7925EEE8BD30 (menu_id_id), INDEX IDX_3D7A7925157EBC1A (dish_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, size INT NOT NULL, type VARCHAR(20) NOT NULL, bin LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, service SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_link (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, reservation_id_id INT NOT NULL, number_seat INT NOT NULL, allergen VARCHAR(255) DEFAULT NULL, INDEX IDX_20955499DC2902E0 (client_id_id), INDEX IDX_209554993C3B4EF0 (reservation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_link_dish ADD CONSTRAINT FK_3D7A7925EEE8BD30 FOREIGN KEY (menu_id_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_link_dish ADD CONSTRAINT FK_3D7A7925157EBC1A FOREIGN KEY (dish_id_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE reservation_link ADD CONSTRAINT FK_20955499DC2902E0 FOREIGN KEY (client_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_link ADD CONSTRAINT FK_209554993C3B4EF0 FOREIGN KEY (reservation_id_id) REFERENCES reservation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_link_dish DROP FOREIGN KEY FK_3D7A7925EEE8BD30');
        $this->addSql('ALTER TABLE menu_link_dish DROP FOREIGN KEY FK_3D7A7925157EBC1A');
        $this->addSql('ALTER TABLE reservation_link DROP FOREIGN KEY FK_20955499DC2902E0');
        $this->addSql('ALTER TABLE reservation_link DROP FOREIGN KEY FK_209554993C3B4EF0');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_link_dish');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_link');
    }
}
