<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190228162108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coat_paper (coat_id INT NOT NULL, paper_id INT NOT NULL, INDEX IDX_2B06E04479F419D (coat_id), INDEX IDX_2B06E044E6758861 (paper_id), PRIMARY KEY(coat_id, paper_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_image (product_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_64617F034584665A (product_id), INDEX IDX_64617F033DA5256D (image_id), PRIMARY KEY(product_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coat_paper ADD CONSTRAINT FK_2B06E04479F419D FOREIGN KEY (coat_id) REFERENCES coat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coat_paper ADD CONSTRAINT FK_2B06E044E6758861 FOREIGN KEY (paper_id) REFERENCES paper (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F033DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A601669C8CD9D');
        $this->addSql('DROP INDEX IDX_4E1A601669C8CD9D ON paper');
        $this->addSql('ALTER TABLE paper DROP coats_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD44F05E5');
        $this->addSql('DROP INDEX IDX_D34A04ADD44F05E5 ON product');
        $this->addSql('ALTER TABLE product DROP images_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE coat_paper');
        $this->addSql('DROP TABLE product_image');
        $this->addSql('ALTER TABLE paper ADD coats_id INT NOT NULL');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A601669C8CD9D FOREIGN KEY (coats_id) REFERENCES paper_type (id)');
        $this->addSql('CREATE INDEX IDX_4E1A601669C8CD9D ON paper (coats_id)');
        $this->addSql('ALTER TABLE product ADD images_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD44F05E5 FOREIGN KEY (images_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADD44F05E5 ON product (images_id)');
    }
}
