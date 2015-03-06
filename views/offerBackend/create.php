<?php
$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offerBackend/index'],
    Yii::t('OfferModule.offer', 'Adding'),
];

$this->pageTitle = Yii::t('OfferModule.offer', 'Offer - add');

$this->menu = $this->module->getNavigation();
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('OfferModule.offer', 'Offer'); ?>
        <small><?php echo Yii::t('OfferModule.offer', 'add'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', ['model' => $model]); ?>
