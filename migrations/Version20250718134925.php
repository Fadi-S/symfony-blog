<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250718134925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395 ON article');
        $this->addSql('ALTER TABLE article CHANGE user_id publisher_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6640C86FCE FOREIGN KEY (publisher_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6640C86FCE ON article (publisher_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6640C86FCE');
        $this->addSql('DROP INDEX IDX_23A0E6640C86FCE ON article');
        $this->addSql('ALTER TABLE article CHANGE publisher_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
    }
}
