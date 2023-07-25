<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230724203003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE list_item (id INT AUTO_INCREMENT NOT NULL, list_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, done TINYINT(1) NOT NULL, INDEX IDX_5AD5FAF73DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE to_do_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_list (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, list_id INT DEFAULT NULL, INDEX IDX_3E49B4D1A76ED395 (user_id), INDEX IDX_3E49B4D13DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE list_item ADD CONSTRAINT FK_5AD5FAF73DAE168B FOREIGN KEY (list_id) REFERENCES to_do_list (id)');
        $this->addSql('ALTER TABLE user_list ADD CONSTRAINT FK_3E49B4D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_list ADD CONSTRAINT FK_3E49B4D13DAE168B FOREIGN KEY (list_id) REFERENCES to_do_list (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_item DROP FOREIGN KEY FK_5AD5FAF73DAE168B');
        $this->addSql('ALTER TABLE user_list DROP FOREIGN KEY FK_3E49B4D1A76ED395');
        $this->addSql('ALTER TABLE user_list DROP FOREIGN KEY FK_3E49B4D13DAE168B');
        $this->addSql('DROP TABLE list_item');
        $this->addSql('DROP TABLE to_do_list');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_list');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
