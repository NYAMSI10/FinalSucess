<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809171803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student ADD classepresence_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE63558EE97 FOREIGN KEY (classepresence_id) REFERENCES classe (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA792EE63558EE97 ON presence_student (classepresence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE63558EE97');
        $this->addSql('DROP INDEX UNIQ_AA792EE63558EE97 ON presence_student');
        $this->addSql('ALTER TABLE presence_student DROP classepresence_id');
    }
}