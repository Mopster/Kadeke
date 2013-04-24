<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130424114203 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE kuma_checkbox_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE kuma_seo ADD meta_title VARCHAR(255) DEFAULT NULL, ADD linked_in_recommend_link VARCHAR(255) DEFAULT NULL, ADD linked_in_recommend_product_id VARCHAR(255) DEFAULT NULL, ADD og_url VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE kuma_form_submission_fields ADD bfsf_value TINYINT(1) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE kuma_checkbox_page_parts");
        $this->addSql("ALTER TABLE kuma_form_submission_fields DROP bfsf_value");
        $this->addSql("ALTER TABLE kuma_seo DROP meta_title, DROP linked_in_recommend_link, DROP linked_in_recommend_product_id, DROP og_url");
    }
}
