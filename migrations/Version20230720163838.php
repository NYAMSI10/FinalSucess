<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720163838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotisation ADD usercotisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2EDE43D9A1A FOREIGN KEY (usercotisation_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_AE64D2EDE43D9A1A ON cotisation (usercotisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2EDE43D9A1A');
        $this->addSql('DROP INDEX IDX_AE64D2EDE43D9A1A ON cotisation');
        $this->addSql('ALTER TABLE cotisation DROP usercotisation_id');
    }
}
