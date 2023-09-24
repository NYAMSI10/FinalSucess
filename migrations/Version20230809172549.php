<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809172549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student DROP INDEX UNIQ_AA792EE679EFFA56, ADD INDEX IDX_AA792EE679EFFA56 (periodepresence_id)');
        $this->addSql('ALTER TABLE presence_student DROP INDEX UNIQ_AA792EE63558EE97, ADD INDEX IDX_AA792EE63558EE97 (classepresence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student DROP INDEX IDX_AA792EE679EFFA56, ADD UNIQUE INDEX UNIQ_AA792EE679EFFA56 (periodepresence_id)');
        $this->addSql('ALTER TABLE presence_student DROP INDEX IDX_AA792EE63558EE97, ADD UNIQUE INDEX UNIQ_AA792EE63558EE97 (classepresence_id)');
    }
}
