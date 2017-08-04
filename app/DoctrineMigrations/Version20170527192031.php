<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170527192031 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', email VARCHAR(255) NOT NULL, news TINYINT(1) NOT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentresponse (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, comment_id_id INT NOT NULL, commentresponse VARCHAR(255) NOT NULL, article_id INT NOT NULL, comment_category VARCHAR(255) NOT NULL, comment_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_B9408896B9408896 (commentresponse), INDEX IDX_B9408896A76ED395 (user_id), INDEX IDX_B9408896D6DE06A6 (comment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, comment VARCHAR(255) NOT NULL, article_id INT NOT NULL, comment_category VARCHAR(255) NOT NULL, comment_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_9474526C9474526C (comment), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, post_category VARCHAR(255) NOT NULL, post_title VARCHAR(255) NOT NULL, post_data LONGTEXT NOT NULL, article_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentresponse ADD CONSTRAINT FK_B9408896A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentresponse ADD CONSTRAINT FK_B9408896D6DE06A6 FOREIGN KEY (comment_id_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentresponse DROP FOREIGN KEY FK_B9408896A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE commentresponse DROP FOREIGN KEY FK_B9408896D6DE06A6');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE commentresponse');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE article');
    }
}
