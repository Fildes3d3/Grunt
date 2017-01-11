<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170111111226 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentresponse (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, comment_id_id INT NOT NULL, commentresponse VARCHAR(255) NOT NULL, article_id INT NOT NULL, comment_category VARCHAR(255) NOT NULL, comment_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_B9408896B9408896 (commentresponse), INDEX IDX_B9408896A76ED395 (user_id), INDEX IDX_B9408896D6DE06A6 (comment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentresponse ADD CONSTRAINT FK_B9408896A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentresponse ADD CONSTRAINT FK_B9408896D6DE06A6 FOREIGN KEY (comment_id_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_9474526C3E7B0BFB ON comment');
        $this->addSql('ALTER TABLE comment DROP response');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commentresponse');
        $this->addSql('ALTER TABLE comment ADD response VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9474526C3E7B0BFB ON comment (response)');
    }
}
