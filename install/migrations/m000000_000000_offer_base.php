<?php

/**
 * m000000_000000_offer_base install migration
 * Класс миграций для модуля Offer:
 *
 * @author apexwire <apexwire@amylabs.ru>
 * @link      http://yupe.ru
 * @copyright 2009-2015 amyLabs && Yupe! team
 * @package yupe.modules.offer.install.migrations
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @since 1.0
 *
 */
class m000000_000000_offer_base extends yupe\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        //offer
        $this->createTable(
            '{{offer}}',
            [
                'id'            => 'pk',
                'title'         => "varchar(150) NOT NULL",
                'slug'          => "varchar(150) NOT NULL",
                'type_id' => 'integer NOT NULL',
                'user_id'       => "integer NOT NULL",
                'text'          => 'varchar(250) NOT NULL',
                'status'        => 'integer NOT NULL',
            ],
            $this->getOptions()
        );

        $this->createIndex("ix_{{offer}}_status", '{{offer}}', "status", false);

        //offer_type
        $this->createTable(
            '{{offer_type}}',
            [
                'id'          => 'pk',
                'title'       => 'varchar(150) NOT NULL',
                'slug'        => "varchar(150) NOT NULL",
                'description' => 'varchar(250) NOT NULL',
                'status'      => 'integer NOT NULL',
            ],
            $this->getOptions()
        );

        $this->createIndex("ux_{{offer_type}}_slug", '{{offer_type}}', "slug", true);
        $this->createIndex("ix_{{offer_type}}_status", '{{offer_type}}', "status", false);
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys("{{offer}}");
        $this->dropTableWithForeignKeys("{{offer_type}}");
    }
}
