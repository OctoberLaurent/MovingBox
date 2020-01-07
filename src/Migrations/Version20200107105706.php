<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107105706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE boxes (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, origin_id INT DEFAULT NULL, destination_id INT DEFAULT NULL, number INT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_CDF1B2E9A76ED395 (user_id), INDEX IDX_CDF1B2E956A273CC (origin_id), INDEX IDX_CDF1B2E9816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(40) NOT NULL, last_name VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boxes ADD CONSTRAINT FK_CDF1B2E9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE boxes ADD CONSTRAINT FK_CDF1B2E956A273CC FOREIGN KEY (origin_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE boxes ADD CONSTRAINT FK_CDF1B2E9816C6140 FOREIGN KEY (destination_id) REFERENCES rooms (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boxes DROP FOREIGN KEY FK_CDF1B2E956A273CC');
        $this->addSql('ALTER TABLE boxes DROP FOREIGN KEY FK_CDF1B2E9816C6140');
        $this->addSql('ALTER TABLE boxes DROP FOREIGN KEY FK_CDF1B2E9A76ED395');
        $this->addSql('DROP TABLE boxes');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE user');
    }
}
