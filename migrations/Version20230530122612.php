<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530122612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE critere_voiture (critere_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_1CF825879E5F45AB (critere_id), INDEX IDX_1CF82587181A8BA (voiture_id), PRIMARY KEY(critere_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, nom_garage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu (id INT AUTO_INCREMENT NOT NULL, garage_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(5) NOT NULL, ville VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2F577D59C4FFF555 (garage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, garage_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, lien_image VARCHAR(255) NOT NULL, prix_location DOUBLE PRECISION NOT NULL, INDEX IDX_E9E2810FC4FFF555 (garage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE critere_voiture ADD CONSTRAINT FK_1CF825879E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_voiture ADD CONSTRAINT FK_1CF82587181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critere_voiture DROP FOREIGN KEY FK_1CF825879E5F45AB');
        $this->addSql('ALTER TABLE critere_voiture DROP FOREIGN KEY FK_1CF82587181A8BA');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59C4FFF555');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FC4FFF555');
        $this->addSql('DROP TABLE critere');
        $this->addSql('DROP TABLE critere_voiture');
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
