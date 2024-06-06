<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606190609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting (id INT AUTO_INCREMENT NOT NULL, actor_id INT NOT NULL, art_work_id INT NOT NULL, role VARCHAR(100) NOT NULL, credit_order INT NOT NULL, INDEX IDX_D11BBA5010DAF24A (actor_id), INDEX IDX_D11BBA50F7052A7 (art_work_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(140) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, release_date DATE DEFAULT NULL, duration TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name (id INT AUTO_INCREMENT NOT NULL, string VARCHAR(255) DEFAULT NULL, actor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_movie (person_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_B168EDAB217BBB47 (person_id), INDEX IDX_B168EDAB8F93B6FC (movie_id), PRIMARY KEY(person_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, art_work_id INT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, rating DOUBLE PRECISION DEFAULT NULL, reactions JSON NOT NULL COMMENT \'(DC2Type:json)\', watched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_794381C6F7052A7 (art_work_id), INDEX IDX_794381C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT NOT NULL, number SMALLINT NOT NULL, episode_count SMALLINT NOT NULL, INDEX IDX_F0E45BA95E3A35BB (tv_show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, released_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', poster VARCHAR(255) DEFAULT NULL, duration SMALLINT DEFAULT NULL, summary LONGTEXT NOT NULL, synopsis LONGTEXT DEFAULT NULL, rating DOUBLE PRECISION NOT NULL, INDEX IDX_320ED901C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_country (show_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_3421E485D0C1FC64 (show_id), INDEX IDX_3421E485F92F3E70 (country_id), PRIMARY KEY(show_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_genre (show_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_81E15724D0C1FC64 (show_id), INDEX IDX_81E157244296D31F (genre_id), PRIMARY KEY(show_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA5010DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA50F7052A7 FOREIGN KEY (art_work_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE person_movie ADD CONSTRAINT FK_B168EDAB217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_movie ADD CONSTRAINT FK_B168EDAB8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F7052A7 FOREIGN KEY (art_work_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA95E3A35BB FOREIGN KEY (tv_show_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED901C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE show_country ADD CONSTRAINT FK_3421E485D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_country ADD CONSTRAINT FK_3421E485F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_genre ADD CONSTRAINT FK_81E15724D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_genre ADD CONSTRAINT FK_81E157244296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA5010DAF24A');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA50F7052A7');
        $this->addSql('ALTER TABLE person_movie DROP FOREIGN KEY FK_B168EDAB217BBB47');
        $this->addSql('ALTER TABLE person_movie DROP FOREIGN KEY FK_B168EDAB8F93B6FC');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F7052A7');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA95E3A35BB');
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED901C54C8C93');
        $this->addSql('ALTER TABLE show_country DROP FOREIGN KEY FK_3421E485D0C1FC64');
        $this->addSql('ALTER TABLE show_country DROP FOREIGN KEY FK_3421E485F92F3E70');
        $this->addSql('ALTER TABLE show_genre DROP FOREIGN KEY FK_81E15724D0C1FC64');
        $this->addSql('ALTER TABLE show_genre DROP FOREIGN KEY FK_81E157244296D31F');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE casting');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE name');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_movie');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE show_country');
        $this->addSql('DROP TABLE show_genre');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
