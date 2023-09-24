<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827095449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_obtenu (id INT AUTO_INCREMENT NOT NULL, salaireevenobtenu_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, somme VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_693715191AD0F60E (salaireevenobtenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prime_obtenu (id INT AUTO_INCREMENT NOT NULL, salaireprimeobtenu_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, somme VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_5F99B6597B1F8207 (salaireprimeobtenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_obtenu ADD CONSTRAINT FK_693715191AD0F60E FOREIGN KEY (salaireevenobtenu_id) REFERENCES salaire (id)');
        $this->addSql('ALTER TABLE prime_obtenu ADD CONSTRAINT FK_5F99B6597B1F8207 FOREIGN KEY (salaireprimeobtenu_id) REFERENCES salaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_obtenu DROP FOREIGN KEY FK_693715191AD0F60E');
        $this->addSql('ALTER TABLE prime_obtenu DROP FOREIGN KEY FK_5F99B6597B1F8207');
        $this->addSql('DROP TABLE evenement_obtenu');
        $this->addSql('DROP TABLE prime_obtenu');
    }
}
