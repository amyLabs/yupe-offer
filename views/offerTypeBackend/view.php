<?php
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offerBackend/index'],
    Yii::t('OfferModule.offer', 'Offers type') => ['/offer/offerTypeBackend/index'],
    $model->title,
];

$this->pageTitle = Yii::t('OfferModule.offer', 'Offer type - view');

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
        <?php echo Yii::t('OfferModule.offer', 'View'); ?><br/>
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    [
        'data'       => $model,
        'attributes' => [
            'id',
            'slug',
            'title',
            [
                'name' => 'description',
                'type' => 'raw',
                'value' => $model->description,
            ],
            [
                'name' => 'status',
                'type' => 'raw',
                'value' => $model->getStatus(),
            ]
        ],
    ]
); ?>

<div class="page-header">
    <h2><?php echo Yii::t('OfferModule.offer', 'Params'); ?></h2>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    [
        'data'       => $model,
        'attributes' => [
            [
                'name' => 'param_add',
                'type' => 'raw',
                'value' => $model->getParamAdd(),
            ],
            [
                'name' => 'param_view',
                'type' => 'raw',
                'value' => $model->getParamView(),
            ],
            [
                'name' => 'param_message',
                'type' => 'raw',
                'value' => $model->getParamMessage(),
            ]
        ],
    ]
); ?>

<?php if ( Yii::app()->hasModule('groups') ) : ?>
    <?php $this->widget(
        'bootstrap.widgets.TbDetailView',
        [
            'data'       => $model,
            'attributes' => [
                [
                    'name' => 'param_group',
                    'type' => 'raw',
                    'value' => $model->getParamGroup(),
                ],
            ],
        ]
    ); ?>
<?php endif; ?>