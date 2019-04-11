<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190410162953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE station_title');
        $this->addSql('ALTER TABLE station ADD title_id INT NOT NULL');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B1A9F87BD FOREIGN KEY (title_id) REFERENCES title (id)');
        $this->addSql('CREATE INDEX IDX_9F39F8B1A9F87BD ON station (title_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE station_title (station_id INT NOT NULL, title_id INT NOT NULL, INDEX IDX_73B0075D21BDB235 (station_id), INDEX IDX_73B0075DA9F87BD (title_id), PRIMARY KEY(station_id, title_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE station_title ADD CONSTRAINT FK_73B0075D21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE station_title ADD CONSTRAINT FK_73B0075DA9F87BD FOREIGN KEY (title_id) REFERENCES title (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B1A9F87BD');
        $this->addSql('DROP INDEX IDX_9F39F8B1A9F87BD ON station');
        $this->addSql('ALTER TABLE station DROP title_id');
    }
}
