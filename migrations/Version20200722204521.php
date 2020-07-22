<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200722204521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(127) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_owners (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_200ED35E4584665A (product_id), INDEX IDX_200ED35E7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_owners ADD CONSTRAINT FK_200ED35E4584665A FOREIGN KEY (product_id) REFERENCES Product (id)');
        $this->addSql('ALTER TABLE product_owners ADD CONSTRAINT FK_200ED35E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_owners DROP FOREIGN KEY FK_200ED35E7E3C61F9');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE product_owners');
    }
}
