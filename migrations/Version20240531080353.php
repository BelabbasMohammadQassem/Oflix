<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531080353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE casting (id INT AUTO_INCREMENT NOT NULL, actor_id INT NOT NULL, art_work_id INT NOT NULL, role VARCHAR(100) NOT NULL, credit_order INT NOT NULL, INDEX IDX_D11BBA5010DAF24A (actor_id), INDEX IDX_D11BBA50F7052A7 (art_work_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA5010DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
        $this->addSql('ALTER TABLE casting ADD CONSTRAINT FK_D11BBA50F7052A7 FOREIGN KEY (art_work_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE actor ADD first_name VARCHAR(100) NOT NULL, ADD last_name VARCHAR(100) NOT NULL');

        // on ajoute une requete pour ne pas perdre les données qui sont dans la colonne name
        $this->addSql('UPDATE actor SET first_name = `name`');

        $this->addSql('ALTER TABLE actor DROP `name`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA5010DAF24A');
        $this->addSql('ALTER TABLE casting DROP FOREIGN KEY FK_D11BBA50F7052A7');
        $this->addSql('DROP TABLE casting');
        $this->addSql('ALTER TABLE actor ADD name VARCHAR(100) DEFAULT NULL');
        $this->addSql("UPDATE actor SET name = concat(`first_name`, ' ', `last_name`)");

        $this->addSql('ALTER TABLE actor DROP first_name, DROP last_name');
    }
}
