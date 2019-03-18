<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190228154635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, images VARCHAR(255) NOT NULL, manufacture_methods VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_paper (product_id INT NOT NULL, paper_id INT NOT NULL, INDEX IDX_EF461B4A4584665A (product_id), INDEX IDX_EF461B4AE6758861 (paper_id), PRIMARY KEY(product_id, paper_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_paper ADD CONSTRAINT FK_EF461B4A4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_paper ADD CONSTRAINT FK_EF461B4AE6758861 FOREIGN KEY (paper_id) REFERENCES paper (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paper ADD coats_id INT NOT NULL');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A601669C8CD9D FOREIGN KEY (coats_id) REFERENCES paper_type (id)');
        $this->addSql('CREATE INDEX IDX_4E1A601669C8CD9D ON paper (coats_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_paper DROP FOREIGN KEY FK_EF461B4A4584665A');
        $this->addSql('DROP TABLE coat');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_paper');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A601669C8CD9D');
        $this->addSql('DROP INDEX IDX_4E1A601669C8CD9D ON paper');
        $this->addSql('ALTER TABLE paper DROP coats_id');
    }
}
