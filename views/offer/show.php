<?php
$this->pageTitle = CHtml::encode($offerType->title);
$this->description = CHtml::encode($offerType->title);
$this->keywords = CHtml::encode($offerType->title);
?>

<?php
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offer/index/'],
    CHtml::encode($offerType->title),
];
?>
<div class="row">
    <div class="col-sm-12">
        <h2><?php echo CHtml::encode($offerType->title); ?></h2>
        <p><?php echo $offerType->description; ?></p>
    </div>
</div>

<?php if ( $offerType->checkCreatePublicOffer(Yii::app()->getUser()->getId()) ) : ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel-group" id="extended-options">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#extended-options" href="#collapseOne">
                                <i class="fa fa-fw fa-plus-square"></i>
                                <?php echo Yii::t('OfferModule.offer', 'Add'); ?>
                            </a>
                        </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <?php $form = $this->beginWidget(
                            'bootstrap.widgets.TbActiveForm',
                            [
                                'id'                     => 'page-form',
                                'enableAjaxValidation'   => false,
                                'enableClientValidation' => true,
                                'htmlOptions'            => ['class' => ''],
                            ]
                        ); ?>
                            <?php $this->beginWidget(
                                'bootstrap.widgets.TbCollapse'/*,
                                [
                                    'htmlOptions' => [
                                        'class' => 'panel-collapse collapse in'
                                    ]
                                ]*/
                            ); ?>
                                <?php echo $form->errorSummary($offer); ?>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php echo $form->textFieldGroup(
                                                $offer,
                                                'title',
                                                [
                                                    'widgetOptions' => [
                                                        'htmlOptions' => [
                                                            'class'               => 'popover-help',
                                                            'data-original-title' => $offer->getAttributeLabel('title'),
                                                            'data-content'        => $offer->getAttributeDescription('title'),
                                                        ],
                                                    ],
                                                ]
                                            ); ?>
                                        </div>
                                        <div class="col-sm-12 popover-help" data-original-title='<?php echo $offer->getAttributeLabel('text'); ?>'
                                             data-content='<?php echo $offer->getAttributeDescription('text'); ?>'>
                                            <?php echo $form->labelEx($offer, 'text'); ?>
                                            <?php
                                            $this->widget(
                                                $this->module->getVisualEditor(),
                                                [
                                                    'model'     => $offer,
                                                    'attribute' => 'text',
                                                ]
                                            ); ?>
                                        </div>
                                    </div>
                                    <?php $this->widget(
                                        'bootstrap.widgets.TbButton',
                                        [
                                            'buttonType'  => 'submit',
                                            'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
                                            'label'       => Yii::t('OfferModule.offer', 'Add')
                                        ]
                                    ); ?>
                                </div>
                            <?php $this->endWidget(); ?>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider'       => Offer::getByType($offerType->id)->search(),
        'itemView'           => '_offer',
        'ajaxUpdate'         => false,
    ]
); ?>