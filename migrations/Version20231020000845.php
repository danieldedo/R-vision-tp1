<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020000845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logement (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, capacite INT NOT NULL, type VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, disponibilite TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sejour (id INT AUTO_INCREMENT NOT NULL, voyageur_id INT DEFAULT NULL, logement_id INT DEFAULT NULL, debut DATE DEFAULT NULL, fin DATE DEFAULT NULL, INDEX IDX_96F5202862915402 (voyageur_id), INDEX IDX_96F5202858ABF955 (logement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyageur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F5202862915402 FOREIGN KEY (voyageur_id) REFERENCES voyageur (id)');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F5202858ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F5202862915402');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F5202858ABF955');
        $this->addSql('DROP TABLE logement');
        $this->addSql('DROP TABLE sejour');
        $this->addSql('DROP TABLE voyageur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
