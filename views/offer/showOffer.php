<?php
$this->pageTitle = CHtml::encode($offer->title);
$this->description = CHtml::encode($offer->title);
$this->keywords = CHtml::encode($offer->title);

$this->breadcrumbs = [
    Yii::t('OfferModule.offer', 'Offers') => ['/offer/offer/index'],
    $offer->type->title => ['/offer/offer/show', 'slugType' => CHtml::encode($offer->type->slug)],
    CHtml::encode($offer->title)
];
?>
<div class="row">
    <div class="col-sm-12">
        <h2><?php echo CHtml::encode($offer->title); ?></h2>
        <p><?php echo $offer->text; ?></p>
    </div>
</div>

<?php if ( $offer->type->checkParamMessage() ) : ?>
    <div class="comments-section">
        <?php $this->widget(
            'application.modules.comment.widgets.CommentsListWidget',
            [
                'model'    => $offer,
                'modelId'  => $offer->id
            ]
        ); ?>

        <?php $this->widget(
            'application.modules.comment.widgets.CommentFormWidget',
            [
                'redirectTo' => $this->createUrl('/offer/offer/showOffer/', ['slugType' => CHtml::encode($offer->type->slug), 'slug' => CHtml::encode($offer->slug)]),
                'model'      => $offer,
                'modelId'    => $offer->id,
            ]
        ); ?>
    </div>
<?php endif; ?>