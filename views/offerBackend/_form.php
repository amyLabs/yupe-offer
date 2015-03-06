<script type='text/javascript'>
    $(document).ready(function () {
        $('#offer-form').liTranslit({
            elName: '#Offer_title',
            elAlias: '#Offer_slug'
        });

    })
</script>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'offer-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well'],
    ]
); ?>
<div class="alert alert-info">
    <?php echo Yii::t('OfferModule.offer', 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t('OfferModule.offer', 'are required.'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup(
            $model,
            'title',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'data-original-title' => $model->getAttributeLabel('title'),
                        'data-content'        => $model->getAttributeDescription('title')
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->textFieldGroup(
            $model,
            'slug',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('slug'),
                        'data-content'        => $model->getAttributeDescription('slug'),
                        'placeholder'         => Yii::t(
                            'OfferModule.offer',
                            'For automatic generation leave this field empty'
                        ),
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'type_id',
            [
                'widgetOptions' => [
                    'data'        => CHtml::listData(OfferType::model()->findAll(), 'id', 'title'),
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('type_id'),
                        'data-content'        => $model->getAttributeDescription('type_id'),
                        'data-container'      => 'body',
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'user_id',
            [
                'widgetOptions' => [
                    'data'        => CHtml::listData(User::model()->cache($this->yupe->coreCacheTime)->findAll(), 'id', 'nick_name'),
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('user_id'),
                        'data-content'        => $model->getAttributeDescription('user_id'),
                        'data-container'      => 'body',
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-7">
        <?php echo $form->dropDownListGroup(
            $model,
            'status',
            [
                'widgetOptions' => [
                    'data'        => $model->statusList,
                    'htmlOptions' => [
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('status'),
                        'data-content'        => $model->getAttributeDescription('status'),
                        'data-container'      => 'body',
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 popover-help" data-original-title='<?php echo $model->getAttributeLabel('text'); ?>'
         data-content='<?php echo $model->getAttributeDescription('text'); ?>'>
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php
        $this->widget(
            $this->module->getVisualEditor(),
            [
                'model'     => $model,
                'attribute' => 'text',
            ]
        ); ?>
    </div>
</div>

<br/><br/>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord
            ? Yii::t('OfferModule.offer', 'Create offer and continue')
            : Yii::t('OfferModule.offer', 'Save offer and continue'),
    ]
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord
            ? Yii::t('OfferModule.offer', 'Create offer and close')
            : Yii::t('OfferModule.offer', 'Save offer and close'),
    ]
); ?>

<?php $this->endWidget(); ?>
