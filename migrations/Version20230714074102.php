<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230714074102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_periode (user_id INT NOT NULL, periode_id INT NOT NULL, INDEX IDX_CBCE33F9A76ED395 (user_id), INDEX IDX_CBCE33F9F384C1CF (periode_id), PRIMARY KEY(user_id, periode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_classe (user_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_EAD5A4ABA76ED395 (user_id), INDEX IDX_EAD5A4AB8F5EA509 (classe_id), PRIMARY KEY(user_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_matiere (user_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_C8194940A76ED395 (user_id), INDEX IDX_C8194940F46CD258 (matiere_id), PRIMARY KEY(user_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_prime (user_id INT NOT NULL, prime_id INT NOT NULL, INDEX IDX_B689F40FA76ED395 (user_id), INDEX IDX_B689F40F69247986 (prime_id), PRIMARY KEY(user_id, prime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_evenement (user_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_BC6E5FAA76ED395 (user_id), INDEX IDX_BC6E5FAFD02F13 (evenement_id), PRIMARY KEY(user_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_periode ADD CONSTRAINT FK_CBCE33F9A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_periode ADD CONSTRAINT FK_CBCE33F9F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_classe ADD CONSTRAINT FK_EAD5A4ABA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_classe ADD CONSTRAINT FK_EAD5A4AB8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_matiere ADD CONSTRAINT FK_C8194940A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_matiere ADD CONSTRAINT FK_C8194940F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prime ADD CONSTRAINT FK_B689F40FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prime ADD CONSTRAINT FK_B689F40F69247986 FOREIGN KEY (prime_id) REFERENCES prime (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_evenement ADD CONSTRAINT FK_BC6E5FAA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_evenement ADD CONSTRAINT FK_BC6E5FAFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_periode DROP FOREIGN KEY FK_CBCE33F9A76ED395');
        $this->addSql('ALTER TABLE user_periode DROP FOREIGN KEY FK_CBCE33F9F384C1CF');
        $this->addSql('ALTER TABLE user_classe DROP FOREIGN KEY FK_EAD5A4ABA76ED395');
        $this->addSql('ALTER TABLE user_classe DROP FOREIGN KEY FK_EAD5A4AB8F5EA509');
        $this->addSql('ALTER TABLE user_matiere DROP FOREIGN KEY FK_C8194940A76ED395');
        $this->addSql('ALTER TABLE user_matiere DROP FOREIGN KEY FK_C8194940F46CD258');
        $this->addSql('ALTER TABLE user_prime DROP FOREIGN KEY FK_B689F40FA76ED395');
        $this->addSql('ALTER TABLE user_prime DROP FOREIGN KEY FK_B689F40F69247986');
        $this->addSql('ALTER TABLE user_evenement DROP FOREIGN KEY FK_BC6E5FAA76ED395');
        $this->addSql('ALTER TABLE user_evenement DROP FOREIGN KEY FK_BC6E5FAFD02F13');
        $this->addSql('DROP TABLE user_periode');
        $this->addSql('DROP TABLE user_classe');
        $this->addSql('DROP TABLE user_matiere');
        $this->addSql('DROP TABLE user_prime');
        $this->addSql('DROP TABLE user_evenement');
    }
}
