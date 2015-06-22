<?php

/**
 * m000000_000002_offerType_add_param_group install migration
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
class m000000_000002_offerType_add_param_group extends yupe\components\DbMigration
{
    public function safeUp()
    {
        $this->addColumn('{{offer_type}}', 'param_group', 'integer NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{offer_type}}', 'param_group');
    }
}
