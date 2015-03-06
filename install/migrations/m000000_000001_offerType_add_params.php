<?php

/**
 * m000000_000001_offerType_add_params install migration
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
class m000000_000001_offerType_add_params extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{offer_type}}', 'param_add', 'integer NOT NULL');
        $this->addColumn('{{offer_type}}', 'param_view', 'integer NOT NULL');
        $this->addColumn('{{offer_type}}', 'param_message', 'integer NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{offer_type}}', 'param_add');
        $this->dropColumn('{{offer_type}}', 'param_view');
        $this->dropColumn('{{offer_type}}', 'param_message');
    }
}
