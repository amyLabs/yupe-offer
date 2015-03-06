<?php

$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offerBackend/index'],
    Yii::t('OfferModule.offer', 'Offers type')
];

$this->pageTitle = Yii::t('OfferModule.offer', 'Types list');

$this->menu = $this->module->getNavigation();
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('OfferModule.offer', 'Offers type'); ?>
        <small><?php echo Yii::t('OfferModule.offer', 'manage'); ?></small>
    </h1>
</div>

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'page-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'sortField'    => 'order',
        'columns'      => [
            [
                'name' => 'id',
                'htmlOptions' => [
                    'width' => '100px',
                ]
            ],
            [
                'name' => 'slug',
                'htmlOptions' => [
                    'width' => '150px',
                ]
            ],
            [
                'name' => 'title',
                'htmlOptions' => [
                    'width' => '150px',
                ]
            ],
            [
                'name' => 'description',
                'type'    => 'raw',
            ],
            [
                'class'   => 'yupe\widgets\EditableStatusColumn',
                'name'    => 'status',
                'url'     => $this->createUrl('/offer/offerTypeBackend/inline'),
                'source'  => $model->getStatusList(),
                'options' => [
                    OfferType::STATUS_ACTIVE  => ['class' => 'label-success'],
                    OfferType::STATUS_BLOCKED => ['class' => 'label-danger'],
                ],
                'htmlOptions' => [
                    'width' => '200px',
                ]
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>