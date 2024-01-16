<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021093921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logement CHANGE code code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sejour CHANGE voyageur_id voyageur_id INT NOT NULL, CHANGE logement_id logement_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logement CHANGE code code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sejour CHANGE voyageur_id voyageur_id INT DEFAULT NULL, CHANGE logement_id logement_id INT DEFAULT NULL');
    }
}
