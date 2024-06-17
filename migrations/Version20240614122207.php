<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614122207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, trip_id INT NOT NULL, user_id INT NOT NULL, rating SMALLINT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_9474526CA5BC2E0E (trip_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, img VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, destination VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, next_departure DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip_tag (trip_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_8F404E39A5BC2E0E (trip_id), INDEX IDX_8F404E39BAD26311 (tag_id), PRIMARY KEY(trip_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip_country (trip_id INT NOT NULL, country_id INT NOT NULL, INDEX IDX_659F8CCBA5BC2E0E (trip_id), INDEX IDX_659F8CCBF92F3E70 (country_id), PRIMARY KEY(trip_id, country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trip_tag ADD CONSTRAINT FK_8F404E39A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_tag ADD CONSTRAINT FK_8F404E39BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_country ADD CONSTRAINT FK_659F8CCBA5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip_country ADD CONSTRAINT FK_659F8CCBF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA5BC2E0E');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE trip_tag DROP FOREIGN KEY FK_8F404E39A5BC2E0E');
        $this->addSql('ALTER TABLE trip_tag DROP FOREIGN KEY FK_8F404E39BAD26311');
        $this->addSql('ALTER TABLE trip_country DROP FOREIGN KEY FK_659F8CCBA5BC2E0E');
        $this->addSql('ALTER TABLE trip_country DROP FOREIGN KEY FK_659F8CCBF92F3E70');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE trip_tag');
        $this->addSql('DROP TABLE trip_country');
        $this->addSql('DROP TABLE user');
    }
}
