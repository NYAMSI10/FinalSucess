<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230715124729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, histscolarite_id INT DEFAULT NULL, somme VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_EDBFD5ECAF586744 (histscolarite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECAF586744 FOREIGN KEY (histscolarite_id) REFERENCES scolarite (id)');
        $this->addSql('ALTER TABLE scolarite ADD userscolarite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scolarite ADD CONSTRAINT FK_276250AB5DCD51DD FOREIGN KEY (userscolarite_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_276250AB5DCD51DD ON scolarite (userscolarite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECAF586744');
        $this->addSql('DROP TABLE historique');
        $this->addSql('ALTER TABLE scolarite DROP FOREIGN KEY FK_276250AB5DCD51DD');
        $this->addSql('DROP INDEX IDX_276250AB5DCD51DD ON scolarite');
        $this->addSql('ALTER TABLE scolarite DROP userscolarite_id');
    }
}
