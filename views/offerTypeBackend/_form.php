<script type='text/javascript'>
    $(document).ready(function () {
        $('#offer-type-form').liTranslit({
            elName: '#OfferType_title',
            elAlias: '#OfferType_slug'
        });

    })
</script>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'offer-type-form',
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
    <div class="col-sm-12 popover-help" data-original-title='<?php echo $model->getAttributeLabel('description'); ?>'
         data-content='<?php echo $model->getAttributeDescription('description'); ?>'>
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php
        $this->widget(
            $this->module->getVisualEditor(),
            [
                'model'     => $model,
                'attribute' => 'description',
            ]
        ); ?>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <a data-toggle="collapse" data-parent="#extended-options">
                        <?php echo Yii::t('OfferModule.offer', 'Params'); ?>
                    </a>
                </div>
            </div>
            <div class="panel-collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-7">
                            <?php echo $form->dropDownListGroup(
                                $model,
                                'param_add',
                                [
                                    'widgetOptions' => [
                                        'data'        => $model->paramAddList,
                                        'htmlOptions' => [
                                            'class'               => 'popover-help',
                                            'data-original-title' => $model->getAttributeLabel('param_add'),
                                            'data-content'        => $model->getAttributeDescription('param_add'),
                                            'data-container'      => 'body',
                                        ],
                                    ],
                                ]
                            ); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <?php echo $form->dropDownListGroup(
                                $model,
                                'param_view',
                                [
                                    'widgetOptions' => [
                                        'data'        => $model->paramViewList,
                                        'htmlOptions' => [
                                            'class'               => 'popover-help',
                                            'data-original-title' => $model->getAttributeLabel('param_view'),
                                            'data-content'        => $model->getAttributeDescription('param_view'),
                                            'data-container'      => 'body',
                                        ],
                                    ],
                                ]
                            ); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <?php echo $form->dropDownListGroup(
                                $model,
                                'param_message',
                                [
                                    'widgetOptions' => [
                                        'data'        => $model->paramMessageList,
                                        'htmlOptions' => [
                                            'class'               => 'popover-help',
                                            'data-original-title' => $model->getAttributeLabel('param_message'),
                                            'data-content'        => $model->getAttributeDescription('param_message'),
                                            'data-container'      => 'body',
                                        ],
                                    ],
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            ? Yii::t('OfferModule.offer', 'Create type and continue')
            : Yii::t('OfferModule.offer', 'Save type and continue'),
    ]
); ?>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord
            ? Yii::t('OfferModule.offer', 'Create type and close')
            : Yii::t('OfferModule.offer', 'Save type and close'),
    ]
); ?>

<?php $this->endWidget(); ?>