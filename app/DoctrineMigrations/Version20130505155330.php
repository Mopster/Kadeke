<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130505155330 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE kd_search_page (id BIGINT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, page_title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE kuma_node_queued_node_translation_actions (id BIGINT AUTO_INCREMENT NOT NULL, node_translation_id BIGINT DEFAULT NULL, action VARCHAR(255) NOT NULL, user_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_D270D8D1E0B87CE0 (node_translation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE kuma_page_template_configuration (id BIGINT AUTO_INCREMENT NOT NULL, page_id BIGINT NOT NULL, page_entity_name VARCHAR(255) NOT NULL, page_template VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE kuma_checkbox_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE kuma_node_queued_node_translation_actions ADD CONSTRAINT FK_D270D8D1E0B87CE0 FOREIGN KEY (node_translation_id) REFERENCES kuma_node_translations (id)");
        $this->addSql("ALTER TABLE ext_log_entries CHANGE object_id object_id VARCHAR(64) DEFAULT NULL");
        $this->addSql("CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version)");
        $this->addSql("ALTER TABLE kuma_seo ADD meta_title VARCHAR(255) DEFAULT NULL, ADD linked_in_recommend_link VARCHAR(255) DEFAULT NULL, ADD linked_in_recommend_product_id VARCHAR(255) DEFAULT NULL, ADD og_url VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE kuma_form_submission_fields ADD bfsf_value TINYINT(1) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE kd_search_page");
        $this->addSql("DROP TABLE kuma_node_queued_node_translation_actions");
        $this->addSql("DROP TABLE kuma_page_template_configuration");
        $this->addSql("DROP TABLE kuma_checkbox_page_parts");
        $this->addSql("DROP INDEX log_version_lookup_idx ON ext_log_entries");
        $this->addSql("ALTER TABLE ext_log_entries CHANGE object_id object_id VARCHAR(32) DEFAULT NULL");
        $this->addSql("ALTER TABLE kuma_form_submission_fields DROP bfsf_value");
        $this->addSql("ALTER TABLE kuma_seo DROP meta_title, DROP linked_in_recommend_link, DROP linked_in_recommend_product_id, DROP og_url");
    }
}
