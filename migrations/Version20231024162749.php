<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024162749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, frais INT NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cotisation (id INT AUTO_INCREMENT NOT NULL, usercotisation_id INT DEFAULT NULL, somme VARCHAR(255) NOT NULL, moisbouffe VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AE64D2EDE43D9A1A (usercotisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, somme INT DEFAULT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, end DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_obtenu (id INT AUTO_INCREMENT NOT NULL, salaireevenobtenu_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, somme VARCHAR(255) DEFAULT NULL, INDEX IDX_693715191AD0F60E (salaireevenobtenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, histscolarite_id INT DEFAULT NULL, somme VARCHAR(255) NOT NULL, mois VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_EDBFD5ECAF586744 (histscolarite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence_student (id INT AUTO_INCREMENT NOT NULL, userpresence_id INT DEFAULT NULL, matierepresence_id INT DEFAULT NULL, periodepresence_id INT DEFAULT NULL, classepresence_id INT DEFAULT NULL, hourstart VARCHAR(255) NOT NULL, hoursend VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_accept TINYINT(1) DEFAULT NULL, datejours VARCHAR(255) DEFAULT NULL, INDEX IDX_AA792EE63704C950 (userpresence_id), INDEX IDX_AA792EE642AB8412 (matierepresence_id), INDEX IDX_AA792EE679EFFA56 (periodepresence_id), INDEX IDX_AA792EE63558EE97 (classepresence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence_student_user (presence_student_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_38074B9CE9F0A93C (presence_student_id), INDEX IDX_38074B9CA76ED395 (user_id), PRIMARY KEY(presence_student_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prime (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, somme INT NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prime_obtenu (id INT AUTO_INCREMENT NOT NULL, salaireprimeobtenu_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, somme VARCHAR(255) DEFAULT NULL, INDEX IDX_5F99B6597B1F8207 (salaireprimeobtenu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salaire (id INT AUTO_INCREMENT NOT NULL, periodesalaire_id INT DEFAULT NULL, usersalaire_id INT DEFAULT NULL, mois VARCHAR(255) NOT NULL, montantfrais VARCHAR(255) NOT NULL, nbretravail INT NOT NULL, montantsalaire INT NOT NULL, amical INT NOT NULL, benefcotisation INT NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, cotisation VARCHAR(255) DEFAULT NULL, ref VARCHAR(255) DEFAULT NULL, INDEX IDX_3BCBBD1184B4B99A (periodesalaire_id), INDEX IDX_3BCBBD116B04EB78 (usersalaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scolarite (id INT AUTO_INCREMENT NOT NULL, userscolarite_id INT DEFAULT NULL, avance INT NOT NULL, reste INT NOT NULL, mois VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, ref VARCHAR(255) NOT NULL, INDEX IDX_276250AB5DCD51DD (userscolarite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, phone INT NOT NULL, inscription VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, matricule INT NOT NULL, is_teacher TINYINT(1) NOT NULL, school VARCHAR(255) DEFAULT NULL, is_rame TINYINT(1) DEFAULT NULL, annee VARCHAR(255) DEFAULT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, salairesceance INT DEFAULT NULL, is_ative TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_periode (user_id INT NOT NULL, periode_id INT NOT NULL, INDEX IDX_CBCE33F9A76ED395 (user_id), INDEX IDX_CBCE33F9F384C1CF (periode_id), PRIMARY KEY(user_id, periode_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_classe (user_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_EAD5A4ABA76ED395 (user_id), INDEX IDX_EAD5A4AB8F5EA509 (classe_id), PRIMARY KEY(user_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_matiere (user_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_C8194940A76ED395 (user_id), INDEX IDX_C8194940F46CD258 (matiere_id), PRIMARY KEY(user_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2EDE43D9A1A FOREIGN KEY (usercotisation_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE evenement_obtenu ADD CONSTRAINT FK_693715191AD0F60E FOREIGN KEY (salaireevenobtenu_id) REFERENCES salaire (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECAF586744 FOREIGN KEY (histscolarite_id) REFERENCES scolarite (id)');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE63704C950 FOREIGN KEY (userpresence_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE642AB8412 FOREIGN KEY (matierepresence_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE679EFFA56 FOREIGN KEY (periodepresence_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE presence_student ADD CONSTRAINT FK_AA792EE63558EE97 FOREIGN KEY (classepresence_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE presence_student_user ADD CONSTRAINT FK_38074B9CE9F0A93C FOREIGN KEY (presence_student_id) REFERENCES presence_student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presence_student_user ADD CONSTRAINT FK_38074B9CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prime_obtenu ADD CONSTRAINT FK_5F99B6597B1F8207 FOREIGN KEY (salaireprimeobtenu_id) REFERENCES salaire (id)');
        $this->addSql('ALTER TABLE salaire ADD CONSTRAINT FK_3BCBBD1184B4B99A FOREIGN KEY (periodesalaire_id) REFERENCES periode (id)');
        $this->addSql('ALTER TABLE salaire ADD CONSTRAINT FK_3BCBBD116B04EB78 FOREIGN KEY (usersalaire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE scolarite ADD CONSTRAINT FK_276250AB5DCD51DD FOREIGN KEY (userscolarite_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_periode ADD CONSTRAINT FK_CBCE33F9A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_periode ADD CONSTRAINT FK_CBCE33F9F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_classe ADD CONSTRAINT FK_EAD5A4ABA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_classe ADD CONSTRAINT FK_EAD5A4AB8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_matiere ADD CONSTRAINT FK_C8194940A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_matiere ADD CONSTRAINT FK_C8194940F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2EDE43D9A1A');
        $this->addSql('ALTER TABLE evenement_obtenu DROP FOREIGN KEY FK_693715191AD0F60E');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECAF586744');
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE63704C950');
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE642AB8412');
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE679EFFA56');
        $this->addSql('ALTER TABLE presence_student DROP FOREIGN KEY FK_AA792EE63558EE97');
        $this->addSql('ALTER TABLE presence_student_user DROP FOREIGN KEY FK_38074B9CE9F0A93C');
        $this->addSql('ALTER TABLE presence_student_user DROP FOREIGN KEY FK_38074B9CA76ED395');
        $this->addSql('ALTER TABLE prime_obtenu DROP FOREIGN KEY FK_5F99B6597B1F8207');
        $this->addSql('ALTER TABLE salaire DROP FOREIGN KEY FK_3BCBBD1184B4B99A');
        $this->addSql('ALTER TABLE salaire DROP FOREIGN KEY FK_3BCBBD116B04EB78');
        $this->addSql('ALTER TABLE scolarite DROP FOREIGN KEY FK_276250AB5DCD51DD');
        $this->addSql('ALTER TABLE user_periode DROP FOREIGN KEY FK_CBCE33F9A76ED395');
        $this->addSql('ALTER TABLE user_periode DROP FOREIGN KEY FK_CBCE33F9F384C1CF');
        $this->addSql('ALTER TABLE user_classe DROP FOREIGN KEY FK_EAD5A4ABA76ED395');
        $this->addSql('ALTER TABLE user_classe DROP FOREIGN KEY FK_EAD5A4AB8F5EA509');
        $this->addSql('ALTER TABLE user_matiere DROP FOREIGN KEY FK_C8194940A76ED395');
        $this->addSql('ALTER TABLE user_matiere DROP FOREIGN KEY FK_C8194940F46CD258');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cotisation');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenement_obtenu');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE presence_student');
        $this->addSql('DROP TABLE presence_student_user');
        $this->addSql('DROP TABLE prime');
        $this->addSql('DROP TABLE prime_obtenu');
        $this->addSql('DROP TABLE salaire');
        $this->addSql('DROP TABLE scolarite');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_periode');
        $this->addSql('DROP TABLE user_classe');
        $this->addSql('DROP TABLE user_matiere');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
