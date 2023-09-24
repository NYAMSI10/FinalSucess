<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809102006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student ADD periodepresence_id INT DEFAULT NULL, ADD is_accept TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE679EFFA56 FOREIGN KEY (periodepresence_id) REFERENCES periode (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA792EE679EFFA56 ON presence_student (periodepresence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE679EFFA56');
        $this->addSql('DROP INDEX UNIQ_AA792EE679EFFA56 ON presence_student');
        $this->addSql('ALTER TABLE presence_student DROP periodepresence_id, DROP is_accept');
    }
}
