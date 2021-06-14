<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210606215351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offredemploi (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, titreauposte VARCHAR(255) NOT NULL, nombreposte VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, secteurenp VARCHAR(255) NOT NULL, salaire VARCHAR(255) DEFAULT NULL, local VARCHAR(255) DEFAULT NULL, INDEX IDX_B94E2179A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offredemploi ADD CONSTRAINT FK_B94E2179A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE offredemploi');
    }
}
