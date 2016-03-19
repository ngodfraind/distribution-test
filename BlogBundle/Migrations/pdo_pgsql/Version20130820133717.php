<?php

namespace Icap\BlogBundle\Migrations\pdo_pgsql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/08/20 01:37:19
 */
class Version20130820133717 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE icap__blog_tag (
                id SERIAL NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_8BE678285E237E06 ON icap__blog_tag (name)
        ");
        $this->addSql("
            CREATE TABLE icap__blog_post (
                id SERIAL NOT NULL,
                user_id INT DEFAULT NULL,
                blog_id INT DEFAULT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                slug VARCHAR(128) NOT NULL,
                creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                modification_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                publication_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
                status SMALLINT NOT NULL,
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_1B067922989D9B62 ON icap__blog_post (slug)
        ");
        $this->addSql("
            CREATE INDEX IDX_1B067922A76ED395 ON icap__blog_post (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_1B067922DAE07E97 ON icap__blog_post (blog_id)
        ");
        $this->addSql("
            CREATE TABLE icap__blog_post_tag (
                post_id INT NOT NULL,
                tag_id INT NOT NULL,
                PRIMARY KEY(post_id, tag_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_C3C6F4794B89032C ON icap__blog_post_tag (post_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_C3C6F479BAD26311 ON icap__blog_post_tag (tag_id)
        ");
        $this->addSql("
            CREATE TABLE icap__blog_comment (
                id SERIAL NOT NULL,
                user_id INT DEFAULT NULL,
                post_id INT DEFAULT NULL,
                message TEXT NOT NULL,
                creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
                publication_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
                status SMALLINT NOT NULL,
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_95EB616FA76ED395 ON icap__blog_comment (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_95EB616F4B89032C ON icap__blog_comment (post_id)
        ");
        $this->addSql("
            CREATE TABLE icap__blog (
                id SERIAL NOT NULL,
                infos TEXT DEFAULT NULL,
                resourceNode_id INT DEFAULT NULL,
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_FD75E6C4B87FAB32 ON icap__blog (resourceNode_id)
        ");
        $this->addSql("
            CREATE TABLE icap__blog_options (
                id SERIAL NOT NULL,
                blog_id INT DEFAULT NULL,
                authorize_comment BOOLEAN NOT NULL,
                authorize_anonymous_comment BOOLEAN NOT NULL,
                post_per_page SMALLINT NOT NULL,
                auto_publish_post BOOLEAN NOT NULL,
                auto_publish_comment BOOLEAN NOT NULL,
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_D1AAC984DAE07E97 ON icap__blog_options (blog_id)
        ");
        $this->addSql("
            ALTER TABLE icap__blog_post
            ADD CONSTRAINT FK_1B067922A76ED395 FOREIGN KEY (user_id)
            REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog_post
            ADD CONSTRAINT FK_1B067922DAE07E97 FOREIGN KEY (blog_id)
            REFERENCES icap__blog (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog_post_tag
            ADD CONSTRAINT FK_C3C6F4794B89032C FOREIGN KEY (post_id)
            REFERENCES icap__blog_post (id)
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog_post_tag
            ADD CONSTRAINT FK_C3C6F479BAD26311 FOREIGN KEY (tag_id)
            REFERENCES icap__blog_tag (id)
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog_comment
            ADD CONSTRAINT FK_95EB616FA76ED395 FOREIGN KEY (user_id)
            REFERENCES claro_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog_comment
            ADD CONSTRAINT FK_95EB616F4B89032C FOREIGN KEY (post_id)
            REFERENCES icap__blog_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog
            ADD CONSTRAINT FK_FD75E6C4B87FAB32 FOREIGN KEY (resourceNode_id)
            REFERENCES claro_resource_node (id)
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
        $this->addSql("
            ALTER TABLE icap__blog_options
            ADD CONSTRAINT FK_D1AAC984DAE07E97 FOREIGN KEY (blog_id)
            REFERENCES icap__blog (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE icap__blog_post_tag
            DROP CONSTRAINT FK_C3C6F479BAD26311
        ");
        $this->addSql("
            ALTER TABLE icap__blog_post_tag
            DROP CONSTRAINT FK_C3C6F4794B89032C
        ");
        $this->addSql("
            ALTER TABLE icap__blog_comment
            DROP CONSTRAINT FK_95EB616F4B89032C
        ");
        $this->addSql("
            ALTER TABLE icap__blog_post
            DROP CONSTRAINT FK_1B067922DAE07E97
        ");
        $this->addSql("
            ALTER TABLE icap__blog_options
            DROP CONSTRAINT FK_D1AAC984DAE07E97
        ");
        $this->addSql("
            DROP TABLE icap__blog_tag
        ");
        $this->addSql("
            DROP TABLE icap__blog_post
        ");
        $this->addSql("
            DROP TABLE icap__blog_post_tag
        ");
        $this->addSql("
            DROP TABLE icap__blog_comment
        ");
        $this->addSql("
            DROP TABLE icap__blog
        ");
        $this->addSql("
            DROP TABLE icap__blog_options
        ");
    }
}
