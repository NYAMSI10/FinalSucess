<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827153457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_obtenu DROP INDEX UNIQ_693715191AD0F60E, ADD INDEX IDX_693715191AD0F60E (salaireevenobtenu_id)');
        $this->addSql('ALTER TABLE prime_obtenu DROP INDEX UNIQ_5F99B6597B1F8207, ADD INDEX IDX_5F99B6597B1F8207 (salaireprimeobtenu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_obtenu DROP INDEX IDX_693715191AD0F60E, ADD UNIQUE INDEX UNIQ_693715191AD0F60E (salaireevenobtenu_id)');
        $this->addSql('ALTER TABLE prime_obtenu DROP INDEX IDX_5F99B6597B1F8207, ADD UNIQUE INDEX UNIQ_5F99B6597B1F8207 (salaireprimeobtenu_id)');
    }
}
