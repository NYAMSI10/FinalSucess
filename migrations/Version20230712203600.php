<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230712203600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appel_student (id INT AUTO_INCREMENT NOT NULL, hourstart VARCHAR(255) NOT NULL, hoursend VARCHAR(255) NOT NULL, jour VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, frais INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cotisation (id INT AUTO_INCREMENT NOT NULL, somme VARCHAR(255) NOT NULL, moisbouffe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, somme INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence_teacher (id INT AUTO_INCREMENT NOT NULL, hourstart VARCHAR(255) NOT NULL, hoursend VARCHAR(255) NOT NULL, jour VARCHAR(255) NOT NULL, is_accept TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prime (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, somme INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salaire (id INT AUTO_INCREMENT NOT NULL, mois VARCHAR(255) NOT NULL, montantfrais VARCHAR(255) NOT NULL, nbretravail INT NOT NULL, montantsalaire INT NOT NULL, amical INT NOT NULL, benefcotisation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scolarite (id INT AUTO_INCREMENT NOT NULL, avance INT NOT NULL, reste INT NOT NULL, mois VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appel_student');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cotisation');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE presence_teacher');
        $this->addSql('DROP TABLE prime');
        $this->addSql('DROP TABLE salaire');
        $this->addSql('DROP TABLE scolarite');
    }
}
