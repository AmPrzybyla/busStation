<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410132619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE station_title (station_id INT NOT NULL, title_id INT NOT NULL, INDEX IDX_73B0075D21BDB235 (station_id), INDEX IDX_73B0075DA9F87BD (title_id), PRIMARY KEY(station_id, title_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE title (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE station_title ADD CONSTRAINT FK_73B0075D21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE station_title ADD CONSTRAINT FK_73B0075DA9F87BD FOREIGN KEY (title_id) REFERENCES title (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE station DROP title');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE station_title DROP FOREIGN KEY FK_73B0075DA9F87BD');
        $this->addSql('DROP TABLE station_title');
        $this->addSql('DROP TABLE title');
        $this->addSql('ALTER TABLE station ADD title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
