<?php
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offerBackend/index'],
    Yii::t('OfferModule.offer', 'Offers type') => ['/offer/offerTypeBackend/index'],
    $model->title                                                => [
        '/offer/offerTypeBackend/view',
        'id' => $model->id
    ],
    Yii::t('OfferModule.offer', 'Edit'),
];

$this->pageTitle = Yii::t('OfferModule.offer', 'Offer type - edit');

$this->menu = array_merge(
    $this->module->getNavigation(),
    [
        [
            'label' => Yii::t('OfferModule.offer', 'Offer type') . ' «'. mb_substr($model->title,0,32) . '»'
        ],
        [
            'icon'  => 'fa fa-fw fa-pencil',
            'label' => Yii::t('OfferModule.offer', 'Edit'),
            'url'   => [
                '/offer/offerTypeBackend/update',
                'id' => $model->id
            ]
        ],
        [
            'icon'  => 'fa fa-fw fa-eye',
            'label' => Yii::t('OfferModule.offer', 'View'),
            'url'   => [
                '/offer/offerTypeBackend/view',
                'id' => $model->id
            ]
        ],
        [
            'icon'        => 'fa fa-fw fa-trash-o',
            'label'       => Yii::t('OfferModule.offer', 'Remove'),
            'url'         => '#',
            'linkOptions' => [
                'submit'  => ['/offer/offerTypeBackend/delete', 'id' => $model->id],
                'params'  => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
                'confirm' => Yii::t('OfferModule.offer', 'Do you really want to delete record?'),
            ]
        ],
    ]
);
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('OfferModule.offer', 'Edit'); ?><br/>
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>
