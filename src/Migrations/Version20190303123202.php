<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303123202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE paper_coat (paper_id INT NOT NULL, coat_id INT NOT NULL, INDEX IDX_963A4538E6758861 (paper_id), INDEX IDX_963A453879F419D (coat_id), PRIMARY KEY(paper_id, coat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paper_coat ADD CONSTRAINT FK_963A4538E6758861 FOREIGN KEY (paper_id) REFERENCES paper (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paper_coat ADD CONSTRAINT FK_963A453879F419D FOREIGN KEY (coat_id) REFERENCES coat (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE coat_paper');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coat_paper (coat_id INT NOT NULL, paper_id INT NOT NULL, INDEX IDX_2B06E044E6758861 (paper_id), INDEX IDX_2B06E04479F419D (coat_id), PRIMARY KEY(coat_id, paper_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE coat_paper ADD CONSTRAINT FK_2B06E04479F419D FOREIGN KEY (coat_id) REFERENCES coat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coat_paper ADD CONSTRAINT FK_2B06E044E6758861 FOREIGN KEY (paper_id) REFERENCES paper (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE paper_coat');
    }
}
