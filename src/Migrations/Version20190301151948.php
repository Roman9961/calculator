<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190301151948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_print_type (product_id INT NOT NULL, print_type_id INT NOT NULL, INDEX IDX_CBB64A464584665A (product_id), INDEX IDX_CBB64A46E02F994D (print_type_id), PRIMARY KEY(product_id, print_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE print_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, prices JSON NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_print_type ADD CONSTRAINT FK_CBB64A464584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_print_type ADD CONSTRAINT FK_CBB64A46E02F994D FOREIGN KEY (print_type_id) REFERENCES print_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_print_type DROP FOREIGN KEY FK_CBB64A46E02F994D');
        $this->addSql('DROP TABLE product_print_type');
        $this->addSql('DROP TABLE print_type');
    }
}
