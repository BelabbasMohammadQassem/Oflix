<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603092239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C68F93B6FC');
        $this->addSql('DROP INDEX IDX_794381C68F93B6FC ON review');
        $this->addSql('ALTER TABLE review CHANGE movie_id art_work_id INT NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F7052A7 FOREIGN KEY (art_work_id) REFERENCES `show` (id)');
        $this->addSql('CREATE INDEX IDX_794381C6F7052A7 ON review (art_work_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F7052A7');
        $this->addSql('DROP INDEX IDX_794381C6F7052A7 ON review');
        $this->addSql('ALTER TABLE review CHANGE art_work_id movie_id INT NOT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C68F93B6FC FOREIGN KEY (movie_id) REFERENCES `show` (id)');
        $this->addSql('CREATE INDEX IDX_794381C68F93B6FC ON review (movie_id)');
    }
}
