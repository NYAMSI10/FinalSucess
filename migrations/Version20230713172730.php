<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713172730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel_student ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE classe ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE cotisation ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE periode ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE presence_teacher ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE prime ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE salaire ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE scolarite ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD create_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE periode DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE salaire DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE matiere DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE `user` DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE evenement DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE cotisation DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE prime DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE classe DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE scolarite DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE appel_student DROP create_at, DROP updated_at');
        $this->addSql('ALTER TABLE presence_teacher DROP create_at, DROP updated_at');
    }
}
