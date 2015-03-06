<?php
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offerBackend/index'],
    $model->id,
];

$this->pageTitle = Yii::t('OfferModule.offer', 'Offer - view');

$this->menu = array_merge(
    $this->module->getNavigation(),
    [
        [
            'label' => Yii::t('OfferModule.offer', 'Offer type') . ' «'. mb_substr($model->id,0,32) . '»'
        ],
        [
            'icon'  => 'fa fa-fw fa-pencil',
            'label' => Yii::t('OfferModule.offer', 'Edit'),
            'url'   => [
                '/offer/offerBackend/update',
                'id' => $model->id
            ]
        ],
        [
            'icon'  => 'fa fa-fw fa-eye',
            'label' => Yii::t('OfferModule.offer', 'View'),
            'url'   => [
                '/offer/offerBackend/view',
                'id' => $model->id
            ]
        ],
        [
            'icon'        => 'fa fa-fw fa-trash-o',
            'label'       => Yii::t('OfferModule.offer', 'Remove'),
            'url'         => '#',
            'linkOptions' => [
                'submit'  => ['/offer/offerBackend/delete', 'id' => $model->id],
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
            <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
        </h1>
    </div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    [
        'data'       => $model,
        'attributes' => [
            'id',
            'title',
            'slug',
            [
                'name' => 'type_id',
                'type' => 'raw',
                'value' => $model->type->name,
            ],
            [
                'name' => 'user_id',
                'type' => 'raw',
                'value' => $model->user->getFullName(),
            ],
            [
                'name' => 'text',
                'type' => 'raw',
                'value' => $model->text,
            ],
            [
                'name' => 'status',
                'type' => 'raw',
                'value' => $model->getStatus(),
            ]
        ],
    ]
); ?>