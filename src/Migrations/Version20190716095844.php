<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716095844 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784C54C8C93 FOREIGN KEY (type_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_92ED7784C54C8C93 ON program (type_id)');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57293EB8070A');
        $this->addSql('DROP INDEX IDX_8CDE57293EB8070A ON type');
        $this->addSql('ALTER TABLE type DROP program_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784C54C8C93');
        $this->addSql('DROP INDEX IDX_92ED7784C54C8C93 ON program');
        $this->addSql('ALTER TABLE program DROP type_id');
        $this->addSql('ALTER TABLE type ADD program_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57293EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8CDE57293EB8070A ON type (program_id)');
    }
}
