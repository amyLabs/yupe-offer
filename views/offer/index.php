<?php
$this->pageTitle = Yii::t('OfferModule.offer', 'Offers');
$this->description = Yii::t('OfferModule.offer', 'Offers');
$this->keywords = Yii::t('OfferModule.offer', 'Offers');
?>

<?php $this->breadcrumbs = [Yii::t('OfferModule.offer', 'Offers')]; ?>

<h1>
    <?php echo Yii::t('OfferModule.offer', 'Offers'); ?>
</h1>

<?php $this->widget(
    'bootstrap.widgets.TbListView',
    [
        'dataProvider'       => $model->search(),
        'itemView'           => '_view',
        'ajaxUpdate'         => false,
    ]
); ?>
