<?php
/**
 * OfferModule основной класс модуля предложений
 *
 * @author apexwire <apexwire@amylabs.ru>
 * @link http://yupe.ru
 * @copyright 2009-2015 amyLabs && Yupe! team
 * @package yupe.modules.offer
 * @since 0.1
 */
class OfferModule extends yupe\components\WebModule
{
    const VERSION = '0.1';

    public function getDependencies()
    {
        return [
            'user',
        ];
    }

    public function getCategory()
    {
        return Yii::t('YupeModule.yupe', 'Content');
    }

    public function getName()
    {
        return Yii::t('OfferModule.offer', 'Offers');
    }

    public function getDescription()
    {
        return Yii::t('OfferModule.offer', 'Module for creating and manage offers');
    }

    public function getAuthor()
    {
        return Yii::t('OfferModule.offer', 'apexwire');
    }

    public function getAuthorEmail()
    {
        return Yii::t('OfferModule.offer', 'apexwire@amylabs.ru');
    }

    public function getUrl()
    {
        return Yii::t('OfferModule.offer', 'http://yupe.ru');
    }

    public function getIcon()
    {
        return "fa fa-fw fa-list";
    }

    public function init()
    {
        parent::init();

        $import = ['application.modules.offer.models.*'];

        if ( Yii::app()->hasModule('groups') ) {
            $import[] = 'application.modules.groups.models.*';
        }

        $this->setImport($import);
    }

    public function getAdminPageLink()
    {
        return '/offer/offerBackend/index';
    }

    public function getNavigation()
    {
        return [
            ['label' => Yii::t('OfferModule.offer', 'Offers')],
            [
                'icon'  => 'fa fa-fw fa-list',
                'label' => Yii::t('OfferModule.offer', 'Offers list'),
                'url'   => ['/offer/offerBackend/index']
            ],
            [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t('OfferModule.offer', 'Create offer'),
                'url'   => ['/offer/offerBackend/create']
            ],
            ['label' => Yii::t('OfferModule.offer', 'Offers type')],
            [
                'icon'  => 'fa fa-fw fa-list',
                'label' => Yii::t('OfferModule.offer', 'Types list'),
                'url'   => ['/offer/offerTypeBackend/index']
            ],
            [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t('OfferModule.offer', 'Create type'),
                'url'   => ['/offer/offerTypeBackend/create']
            ],
        ];
    }
}