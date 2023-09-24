<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827103821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salaire ADD periodesalaire_id INT DEFAULT NULL, ADD usersalaire_id INT DEFAULT NULL, ADD cotisation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE salaire ADD CONSTRAINT FK_3BCBBD1184B4B99A FOREIGN KEY (periodesalaire_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE salaire ADD CONSTRAINT FK_3BCBBD116B04EB78 FOREIGN KEY (usersalaire_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_3BCBBD1184B4B99A ON salaire (periodesalaire_id)');
        $this->addSql('CREATE INDEX IDX_3BCBBD116B04EB78 ON salaire (usersalaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salaire DROP FOREIGN KEY FK_3BCBBD1184B4B99A');
        $this->addSql('ALTER TABLE salaire DROP FOREIGN KEY FK_3BCBBD116B04EB78');
        $this->addSql('DROP INDEX IDX_3BCBBD1184B4B99A ON salaire');
        $this->addSql('DROP INDEX IDX_3BCBBD116B04EB78 ON salaire');
        $this->addSql('ALTER TABLE salaire DROP periodesalaire_id, DROP usersalaire_id, DROP cotisation');
    }
}
