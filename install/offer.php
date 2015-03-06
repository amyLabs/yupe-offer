<?php
/**
 * Файл конфигурации модуля
 *
 * @author apexwire <apexwire@amylabs.ru>
 * @link http://yupe.ru
 * @copyright 2009-2015 amyLabs && Yupe! team
 * @package yupe.modules.offer.install
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.offer.OfferModule',
    ],
    'import'    => [],
    'component' => [],
    'rules'     => [
        '/offer' => 'offer/offer/index',
        '/offer/<slugType>' => 'offer/offer/show',
        '/offer/<slugType>/<slug>' => 'offer/offer/showOffer',
    ],
];
