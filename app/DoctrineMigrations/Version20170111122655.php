<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170111122655 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentresponse DROP FOREIGN KEY FK_B9408896D6DE06A6');
        $this->addSql('DROP INDEX IDX_B9408896D6DE06A6 ON commentresponse');
        $this->addSql('ALTER TABLE commentresponse CHANGE comment_id_id comment_id INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentresponse CHANGE comment_id comment_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentresponse ADD CONSTRAINT FK_B9408896D6DE06A6 FOREIGN KEY (comment_id_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B9408896D6DE06A6 ON commentresponse (comment_id_id)');
    }
}
