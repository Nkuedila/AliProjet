<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126151406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_entity ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_entity ADD CONSTRAINT FK_C7CBFBD67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_C7CBFBD67B3B43D ON commande_entity (users_id)');
        $this->addSql('ALTER TABLE users ADD lastname VARCHAR(100) NOT NULL, ADD firstname VARCHAR(100) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD zipcode VARCHAR(5) NOT NULL, ADD city VARCHAR(150) NOT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_entity DROP FOREIGN KEY FK_C7CBFBD67B3B43D');
        $this->addSql('DROP INDEX IDX_C7CBFBD67B3B43D ON commande_entity');
        $this->addSql('ALTER TABLE commande_entity DROP users_id');
        $this->addSql('ALTER TABLE users DROP lastname, DROP firstname, DROP address, DROP zipcode, DROP city, DROP created_at');
    }
}
