<?php
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers')
];

$this->pageTitle = Yii::t('OfferModule.offer', 'Offers list');

$this->menu = $this->module->getNavigation();
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('OfferModule.offer', 'Offers'); ?>
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
                'name' => 'title',
                'htmlOptions' => [
                    'width' => '150px',
                ]
            ],
            [
                'name' => 'slug',
                'htmlOptions' => [
                    'width' => '150px',
                ]
            ],
            [
                'name'   => 'type_id',
                'type'   => 'raw',
                'value'  => 'CHtml::link($data->type->title, array("/offer/offerTypeBackend/view", "id" => $data->type->id))',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'type_id',
                    CHtml::listData(OfferType::model()->findAll(), 'id', 'title'),
                    ['class' => 'form-control', 'empty' => '']
                ),
            ],
            [
                'name'   => 'user_id',
                'type'   => 'raw',
                'value'  => 'CHtml::link($data->user->getFullName(), array("/user/userBackend/view", "id" => $data->user->id))',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'user_id',
                    CHtml::listData(User::model()->cache($this->yupe->coreCacheTime)->findAll(), 'id', 'nick_name'),
                    ['class' => 'form-control', 'empty' => '']
                ),
            ],
            [
                'class'   => 'yupe\widgets\EditableStatusColumn',
                'name'    => 'status',
                'url'     => $this->createUrl('/offer/offerBackend/inline'),
                'source'  => $model->getStatusList(),
                'options' => [
                    Offer::STATUS_ACTIVE  => ['class' => 'label-success'],
                    Offer::STATUS_BLOCKED => ['class' => 'label-danger'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>