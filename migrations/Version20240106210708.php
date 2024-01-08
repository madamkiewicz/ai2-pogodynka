<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240106210708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__forecast AS SELECT id, location_id, date, temperature, pressure, humidity, widn_speed, wind_direction, cloudiness, icon, precipilation FROM forecast');
        $this->addSql('DROP TABLE forecast');
        $this->addSql('CREATE TABLE forecast (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER NOT NULL, date DATE NOT NULL, temperature INTEGER NOT NULL, pressure INTEGER DEFAULT NULL, humidity INTEGER DEFAULT NULL, wind_speed DOUBLE PRECISION DEFAULT NULL, wind_direction VARCHAR(2) DEFAULT NULL, cloudiness INTEGER DEFAULT NULL, icon VARCHAR(255) NOT NULL, precipilation VARCHAR(10) DEFAULT NULL, CONSTRAINT FK_2A9C784464D218E FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO forecast (id, location_id, date, temperature, pressure, humidity, wind_speed, wind_direction, cloudiness, icon, precipilation) SELECT id, location_id, date, temperature, pressure, humidity, widn_speed, wind_direction, cloudiness, icon, precipilation FROM __temp__forecast');
        $this->addSql('DROP TABLE __temp__forecast');
        $this->addSql('CREATE INDEX IDX_2A9C784464D218E ON forecast (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__forecast AS SELECT id, location_id, date, temperature, pressure, humidity, wind_speed, wind_direction, cloudiness, icon, precipilation FROM forecast');
        $this->addSql('DROP TABLE forecast');
        $this->addSql('CREATE TABLE forecast (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER NOT NULL, date DATE NOT NULL, temperature INTEGER NOT NULL, pressure INTEGER DEFAULT NULL, humidity INTEGER DEFAULT NULL, widn_speed DOUBLE PRECISION DEFAULT NULL, wind_direction VARCHAR(2) DEFAULT NULL, cloudiness INTEGER DEFAULT NULL, icon VARCHAR(255) NOT NULL, precipilation VARCHAR(10) DEFAULT NULL, CONSTRAINT FK_2A9C784464D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO forecast (id, location_id, date, temperature, pressure, humidity, widn_speed, wind_direction, cloudiness, icon, precipilation) SELECT id, location_id, date, temperature, pressure, humidity, wind_speed, wind_direction, cloudiness, icon, precipilation FROM __temp__forecast');
        $this->addSql('DROP TABLE __temp__forecast');
        $this->addSql('CREATE INDEX IDX_2A9C784464D218E ON forecast (location_id)');
    }
}
