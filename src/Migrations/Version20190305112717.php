<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305112717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_1846DB702C2AC5D3 (translatable_id), UNIQUE INDEX product_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_translation ADD CONSTRAINT FK_1846DB702C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_post_print');
        $this->addSql('ALTER TABLE product DROP name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_post_print (product_id INT NOT NULL, post_print_id INT NOT NULL, INDEX IDX_11AAAFA24584665A (product_id), INDEX IDX_11AAAFA279CCBA0D (post_print_id), PRIMARY KEY(product_id, post_print_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_post_print ADD CONSTRAINT FK_11AAAFA24584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_post_print ADD CONSTRAINT FK_11AAAFA279CCBA0D FOREIGN KEY (post_print_id) REFERENCES post_print (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_translation');
        $this->addSql('ALTER TABLE product ADD name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
