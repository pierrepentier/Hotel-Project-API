<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427152125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE lit_simple lit_simple INT DEFAULT NULL, CHANGE lit_double lit_double INT DEFAULT NULL, CHANGE lit_king lit_king INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarifer MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE tarifer DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tarifer ADD categorie_id INT NOT NULL, ADD hotel_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE tarifer ADD CONSTRAINT FK_6904C4FFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE tarifer ADD CONSTRAINT FK_6904C4FF3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_6904C4FFBCF5E72D ON tarifer (categorie_id)');
        $this->addSql('CREATE INDEX IDX_6904C4FF3243BB18 ON tarifer (hotel_id)');
        $this->addSql('ALTER TABLE tarifer ADD PRIMARY KEY (categorie_id, hotel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie CHANGE lit_simple lit_simple INT DEFAULT NULL, CHANGE lit_double lit_double INT DEFAULT NULL, CHANGE lit_king lit_king INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarifer DROP FOREIGN KEY FK_6904C4FFBCF5E72D');
        $this->addSql('ALTER TABLE tarifer DROP FOREIGN KEY FK_6904C4FF3243BB18');
        $this->addSql('DROP INDEX IDX_6904C4FFBCF5E72D ON tarifer');
        $this->addSql('DROP INDEX IDX_6904C4FF3243BB18 ON tarifer');
        $this->addSql('ALTER TABLE tarifer ADD id INT AUTO_INCREMENT NOT NULL, DROP categorie_id, DROP hotel_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
