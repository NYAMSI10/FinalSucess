<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723170823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presence_student (id INT AUTO_INCREMENT NOT NULL, userpresence_id INT DEFAULT NULL, matierepresence_id INT DEFAULT NULL, hourstart VARCHAR(255) NOT NULL, hoursend VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AA792EE63704C950 (userpresence_id), INDEX IDX_AA792EE642AB8412 (matierepresence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE63704C950 FOREIGN KEY (userpresence_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE642AB8412 FOREIGN KEY (matierepresence_id) REFERENCES matiere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE63704C950');
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE642AB8412');
        $this->addSql('DROP TABLE presence_student');
    }
}
