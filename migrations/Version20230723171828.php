<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723171828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presence_student_user (presence_student_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_38074B9CE9F0A93C (presence_student_id), INDEX IDX_38074B9CA76ED395 (user_id), PRIMARY KEY(presence_student_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presence_student_user ADD CONSTRAINT FK_38074B9CE9F0A93C FOREIGN KEY (presence_student_id) REFERENCES presence_student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presence_student_user ADD CONSTRAINT FK_38074B9CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE presence_student_user DROP FOREIGN KEY FK_38074B9CE9F0A93C');
        $this->addSql('ALTER TABLE presence_student_user DROP FOREIGN KEY FK_38074B9CA76ED395');
        $this->addSql('DROP TABLE presence_student_user');
    }
}
